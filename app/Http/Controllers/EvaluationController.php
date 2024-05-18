<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Personnel;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /*
     * function to go page evaluation
     */
    public function goPageEvaluer($id)
    {
        $stagiaire = Personnel::find($id);
        if($stagiaire->stage && $stagiaire->sujet ){
            $stage = $stagiaire->stage;
            $sujet = $stagiaire->sujet;
            return view('evaluation.evaluerPage', compact('stagiaire', 'stage', 'sujet'));
        }

        return response("ce stagiaire n'admet pas stage ou bien sujet");
    }

    /*
     * function to store evaluation dans data base
     */
    public function storeEvaluation(Request $request)
    {
        try {
//             Validation des requêtes requises
            $request->validate([
                'stagiaire_id' => 'required',
                'stage_id' => 'required',
                'sujet_id' => 'required',
                'checkbox1' => 'required',
                'checkbox2' => 'required',
                'checkbox3' => 'required',
                'checkbox4' => 'required',
                'checkbox5' => 'required',
                'checkbox6' => 'required',
                'checkbox7' => 'required',
                'checkbox8' => 'required',
                'checkbox9' => 'required',
                'checkbox10' => 'required',
                'checkbox11' => 'required',
                'checkbox12' => 'required',
                'checkbox13' => 'required',
                'checkbox14' => 'required',
                'checkbox15' => 'required',
                'checkbox16' => 'required',
            ]);
        // Extraire les valeurs des colonnes checkbox 1 à 16
        $checkboxValues = [];
        $checkboxValues[] = $request->checkbox1;
        $checkboxValues[] = $request->checkbox2;
        $checkboxValues[] = $request->checkbox3;
        $checkboxValues[] = $request->checkbox4;
        $checkboxValues[] = $request->checkbox5;
        $checkboxValues[] = $request->checkbox6;
        $checkboxValues[] = $request->checkbox7;
        $checkboxValues[] = $request->checkbox8;
        $checkboxValues[] = $request->checkbox9;
        $checkboxValues[] = $request->checkbox10;
        $checkboxValues[] = $request->checkbox11;
        $checkboxValues[] = $request->checkbox12;
        $checkboxValues[] = $request->checkbox13;
        $checkboxValues[] = $request->checkbox14;
        $checkboxValues[] = $request->checkbox15;
        $checkboxValues[] = $request->checkbox16;
    // Créer un tableau associatif pour stocker les valeurs uniques avec leur compteur
        $uniqueValues = [];
        foreach($checkboxValues as $value) {
            if(isset($uniqueValues[$value])) {
                $uniqueValues[$value]++;
            } else {
                $uniqueValues[$value] = 1;
            }
        }
        // Définir les poids pour chaque mot
        $weights = [
            "excellent" => 4,
            "satisfaisant" => 2,
            "insatisfaisant" => 0,
            "tres-bon" => 3,
        ];
        // Calculer la note finale en multipliant chaque poids dans chaque mot
        $noteFinale = 0;
        foreach($uniqueValues as $value => $count) {
            if(isset($weights[$value])) {
                $noteFinale += $weights[$value] * $count;
            }
        }
        //note sur 20
        $noteSur20 = $noteFinale*20 /64;
        //creation dans la db
            $evaluation = Evaluation::create([
                'stagiaire_id' => $request->stagiaire_id,
                'stage_id' => $request->stage_id,
                'sujet_id' => $request->sujet_id,
                'note'=>$noteSur20,
            ]);
            // Récupérer l'utilisateur connecté
            $user = auth()->user();
            $personnel = $user->personnel;

            // Récupérer les stagiaires associés à l'utilisateur connecté
            $stagiaires = Personnel::where('encadrant_id', $personnel->id)->get();

            // Récupérer les évaluations des stagiaires associés à l'utilisateur connecté
            $evaluations= Evaluation::whereIn('stagiaire_id', $stagiaires->pluck('id'))->get();

            return view('taches.ListeStagiaire',compact('noteSur20','stagiaires','evaluations'));
        }  catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }
    /*
     * function rejeter evaluation delete
     */
    public function RejeterEvaluation($id){
        Evaluation::find($id)->delete();
        return redirect()->route('getAllStagiaires');
    }



}
