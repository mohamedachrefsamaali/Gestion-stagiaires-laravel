<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Personnel;
use App\Models\Sujet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PersoController extends Controller
{
    /*
         * function to get all stagiaires
         */
    public function indexS()
    {
        $users = Personnel::join('users', 'personnels.user_id', '=', 'users.id')
            ->where('personnels.role', 'stagiaire')
            ->select('personnels.*', 'users.path')
            ->get();
        return view('stagiaires.stagiare',compact('users'));
    }

    public function liste_actors()
    {
        $users = Personnel::join('users', 'personnels.user_id', '=', 'users.id')
            ->where('personnels.role', 'stagiaire')
            ->select('personnels.*', 'users.path')
            ->get();
       return response()->json(['actors'=>$users]);
    }
    /*
     * function to go create stagiaire page
     */
    public function createS(){
        return view('stagiaires.create');
    }
    /*
     * function to store stagiaire in data base
     */


    public function storeS(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users|unique:personnels,email',
                'password' => 'required',
                'telephone' => 'required',
                'universite' => 'required',
                'niveau' => 'required',
                'avatar' => 'required', // Ajout de la validation pour s'assurer que le fichier est une image
            ]);

            $filename=time(). '.'.$request->avatar->extension();
            $path= $request->file('avatar')->storeAs('avatares',$filename,'public');

                // Créer un nouvel utilisateur dans la table "users" avec le rôle par défaut "stagiaire"
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'role' => 'stagiaire', // Rôle par défaut
                    'path'=>$path,

                ]);

                // Créer un nouveau stagiaire dans la table "personnels" en utilisant l'ID de l'utilisateur créé
                $stagiaire = Personnel::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'telephone' => $request->telephone,
                    'role' => 'stagiaire',
                    'universite' => $request->universite,
                    'niveau' => $request->niveau,
                    'user_id' => $user->id,
                ]);

                return redirect()->route('stagiaires');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            return back()->withErrors($errors)->withInput();
        }
    }
    /*
     * function to edit stagiaire
     */
    public  function editS($id){
        $user=Personnel::findOrfail($id);
        return view('stagiaires.edit_stagiaire',compact('user'));
    }
    /*
     * function to update encadrant
     */

    public function updateS(Request $request, $id)
    {
        try {
            // Récupérer le stagiaire à mettre à jour
            $stagiaire = Personnel::findOrFail($id);

            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$stagiaire->user->id.'|unique:personnels,email,'.$stagiaire->id,
                'telephone' => 'required',
                'universite' => 'required',
                'niveau' => 'required',
            ]);
            // Mettre à jour les informations du stagiaire dans la table "personnels"
            $stagiaire->update([
                'name' => $request->name,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'role' => $request->role,
                'universite' => $request->universite,
                'niveau' => $request->niveau,
            ]);
            // Mettre à jour les informations de l'utilisateur dans la table "users" correspondant au stagiaire
            $user = $stagiaire->user;
            if ($user) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => $request->role,
                ]);
            }
            return redirect()->route('stagiaires');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            return back()->withErrors($errors)->withInput();
        }
    }
    /**
     * Remove Stagiaire
     */
    public function destroyS($id)
    {
        Personnel::findOrfail($id)->delete();
        return redirect()->route('stagiaires');
    }



////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
   * function to get all Encadrants
   */
    public function indexE(){
        $users=Personnel::get()->where('role','encadrant');
        return view('encadrants.encadrant',compact('users'));

    }
    /*
     * function to go create encadrant page
     */
    public function createE(){
        return view('encadrants.create_encadrant');
    }
    /*
     * function to store encadrant in data base
     */
    public function storeE(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users|unique:personnels,email',
                'password' => 'required',
                'telephone' => 'required',
                'titre' => 'required',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'encadrant',
            ]);

            $encadrant = Personnel::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'telephone' => $request->telephone,
                'role' => 'encadrant',
                'titre' => $request->titre,
                'user_id' => $user->id,
            ]);
            return redirect()->route('encadrants');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            return back()->withErrors($errors)->withInput();
        }
    }
    /*
     * function to edit encadrant
     */
    public  function editE($id){
        $user=Personnel::findOrfail($id);
        return view('encadrants.edit_encadrant',compact('user'));
    }
    /*
     * function to update encadrant
     */
    public function updateE(Request $request, $id)
    {
        try {
            // Récupérer l'encadrant à mettre à jour
            $encadrant = Personnel::findOrFail($id);

            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$encadrant->user->id.'|unique:personnels,email,'.$encadrant->id,
                'telephone' => 'required',
                'role' => 'required',
                'titre' => 'required',
            ]);

            // Mettre à jour les informations de l'encadrant dans la table "personnels"
            $encadrant->update([
                'name' => $request->name,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'role' => $request->role,
                'titre' => $request->titre,
            ]);

            // Mettre à jour les informations de l'utilisateur dans la table "users" correspondant à l'encadrant
            $user = $encadrant->user;
            if ($user) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => $request->role,
                ]);
            }

            return redirect()->route('encadrants');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            return back()->withErrors($errors)->withInput();
        }
    }
    /**
     * Remove encadrant.
     */
    public function destroyE($id)
    {
        Personnel::findOrfail($id)->delete();
        return redirect()->route('encadrants');
    }

//    //////////////////////////////////////////////////////////////////////////////////////////
    /*
     * only trashed
     */
    public function showSoftdeletes(){
        $users=Personnel::onlyTrashed()->get();
        $admins=User::onlyTrashed()->where('role','admin')->get();
        return view('archive',compact('users','admins'));
    }
    /*
     * function ro restore data from softdelete to table
     */
    public function restore($id){
        Personnel::withTrashed()->where('id',$id)->restore();
        return redirect()->back();

    }
    /*
     * restore admin
     */
    public function restoreAdmin($id){
        User::withTrashed()->where('id',$id)->restore();
        return redirect()->back();
    }
    /*
     * forceDelete admin
     */
    public function forceDeleteAdmin($id){
        $user = User::withTrashed()->find($id);

        $user->forceDelete(); // Supprimer le personnel
        return redirect()->back();
    }
    /*
     * function t destroy data from softdelete and table
     */
    public function forceDelete($id){
       $personnel = Personnel::withTrashed()->find($id);
        if ($personnel) {
            $personnel->stage_id = null; // Mettre à jour la valeur de stage_id à null
            $personnel->save(); // Enregistrer les modifications
            $user = User::find($personnel->user_id);
            $user->delete();
            $personnel->forceDelete(); // Supprimer le personnel
        }
        return redirect()->back();
    }
    /*
     * function delete all stagiaire
     */
    public function deleteAllStagiaire()
    {
        $personnels = Personnel::where('role', 'stagiaire')->get();

        foreach ($personnels as $personnel) {
            if ($personnel) {
                $personnel->stage_id = null; // Mettre à jour la valeur de stage_id à null
                $personnel->save(); // Enregistrer les modifications

                $user = User::find($personnel->user_id);
                $user->delete();

                $evaluations = Evaluation::where('stagiaire_id', $personnel->id)->get();
                foreach ($evaluations as $evaluation) {
                    $evaluation->delete();
                }

                $personnel->delete(); // Supprimer le personnel
            }
        }

        return redirect()->back()->with('success', 'Tous les stagiaires ont été supprimés avec succès.');
    }
    /*
     * function delete all encadrant
     */
    public function deleteAllEncadrant(){
        $personnels = Personnel::where('role','encadrant')->get();
        foreach ($personnels as $personnel){
            if ($personnel) {
                $user = User::find($personnel->user_id);
                $user->delete();
                $personnel->delete(); // Supprimer le personnel
                return redirect()->back();
            }
        }
        return response('erreur dans le button delete all Encadrant');
    }
    /*
     * delete all from archive
     */
    public function deleteAllFromArchive()
    {
        $stagiaires = Personnel::withTrashed()->where('role', 'stagiaire')->get();
        $encadrants = Personnel::withTrashed()->where('role', 'encadrant')->get();
        $users = User::withTrashed()->where('role', 'admin')->get();
        foreach ($stagiaires as $personnel) {
            if ($personnel) {
                $personnel->stage_id = null; // Mettre à jour la valeur de stage_id à null
                $personnel->save(); // Enregistrer les modifications
                $user = User::find($personnel->user_id);
                $user->delete();
                $evaluations = Evaluation::where('stagiaire_id', $personnel->id)->get();
                foreach ($evaluations as $evaluation) {
                    $evaluation->delete();
                }
                $personnel->forceDelete(); // Supprimer le personnel
            }
        }
        foreach ($encadrants as $personnel) {
            if ($personnel) {
                $user = User::find($personnel->user_id);
                $user->delete();
                $personnel->forceDelete(); // Supprimer le personnel
            }
        }
        foreach ($users as $user) {
            if ($user) {
                $user = User::find($user->id);
                $user->forceDelete(); // Supprimer le personnel
            }
        }
        return redirect()->back();
    }
    /*
     * function log out
     */
    public function logoutn()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
    /*
        * store new admin
        */
    public function storeNewAdmin(Request $request){
        // Créer un nouvel utilisateur dans la table "users" avec le rôle par défaut "admin"
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'admin', // Rôle par défaut
        ]);
        return redirect()->route('consulterAdmin');

    }
    /*
     * register new admin
     */
    public function registerNewAdmin(){
        return view('admin.registerAdmin');
    }
    /**
     * Fonction pour consulter tous les administrateurs
     */
    public function consulterAdmin()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.consulerAdmin',compact('admins'));
    }
    /*
     * filtre par etablissement
     */
    public function filtreParEtablissement()
    {
        // Récupérer les universités de chaque personne
        $personnes = Personnel::all();
        $universites = $personnes->pluck('universite')->reject(function ($universite) {
            return $universite === null;
        });

        // Éliminer les doublons
        $universitesUniques = $universites->unique();

        // Retourner les noms des universités et leurs personnes associées
        $resultat = [];
        foreach ($universitesUniques as $universite) {
            $personnesUniversite = $personnes->where('universite', $universite);
            $resultat[$universite] = $personnesUniversite;
        }
        return view('filtre.filtreEtablissement', compact('universitesUniques', 'resultat'));
    }
    /*
  * Filtre par sujet
  */
    public function filtreParSujet()
    {
        // Récupérer tous les sujets
        $sujets = Sujet::all();

        // Éliminer les doublons
        $sujetsUniques = $sujets->unique('titre');

        // Retourner les stagiaires ayant le sujet correspondant
        $resultat = [];
        foreach ($sujetsUniques as $sujet) {
            $stagiairesSujet = $sujet->personnels;
            $resultat[$sujet->titre] = $stagiairesSujet;
        }
        return view('filtre.filtreParSujet', compact('sujetsUniques', 'resultat'));
    }
    /*
     * edit administrateur
     */
    public function editAdministrateur($id){
        $admin = User::find($id);
        return view('admin.editAdmin',compact('admin'));
    }
    /*
     * update admin
     */
    public function updateAdmin(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed',
            ]);

            $user = User::find($id);
            $personne = Personnel::where('user_id',$user->id)->get();

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            return redirect()->route('consulterAdmin')->with('success', 'Admin mis à jour avec succès.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            return back()->withErrors($errors)->withInput();
        }
    }
    /*
     * doft delete admin
     */
    public function softDeleteAdmin($id){
        $user =User::find($id);
        $user->delete();
        return redirect()->back();
    }
}
