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




class HomeController extends Controller
{
    //

    public function show()
    {
        return view('home');
    }
    
    public function showLogin()
    {
        return view('login');
    }

    public function showRiddle()
    {
                log::error(session('name'));
                $userWord = UserWord::where('users_id',session('user_id'))->get();
                $scores =  0;

                if(!$userWord->isEmpty() ){
                    foreach($userWord as $item){
                        $scores = $scores + $item['score'];
                    }
                    return view('word',['name' => session('name'), 'scores'=> $scores]);

                }
                
                    return view('word',['name' => session('name'), 'scores'=> $scores]);

    }

    public function showRegister()
    {
        return view('register');
    }

    public function showPageUProfil(){
        $user_id = session('user_id'); // Obtenez l'identifiant de l'utilisateur depuis la session

        return view ('updateProfil', ["user_id" => $user_id]);
    }
    


    public function registerUser(Request $request){
        // Validation des données
       try{
        $validatedData = $request->validate([
            'username' => 'required|min:5|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ]);
    
        // Création de l'utilisateur
        $user = new User();
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->save();
    
        // Vérifier si la sauvegarde a réussi
        if ($user->save()) {
            return view('login');
        } else {
            // Gérer le cas où la sauvegarde de l'utilisateur échoue
            return redirect()->route('register')->with('error', 'Erreur lors de la création de votre compte');
        }
       }catch(Exception $ex){
        log::error($ex);
       }
    }

    
    public function register()
    {
        return view('register');
    }

    public function loginUser(Request $request){
      try{
          // Validation des données
          $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $foundUser = User::where("username",$validatedData['username'])->first();
        if ($foundUser){
            if (Hash::check($validatedData['password'], $foundUser->password)){
                
                session(['user_id' => $foundUser->id, 'name' => $foundUser->username ]);

                return redirect()->route('show-riddle');
            }else{
                return redirect()->route('show-login')->with('error', 'Le mot de passe de l\'utilisateur n\'est pas correct.');
            }
 
        }
        return redirect()->route('show-login')->with('error', 'le nom de l\'utilisateur nest pas reconnu');

      }catch(Exception $ex){
        log::error($ex);

      }

    }
    public function updateProfil(Request $request, $id){
        log::error($id);
        // Validation des données
        $validatedData = $request->validate([
            'username' => 'required|min:5',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        log::error('hiiiiii');

        $user = User::where('id',$id)->first();
        log::error($user);

        if (!$user) {
            return redirect()->route('show-update-profil')->with('error', 'Utilisateur introuvable.');
        }
        
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->save();
    
        // Vérifier si la sauvegarde a réussi
        if ($user->save()) {
            return view('login');
        } else {
            // Gérer le cas où la sauvegarde de l'utilisateur échoue
            return redirect()->route('show-update-profil')->with('error', 'Erreur lors du modification du compte de l\'utilisateur');

        }
    }


    public function riddle(Request $request){
     try{
           // Validation des données
           $first_name = $request->input('first-name');
           $second_name = $request->input('second-name');
           $third_name = $request->input('third-name');
           $four_name = $request->input('four-name');
           $five_name = $request->input('five-name');
           $date = $request->input('date');
   
           $word = $first_name . $second_name . $third_name . $four_name . $five_name ;
           log::error($word);
           if (isset($date)){
            $foundWord = Word::where("word",  $word)->where("date",$date)->first();
           }
           else{
            $foundWord = Word::where("word",  $word)->where("date",carbon::now())->first();

           }
           if ($foundWord){
               $score = new UserWord();
               $score->word_id = $foundWord->id;
               $score->user_id =  session('user_id');
               $score->score += 1;
               $score->save();
               

               return redirect()->route('show-riddle')->with('message', 'Bravo vous avez un point de plus');
           }
           $attemptsLeft = $request->session()->get('attemptsLeft', 8);
   
           if ($attemptsLeft > 1) {
               // Il reste des essais, décrémentez le nombre d'essais restants
               $attemptsLeft--;
               $request->session()->put('attemptsLeft', $attemptsLeft);
               return redirect()->route('show-riddle')->with('error', 'Désolé, essayez à nouveau. Il vous reste ' . $attemptsLeft . ' essais.');

           } else {
               // Plus d'essais, le joueur a perdu
               $request->session()->forget('attemptsLeft'); // Supprimez la clé de session
               return redirect()->route('show-riddle')->with('error', 'Désolé, vous avez épuisé vos essais. Le  mots  du jour est'. $foundWord);

               }

     }catch(Exception $ex){
        log::error($ex);
     }
    }
}


