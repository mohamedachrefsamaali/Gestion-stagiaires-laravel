<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Models\Stage;
use App\Models\Sujet;

use Illuminate\Http\Request;

class StageSujetController extends Controller
{
    /*
     * page ajouter sujet
     */
    public function ajouterSujetPage(){
        return view('sujet.ajouterSujet');
    }
    /*
     * create sujet dans le base de données
     */
    public function createSujet(Request $request)
    {
        try {
            $request->validate([
                'titre' => 'required|unique:sujets',
                'description' => 'required',
            ]);

            Sujet::create([
                'titre' => $request->titre,
                'description' => $request->description,
            ]);

            return redirect()->route('getAllSujet');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }
    /*
     * to get all sujet
     */
    public function getAllSujet(){
        $all = Sujet::all();
        return view('sujet.consulterSujet',compact('all'));
    }
    /*
     * fo affecter sujet
     */
    public function goAffecterSujet($id){
        $stagiaire = Personnel::find($id);
        $sujets = Sujet::all();
        return view('affectation.choisirSujet',compact('stagiaire','sujets'));
    }
    /*
     * affecter sujet a un stagiaire
     */
    public function AffecterSujet(Request $request){
        // Vérifier si le sujet est déjà affecté au stagiaire
        $stagiaire = Personnel::find($request->stagiaire_id);
        if ($stagiaire->sujet_id !== null) {
            return "le sujet est déjà affecté à ce stagiaire.";
        }
        //affecter lencadrant au stagiaire
        $stagiaire->sujet_id = $request->sujet_id;
        $stagiaire->save();
        return redirect()->route('affecterPage');
    }
    /*
     * function to edit sujet
     */
    public function editSujet($id){
        $sujet = Sujet::find($id);
        return view('sujet.editSujet',compact('sujet'));
    }
    /*
     * function to update sujet
     */
    public function updateSujet(Request $request,$id){
        $suj = Sujet::find($id);
        try {
            $request->validate([
                'titre' => 'required',
                'description' => 'required',
            ]);

            $suj->update([
                'titre'=>$request->titre,
                'description'=>$request->description,
            ]);
            return redirect()->route('getAllSujet');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }

    }
    /**
     * Remove Sujet
     */
    public function destroySujet($id)
    {
        $sujet = Sujet::findOrfail($id);
        $sujet ->personnels()->update(['sujet_id' => null]);
        $sujet ->delete();
        return redirect()->route('getAllSujet');
    }
    /*
     * rejeter encadrant
     */
    public function RejeterEncadrant($id){
        $stagiaire = Personnel::find($id);
        if ($stagiaire->encadrant_id === null) {
            return "Le stagiaire n'est pas affecté à un encadrant.";
        }
        $stagiaire->encadrant_id = null;
        $stagiaire->save();
        return redirect()->route('affecterPage');
    }
    /*
     * rejeter sujet
     */
    public function RejeterSujet($id){
        $stagiaire = Personnel::find($id);
        if ($stagiaire->sujet_id === null) {
            return "Le stagiaire n'est pas affecté à un sujet.";
        }
        $stagiaire->sujet_id = null;
        $stagiaire->save();

        return redirect()->route('affecterPage');
    }
    /*
     * testttttttttttttt
     */
    public  function test(){
        $stage = Stage::find(1);
        if ($stage) {
            $personnels = $stage->personnels;
            return $personnels;
        }
        return 'not found';
    }
    /*
     * page affecter stage
     */
    public function AffecterStage(){
        $stag = Personnel::all()
            ->where('role','=','stagiaire')
            ->where('stage_id','=',null);
        $sujets = Sujet::all();
        return view('stage.affecterStage',compact('stag','sujets'));
    }
    /*
     * page affecter stage mais de pas de stage
     */
    public function pasDeStage($id){
        $stagiaire = Personnel::where('id', $id)
            ->where('role', 'stagiaire')
            ->whereNull('stage_id')
            ->first();
        $sujets = Sujet::all();
          return view('affectation.pasDeStage',compact('stagiaire','sujets'));

    }
    /*
     * function to create stage in Data base
     */
    public function creerStage(Request $request)
    {
        try {
            // Vérifier que tous les champs de la requête ne sont pas vides
            $this->validate($request, [
                'type' => 'required',
                'date_debut' => 'required|date|after_or_equal:today',
                'date_fin' => 'required|date|after:date_debut|before_or_equal:'.date('Y-m-d',
                        strtotime($request->date_debut. ' + 7 months')),
                'stagiaire_id' => 'required',
                'sujet_id' => 'required',
            ]);
            $stage = Stage::create([
                'type' => $request->type,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
                'stagiaire_id' => $request->stagiaire_id,
                'sujet_id' => $request->sujet_id,
            ]);

            // Récupérer le stage_id du stage créé
            $stageId = $stage->id;

            // Mettre à jour le stage_id dans la table personnels
            Personnel::where('id', $request->stagiaire_id)
                ->update(['stage_id' => $stageId]);

            return redirect()->route('getAllStages');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }
    /*
    * function to create stage in Data base de page pas de stage
    */
    public function creerStagePasdeStage(Request $request)
    {
        try {
            // Vérifier que tous les champs de la requête ne sont pas vides
            $this->validate($request, [
                'type' => 'required',
                'date_debut' => 'required|date|after_or_equal:today',
                'date_fin' => 'required|date|after:date_debut|before_or_equal:'.date('Y-m-d',
                        strtotime($request->date_debut. ' + 7 months')),
                'stagiaire_id'=>'required',
                'sujet_id' => 'required',
            ]);
            $stage = Stage::create([
                'type' => $request->type,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
                'stagiaire_id' => $request->stagiaire_id,
                'sujet_id' => $request->sujet_id,
            ]);

            // Récupérer le stage_id du stage créé
            $stageId = $stage->id;
            // recupurer le sujet_id
            $sujet_id =$stage->sujet_id;

            // Mettre à jour le stage_id dans la table personnels
            Personnel::where('id', $request->stagiaire_id)
                ->update([
                    'stage_id' => $stageId,
                    'sujet_id'=> $sujet_id,
                ]);

            return redirect()->route('getAllStages');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }
    /*
     * function to get all stages
     */
    public function getAllStages()
    {
        $stages = Stage::with('personnels')->get();
        $stagePersonnels = [];
        foreach ($stages as $stage) {
            $personnels = $stage->personnels()->get();
            $stagePersonnels[$stage->id] = $personnels;
        }
        //return $stagePersonnels;
          return view('stage.stage', compact('stages', 'stagePersonnels'));
    }
    /*
     * function to edit stage
     */
    public function editStage($id)
    {
        $stage = Stage::find($id);
        $stag = Personnel::where('role', 'stagiaire')->get();
        $sujets = Sujet::all();
        return view('stage.editStage', compact('stage', 'stag', 'sujets'));
    }
    /*
     * function to update stage
     */
    public function updateStage(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'type' => 'required',
                'date_debut' => 'required|date|after_or_equal:today',
                'date_fin' => 'required|date|after:date_debut|before_or_equal:'.date('Y-m-d',
                        strtotime($request->date_debut. ' + 7 months')),
                'stagiaire_id' => 'required',
                'sujet_id' => 'required',
            ]);

            $stage = Stage::find($id);
            $oldStagiaireId = $stage->stagiaire_id;

            $stage->update([
                'type' => $request->type,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
                'stagiaire_id' => $request->stagiaire_id,
                'sujet_id' => $request->sujet_id,
            ]);

            // Récupérer le stage_id du stage modifié
            $stageId = $stage->id;

            // Révoquer le stage du précédent stagiaire
            Personnel::where('stage_id', $stageId)
                ->update(['stage_id' => null]);

            // Attribuer le stage au nouveau stagiaire
            Personnel::where('id', $request->stagiaire_id)
                ->update(['stage_id' => $stageId]);

            // Si le stage a été attribué à un nouveau stagiaire, remettre l'ancien stagiaire à null
            if ($oldStagiaireId !== $request->stagiaire_id) {
                Personnel::where('id', $oldStagiaireId)
                    ->update(['stage_id' => null]);
            }

            return redirect()->route('getAllStages');
        } catch (\Illuminate\Validation\ValidationException $e) {
        $errors = $e->validator->errors();
        return redirect()->back()->withErrors($errors)->withInput();
        }
    }
    /*
     * function to delete stage
     */
    public function deleteStage($id)
    {
        $stage = Stage::findOrFail($id);
        $stage->personnels()->update(['stage_id' => null]);
        $stage->delete();
        return redirect()->route('getAllStages');
    }
}
