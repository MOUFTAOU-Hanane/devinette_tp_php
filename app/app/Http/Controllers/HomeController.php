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
    //page d'accueil
    public function show()
    {
        return view('welcome');
    }

    //page de login
    public function showLogin()
    {
        return view('login');
    }

    //page de register
    public function register()
    {
        return view('register');
    }


    //register user
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

    // login de l'utilisateur
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

    // Modeification profil
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

    //compte
    public function showProfil()
    {
        $user  = User::where('id', session('user_id'))->first();

        return view('profil', [
            "name" => $user->username, "email" => $user->email, "avatar" => $user->avatar, "user_id" => session('user_id')
        ]);
    }

    //listing user
    public function listingUser()
    {
        $users = User::whereNull('is_deleted')->get();

        return view('users', ["users" => $users]);
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


    public function deleteUser($id)
    {
        $user = User::where('id', $id)->first();
        $user->is_deleted = False;
        return view('welcome');
    }








}
