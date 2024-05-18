<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Personnel;
use App\Models\Tache;
use Illuminate\Http\Request;

class TachesController extends Controller
{
    /*
     * function to get all stagiaire affecter o encadrant connecter
     */
    public function getAllStagiaires()
    {
        // Récupérer l'utilisateur connecté
        $user = auth()->user();
        $personnel = $user->personnel;

        // Récupérer les stagiaires associés à l'utilisateur connecté
        $stagiaires = Personnel::where('encadrant_id', $personnel->id)->get();

        // Récupérer les évaluations des stagiaires associés à l'utilisateur connecté
            $evaluations= Evaluation::whereIn('stagiaire_id', $stagiaires->pluck('id'))->get();
        return view('taches.ListeStagiaire', compact('stagiaires', 'evaluations'));
    }
    /*
     * function to go ajouter tache
     */
    public function ajouterTache($id){
        return view('taches.createTache',compact('id'));
    }

    /*
      * function to store tache in data base
      */
    public function storeTache(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'titre' => 'required',
                'description' => 'required',
                'stagiaire_id' => 'required',
                'date_debut' => 'required|date|after_or_equal:today',
                'date_fin' => 'required|date|after:date_debut|before_or_equal:'.date('Y-m-d',
                        strtotime($request->date_debut. ' + 1 week')),
            ]);
            Tache::create($validatedData);

            return redirect()->route('getAllStagiaires')->with('success', 'Tâche créée avec succès');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            return redirect()->back()->withErrors($errors)->withInput();
    }
}
    /*
     * function to get all taches de stagiaire specifier
     */
    public function getTacheDeStag($id)
    {
        $stagiaire = Personnel::find($id);
        $taches = $stagiaire->taches;
        foreach ($taches as $tache) {
            $dateDebut = strtotime($tache->date_debut);
            $dateFin = strtotime($tache->date_fin);
            $nombreJours = ($dateFin - $dateDebut) / (60 * 60 * 24);

            $tache->nombre_jours = $nombreJours;
        }
        //return $taches;
        return view('taches.ListeTachesPourStagiaire',compact('taches','stagiaire'));
    }
    /*
     * function to go page edit tache
     */
    public function editTache($id){
        $tache = Tache::find($id);
        return view('taches.editTache',compact('tache'));
    }
    /*
     * function to update tache
     */
    public function updateTache(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'titre' => 'required',
                'description' => 'required',
                'stagiaire_id' => 'required',
                'date_debut' => 'required|date|after_or_equal:today',
                'date_fin' => 'required|date|after:date_debut|before_or_equal:' . date('Y-m-d', strtotime($request->date_debut . ' + 1 week')),
            ]);
            $tache = Tache::findOrFail($id);
            $tache->update($validatedData);
            return redirect()->route('getAllStagiaires')->with('success', 'Tâche mise à jour avec succès');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }
    /*
     * function to delete tache
     */
    public function deleteTache($id)
    {
        $tache = Tache::find($id);
        $tache->delete();
        return redirect()->back();
    }
    /*
     * function to get all taches de stagiaire connecter
     */
    public function getAllTaches()
    {
        // Récupérer l'utilisateur connecté
        $user = auth()->user();
        $personnel = $user->personnel;
        // Récupérer toutes les tâches associées au personnel
        $taches = $personnel->taches()->get();
        foreach ($taches as $tache) {
            $dateDebut = strtotime($tache->date_debut);
            $dateFin = strtotime($tache->date_fin);
            $nombreJours = ($dateFin - $dateDebut) / (60 * 60 * 24);

            $tache->nombre_jours = $nombreJours;
        }
            return view('taches.ListesDesTaches',compact('taches'));
    }
    /*
     * function to mise a jour colunm dalse 0 to true 1 si la tache terminer
     */
    public function tacheTerminer($id){
        $tache = Tache::find($id);
        if($tache) {
            $tache->terminer = true;
            $tache->save();
            // Redirection ou affichage d'un message de succès
        } else {
            return response('error dans le methode tacher terminer');
        }
        return redirect()->route('getAllTaches');
    }
    public function tacheNonTerminer($id){
        $tache = Tache::find($id);
        if($tache) {
            $tache->terminer = false;
            $tache->save();
            // Redirection ou affichage d'un message de succès
        } else {
            return response('error dans le methode tache non terminer');
        }
        return redirect()->route('getAllTaches');
    }
}
