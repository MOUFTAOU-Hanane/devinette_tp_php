<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Word;
use App\Models\UserWord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;




class HomeController extends Controller
{
    //
    public function show()
    {
        return view('welcome');
    }

    public function showProfil()
    {
        $user  = User::where('id', session('user_id'))->first();

        return view('profil', [
            "name" => $user->username, "email" => $user->email, "avatar" => $user->avatar, "user_id" => session('user_id')
        ]);
    }
    public function listingUser()
    {
        $users = User::whereNull('is_deleted')->get();

        return view('users', ["users" => $users]);
    }


    public function showLogin()
    {
        return view('login');
    }

    public function showRiddle()
    {
        log::error(session('name'));
        $userScore = UserWord::where('users_id', session('user_id'))->sum('score');
        if ($userScore) {

            return view('word', ['name' => session('name'), 'scores' => $userScore]);
        } else {
            $score =  0;
            return view('word', ['name' => session('name'), 'scores' => $score]);
        }
    }

    public function showRegister()
    {
        return view('register');
    }

    public function showPageUProfil()
    {
        $user_id = session('user_id'); // Obtenez l'identifiant de l'utilisateur depuis la session

        return view('updateProfil', ["user_id" => $user_id]);
    }



    public function registerUser(Request $request)
    {
        // Validation des données
        try {
            $validatedData = $request->validate([
                'username' => 'required|unique:users,username',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:6',
            ]);

            // Création de l'utilisateur
            $user = new User();
            $user->username = $validatedData['username'];
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']);
            $user->save();

            // Vérifier si la sauvegarde a réussi
            if ($user->save()) {
                return redirect()->route('show-login')->with('success', 'Votre compte a été créé avec succès. Connectez-vous maintenant.');
            } else {
                // Gérer le cas où la sauvegarde de l'utilisateur échoue
                return redirect()->route('register')->with('message', 'Erreur lors de la création de votre compte');
            }
        } catch (Exception $ex) {
            log::error($ex);
        }
    }


    public function register()
    {
        return view('register');
    }

    public function loginUser(Request $request)
    {
        try {
            // Validation des données
            $validatedData = $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);
            $foundUser = User::where("username", $validatedData['username'])->whereNull('is_deleted')->first();
            if ($foundUser) {
                if (Hash::check($validatedData['password'], $foundUser->password)) {

                    session(['user_id' => $foundUser->id, 'name' => $foundUser->username]);
                    return redirect()->route('show-riddle');
                } else {
                    return redirect()->route('show-login')->with('error', 'Le mot de passe de l\'utilisateur n\'est pas correct.');
                }
            } else {

                return redirect()->route('show-login')->with('error', 'le nom de l\'utilisateur nest pas reconnu');
            }
        } catch (Exception $ex) {
            log::error($ex);
        }
    }
    public function updateProfil(Request $request, $id)
    {
        log::error($id);
        // Validation des données
        $validatedData = $request->validate([
            'username' => 'required|min:5',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect()->route('show-update-profil')->with('error', 'Utilisateur introuvable.');
        }

        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        log::error($request->file());
        if ($request->file()) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $user->avatar = '/storage/' . $filePath;
        }
        $user->save();

        // Vérifier si la sauvegarde a réussi
        if ($user->save()) {
            return view('login');
        } else {
            // Gérer le cas où la sauvegarde de l'utilisateur échoue
            return redirect()->route('show-update-profil')->with('error', 'Erreur lors du modification du compte de l\'utilisateur');
        }
    }


    public function riddle(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'date' => 'required|date',
            ]);
            // Validation des données
            $first_name = $request->input('first-name');
            $second_name = $request->input('second-name');
            $third_name = $request->input('third-name');
            $four_name = $request->input('four-name');
            $five_name = $request->input('five-name');
            $date = $validatedData['date'];
            $word = $first_name . $second_name . $third_name . $four_name . $five_name;
            $date1 = Carbon::parse($date);

            $user = User::where('id',  session('user_id'))->first();
            if ($user->lastdate !== null) {
                $date2 = Carbon::parse($user->lastdate);
                if ($date1->equalTo($date2)) {
                    return redirect()->route('show-riddle')->with(
                        'error',
                        'Désolé, Vous avec déja deviné le mots de cette date.Choisissez une autre date pour deviner le mots du jour '
                    );
                }
            }
            // Récupérer le nombre d'essais restants pour cette date
            $attemptsLeftKey = 'attemptsLeft_' . $date1->toDateString();
            $attemptsLeft = $request->session()->get($attemptsLeftKey, 8);
            $foundWord = Word::where("word",  $word)->where("date",  $date1->toDateString())->first();
            $wordDay = Word::where("date",  $date1->toDateString())->first();

            if ($foundWord) {
                $score = new UserWord();
                $score->words_id = $foundWord->id;
                $score->users_id =  session('user_id');
                $score->score = 1;
                $score->found_word = True;
                $score->save();

                $user->lastdate =  $date;
                $user->save();

                $request->session()->put('word_id', $foundWord->id);

                return redirect()->route('show-like-word')->with(['message' => 'Bravo vous avez un point de plus', 'word' => $word]);
            }

            if ($attemptsLeft > 1) {
                // Il reste des essais, décrémentez le nombre d'essais restants
                $attemptsLeft--;
                $request->session()->put($attemptsLeftKey, $attemptsLeft);
                return  redirect()->route('show-riddle')->with('error', 'Désolé, essayez à nouveau. Il vous reste ' . $attemptsLeft . ' essais.');
            } else {

                // Plus d'essais, le joueur a perdu
                $request->session()->forget($attemptsLeftKey); // Supprimez la clé de session

                $score = new UserWord();
                $score->words_id = $wordDay->id;
                $score->users_id =  session('user_id');
                $score->score = 0;
                $score->found_word = False;
                $score->save();

                $user->lastdate =  $date;
                $user->save();
                Log::error($wordDay->word);
                return redirect()->route('show-like-word')->with(['error', 'Désolé, vous avez épuisé vos essais. Le  mots  du jour est', 'word' => $wordDay->word]);
            }
        } catch (Exception $ex) {
            log::error($ex);
        }
    }

    public function showLikeWordPage()
    {

        return view("likePage", ['name' => session('name')]);
    }

    public function likeWord(Request $request)
    {
        try {
            // Validation des données
            $request->validate([
                'response' => 'required',
                'note' => 'required|numeric',
            ]);

            $response = $request->input('response');
            $note = $request->input('note');
            $user_id = session('user_id');
            $word = $request->session()->get('word_id');
            log::error($word);


            $likeWord = UserWord::where('users_id', $user_id)->where('words_id', $word)->first();
            log::error("likeword");
            log::error($likeWord);
            log::error("response");
            log::error($response);
            log::error("note");
            log::error($note);

            if (!$likeWord) {
                return redirect()->route('show-riddle')->with('error', 'Objet UserWord non trouvé.');
            }

            if ($response === 'true') {
                $likeWord->update(['note' => $note, 'response' => 1]);
            } elseif ($response === 'false') {
                $likeWord->update(['note' => $note, 'response' => 0]);
            }



            return redirect()->route('show-riddle');
        } catch (Exception $ex) {
            log::error($ex);
            return redirect()->route('show-riddle')->with('error', 'Une erreur s\'est produite.');
        }
    }


    public function userScore()
    {
        try {
            $userId = session('user_id');

            // Récupérer les amis de l'utilisateur
            $user = User::find($userId);
            $friends = $user->friends;

            // Ajouter l'utilisateur lui-même à la liste des amis (si nécessaire)
            $friends[] = $userId;

            // Récupérer les scores des amis
            $userScores = [];
            foreach ($friends as $friendId) {
                $friend = User::find($friendId);
                $totalScore = UserWord::where('users_id', $friendId)->sum('score');

                $userScores[] = [
                    'friend' => $friend,  // Contient l'objet User de l'ami
                    'totalScore' => $totalScore,
                ];
            }

            return view('users_score', ['userScores' => $userScores]);
        } catch (Exception $ex) {
            log::error($ex);
        }
    }





    public function historique($id)
    {
        $list = UserWord::where("users_id", $id)->get();
        return view('historique', ['list' => $list]);
    }

    public function deleteUser($id)
    {
        $user = User::where('id', $id)->first();
        $user->is_deleted = False;
        return view('welcome');
    }


    public function addFriend($id)
    {
        $friend = $id;

        $users_friend = User::where('id', session('user_id'))->first();
        log::error($users_friend);

        if ($users_friend->friends === null) {
            $users_friend->friends = [];
        }

        $friendsCopy = $users_friend->friends;

        if (!in_array($friend, $friendsCopy)) {
            $friendsCopy[] = $friend;

            $users_friend->friends = $friendsCopy;

            $users_friend->save();

            return redirect()->back()->with('success', 'Demande d\'ami ajoutée avec succès.');
        }

        return redirect()->back()->with('error', 'Cet utilisateur est déjà dans votre liste d\'amis.');
    }
}
