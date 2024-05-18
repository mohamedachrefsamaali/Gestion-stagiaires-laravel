@extends('.navbar/navbarEncadrant')
@section('title')
    Evaluation
@endsection
@section('content')
<div class="container">
    <h1 class="text-center mt-2" style="color: #385170">Évaluation de stage</h1>
    <form  action="{{route('storeEvaluation')}}" method="POST" style="border: 1mm solid #B2B2B2; padding: 20px;" >
        @csrf
    <table>
        <tr class="ligne">
            <td>
                <span><strong>Nom du stagiaire:</strong></span>
            </td>
            <td>
                <span class="mx-5">{{$stagiaire->name}}</span>
                <input type="hidden" name="name" value="{{$stagiaire->name}}">

            </td>
        </tr>
        <tr class="ligne">
            <td>
                <span><strong>Date de début:</strong></span>
            </td>
            <td>
                <span class="mx-5">{{$stage->date_debut}}</span>
                <input type="hidden" name="date_debut" value="{{$stage->date_debut}}">

            </td>
        </tr>
        <tr class="ligne">
            <td>
                <span><strong>Date de fin:</strong></span>
            </td>
            <td>
                <span class="mx-5">{{$stage->date_fin}}</span>
                <input type="hidden" name="date_fin" value="{{$stage->date_fin}}">
            </td>
        </tr>
        <tr class="ligne">
            <td>
                <span><strong>Type:</strong></span>
            </td>
            <td>
                <span class="mx-5">{{$stage->type}}</span>
                <input type="hidden" name="type" value="{{$stage->type}}">
            </td>
        </tr>
        <tr class="ligne">
            <td>
                <span><strong>Titre du sujet:</strong></span>
            </td>
            <td>
                <span class="mx-5">{{$sujet->titre}}</span>
                <input type="hidden" name="titre" value="{{$sujet->titre}}">

            </td>
        </tr>
    </table>
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>
                            <p><strong>Excellent:</strong> les missions que le stagiaire effectue, dépassent non seulement les normes requises, mais méritent une mention particulière</p>
                            <p><strong>Très bon:</strong> les missions que le stagiaire effectue, dépassent les normes requises.</p>
                            <p><strong>Satisfaisant:</strong> les missions effectuées par le stagiaire correspondent aux normes demandées</p>
                            <p><strong>Insatisfaisant:</strong> les missions effectuées par le stagiaire ne correspondent pas aux normes demandées</p>
                        </th>
                        <th>Excellent</th>
                        <th>Très bon</th>
                        <th>Satisfaisant</th>
                        <th>Insatisfaisant</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Motivation personnelle de l’étudiant</td>
                        <td><input type="radio" name="checkbox1" value="excellent" @if(old('checkbox1') == 'excellent') checked @endif></td>
                        <td><input type="radio" name="checkbox1" value="tres-bon" @if(old('checkbox1') == 'tres-bon') checked @endif></td>
                        <td><input type="radio" name="checkbox1" value="satisfaisant" @if(old('checkbox1') == 'satisfaisant') checked @endif></td>
                        <td><input type="radio" name="checkbox1" value="insatisfaisant" @if(old('checkbox1') == 'insatisfaisant') checked @endif></td>
                        <td>@error('checkbox1')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror</td>
                    </tr>
                    <tr>
                        <td>Esprit d'initiative</td>
                        <td><input type="radio" name="checkbox2" value="excellent" @if(old('checkbox2') == 'excellent') checked @endif></td>
                        <td><input type="radio" name="checkbox2" value="tres-bon" @if(old('checkbox2') == 'tres-bon') checked @endif></td>
                        <td><input type="radio" name="checkbox2" value="satisfaisant" @if(old('checkbox2') == 'satisfaisant') checked @endif></td>
                        <td><input type="radio" name="checkbox2" value="insatisfaisant" @if(old('checkbox2') == 'insatisfaisant') checked @endif></td>
                        <td>@error('checkbox2')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror</td>
                    </tr>
                    <tr>
                        <td>Évolution remarquée dans l’apprentissage et le cheminement de l’étudiant</td>
                        <td><input type="radio" name="checkbox3" value="excellent" @if(old('checkbox3') == 'excellent') checked @endif></td>
                        <td><input type="radio" name="checkbox3" value="tres-bon" @if(old('checkbox3') == 'tres-bon') checked @endif></td>
                        <td><input type="radio" name="checkbox3" value="satisfaisant" @if(old('checkbox3') == 'satisfaisant') checked @endif></td>
                        <td><input type="radio" name="checkbox3" value="insatisfaisant" @if(old('checkbox3') == 'insatisfaisant') checked @endif></td>
                        <td>@error('checkbox3')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror</td>
                    </tr>
                    <tr>
                        <td>Capacité d’assumer les responsabilités qui lui sont confiées</td>
                        <td><input type="radio" name="checkbox4" value="excellent" @if(old('checkbox4') == 'excellent') checked @endif></td>
                        <td><input type="radio" name="checkbox4" value="tres-bon" @if(old('checkbox4') == 'tres-bon') checked @endif></td>
                        <td><input type="radio" name="checkbox4" value="satisfaisant" @if(old('checkbox4') == 'satisfaisant') checked @endif></td>
                        <td><input type="radio" name="checkbox4" value="insatisfaisant" @if(old('checkbox4') == 'insatisfaisant') checked @endif></td>
                        <td>@error('checkbox4')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror</td>
                    </tr>
                    <tr>
                        <td>Capacité de travail en groupe</td>
                        <td><input type="radio" name="checkbox5" value="excellent" @if(old('checkbox5') == 'excellent') checked @endif></td>
                        <td><input type="radio" name="checkbox5" value="tres-bon" @if(old('checkbox5') == 'tres-bon') checked @endif></td>
                        <td><input type="radio" name="checkbox5" value="satisfaisant" @if(old('checkbox5') == 'satisfaisant') checked @endif></td>
                        <td><input type="radio" name="checkbox5" value="insatisfaisant" @if(old('checkbox5') == 'insatisfaisant') checked @endif></td>
                        <td>@error('checkbox5')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror</td>
                    </tr>
                    <tr>
                        <td>Facilité d’adaptation aux divers changements rencontrés dans son travail</td>
                        <td><input type="radio" name="checkbox6" value="excellent" @if(old('checkbox6') == 'excellent') checked @endif></td>
                        <td><input type="radio" name="checkbox6" value="tres-bon" @if(old('checkbox6') == 'tres-bon') checked @endif></td>
                        <td><input type="radio" name="checkbox6" value="satisfaisant" @if(old('checkbox6') == 'satisfaisant') checked @endif></td>
                        <td><input type="radio" name="checkbox6" value="insatisfaisant" @if(old('checkbox6') == 'insatisfaisant') checked @endif></td>
                        <td>@error('checkbox6')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror</td>
                    </tr>

                    <tr>
                        <td>Capacité de communiquer par écrit</td>
                        <td><input type="radio" name="checkbox7" value="excellent" @if(old('checkbox7') == 'excellent') checked @endif></td>
                        <td><input type="radio" name="checkbox7" value="tres-bon" @if(old('checkbox7') == 'tres-bon') checked @endif></td>
                        <td><input type="radio" name="checkbox7" value="satisfaisant" @if(old('checkbox7') == 'satisfaisant') checked @endif></td>
                        <td><input type="radio" name="checkbox7" value="insatisfaisant" @if(old('checkbox7') == 'insatisfaisant') checked @endif></td>
                        <td>@error('checkbox7')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror</td>
                    </tr>
                    <tr>
                        <td>Capacité de s’exprimer en public</td>
                        <td><input type="radio" name="checkbox8" value="excellent" @if(old('checkbox8') == 'excellent') checked @endif></td>
                        <td><input type="radio" name="checkbox8" value="tres-bon" @if(old('checkbox8') == 'tres-bon') checked @endif></td>
                        <td><input type="radio" name="checkbox8" value="satisfaisant" @if(old('checkbox8') == 'satisfaisant') checked @endif></td>
                        <td><input type="radio" name="checkbox8" value="insatisfaisant" @if(old('checkbox8') == 'insatisfaisant') checked @endif></td>
                        <td>@error('checkbox8')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror</td>
                    </tr>
                    <tr>
                        <td>A la volonté de progresser</td>
                        <td><input type="radio" name="checkbox9" value="excellent" @if(old('checkbox9') == 'excellent') checked @endif></td>
                        <td><input type="radio" name="checkbox9" value="tres-bon" @if(old('checkbox9') == 'tres-bon') checked @endif></td>
                        <td><input type="radio" name="checkbox9" value="satisfaisant" @if(old('checkbox9') == 'satisfaisant') checked @endif></td>
                        <td><input type="radio" name="checkbox9" value="insatisfaisant" @if(old('checkbox9') == 'insatisfaisant') checked @endif></td>
                        <td>@error('checkbox9')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror</td>
                    </tr>
                    <tr>
                        <td>Tient compte des remarques</td>
                        <td><input type="radio" name="checkbox10" value="excellent" @if(old('checkbox10') == 'excellent') checked @endif></td>
                        <td><input type="radio" name="checkbox10" value="tres-bon" @if(old('checkbox10') == 'tres-bon') checked @endif></td>
                        <td><input type="radio" name="checkbox10" value="satisfaisant" @if(old('checkbox10') == 'satisfaisant') checked @endif></td>
                        <td><input type="radio" name="checkbox10" value="insatisfaisant" @if(old('checkbox10') == 'insatisfaisant') checked @endif></td>
                        <td>@error('checkbox10')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror</td>
                    </tr>
                    <tr>
                        <td>Tient compte des remarques</td>
                        <td><input type="radio" name="checkbox11" value="excellent" @if(old('checkbox11') == 'excellent') checked @endif></td>
                        <td><input type="radio" name="checkbox11" value="tres-bon" @if(old('checkbox11') == 'tres-bon') checked @endif></td>
                        <td><input type="radio" name="checkbox11" value="satisfaisant" @if(old('checkbox11') == 'satisfaisant') checked @endif></td>
                        <td><input type="radio" name="checkbox11" value="insatisfaisant" @if(old('checkbox11') == 'insatisfaisant') checked @endif></td>
                        <td>@error('checkbox11')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror</td>
                    </tr>
                    <tr>
                        <td>S’intéresse aux activités proposées</td>
                        <td><input type="radio" name="checkbox12" value="excellent" @if(old('checkbox12') == 'excellent') checked @endif></td>
                        <td><input type="radio" name="checkbox12" value="tres-bon" @if(old('checkbox12') == 'tres-bon') checked @endif></td>
                        <td><input type="radio" name="checkbox12" value="satisfaisant" @if(old('checkbox12') == 'satisfaisant') checked @endif></td>
                        <td><input type="radio" name="checkbox12" value="insatisfaisant" @if(old('checkbox12') == 'insatisfaisant') checked @endif></td>
                        <td>@error('checkbox12')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror</td>
                    </tr>
                    <tr>
                        <td>Sait être attentif(ve)</td>
                        <td><input type="radio" name="checkbox13" value="excellent" @if(old('checkbox13') == 'excellent') checked @endif></td>
                        <td><input type="radio" name="checkbox13" value="tres-bon" @if(old('checkbox13') == 'tres-bon') checked @endif></td>
                        <td><input type="radio" name="checkbox13" value="satisfaisant" @if(old('checkbox13') == 'satisfaisant') checked @endif></td>
                        <td><input type="radio" name="checkbox13" value="insatisfaisant" @if(old('checkbox13') == 'insatisfaisant') checked @endif></td>
                        <td>@error('checkbox13')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror</td>
                    </tr>
                    <tr>
                        <td>Est capable de travailler seul</td>
                        <td><input type="radio" name="checkbox14" value="excellent" @if(old('checkbox14') == 'excellent') checked @endif></td>
                        <td><input type="radio" name="checkbox14" value="tres-bon" @if(old('checkbox14') == 'tres-bon') checked @endif></td>
                        <td><input type="radio" name="checkbox14" value="satisfaisant" @if(old('checkbox14') == 'satisfaisant') checked @endif></td>
                        <td><input type="radio" name="checkbox14" value="insatisfaisant" @if(old('checkbox14') == 'insatisfaisant') checked @endif></td>
                        <td>@error('checkbox14')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror</td>
                    </tr>
                    <tr>
                        <td>Réalise un travail avec soin et précision</td>
                        <td><input type="radio" name="checkbox15" value="excellent" @if(old('checkbox15') == 'excellent') checked @endif></td>
                        <td><input type="radio" name="checkbox15" value="tres-bon" @if(old('checkbox15') == 'tres-bon') checked @endif></td>
                        <td><input type="radio" name="checkbox15" value="satisfaisant" @if(old('checkbox15') == 'satisfaisant') checked @endif></td>
                        <td><input type="radio" name="checkbox15" value="insatisfaisant" @if(old('checkbox15') == 'insatisfaisant') checked @endif></td>
                        <td>@error('checkbox15')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror</td>
                    </tr>
                    <tr>
                        <td>Respecte les consignes</td>
                        <td><input type="radio" name="checkbox16" value="excellent" @if(old('checkbox16') == 'excellent') checked @endif></td>
                        <td><input type="radio" name="checkbox16" value="tres-bon" @if(old('checkbox16') == 'tres-bon') checked @endif></td>
                        <td><input type="radio" name="checkbox16" value="satisfaisant" @if(old('checkbox16') == 'satisfaisant') checked @endif></td>
                        <td><input type="radio" name="checkbox16" value="insatisfaisant" @if(old('checkbox16') == 'insatisfaisant') checked @endif></td>
                        <td>@error('checkbox16')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <input type="hidden" name="stagiaire_id" value="{{$stagiaire->id}}">
        <input type="hidden" name="sujet_id" value="{{$sujet->id}}">
        <input type="hidden" name="stage_id" value="{{$stage->id}}">
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Soumettre</button>
        </div>
    </form>
</div>
@endsection

