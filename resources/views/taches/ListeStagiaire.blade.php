@extends('.navbar/navbarEncadrant')
@section('title')
    Taches
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-center mt-2" style="color: #385170"> listes des Stagiaires:</h2>
                <table class="table table-white table-hover">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">proc</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stagiaires as $u)
                        <tr>
                            <th scope="row">{{$u->id}}</th>
                            <td>{{$u->name}}</td>
                            <td>{{$u->email}}</td>
                            <td>
                                <a href="{{route('ajouterTache',$u->id)}}"><button type="button" class="btn btn-warning">Ajouter Tache</button></a>
                                <a href="{{route('getTacheDeStag',$u->id)}}"><button type="button" class="btn btn-primary">Les Taches</button></a>
                                @php
                                    $evaluated = false;
                                    $evaluationId = null;
                                    $noteSur20 = 0;
                                @endphp

                                @foreach($evaluations as $ev)
                                    @if($ev->stagiaire_id == $u->id && $ev->stage_id != null)
                                        @php
                                            $evaluated = true;
                                            $evaluationId = $ev->id;
                                            $noteSur20 = $ev->note; // Récupération de la note depuis l'évaluation
                                        @endphp
                                    @endif
                                @endforeach

                                @if($evaluated)
                                    <a href="{{ route('RejeterEvaluation', $evaluationId) }}"><button type="button" class="btn btn-success">Évalué</button></a>
                                    <span>Note : {{$noteSur20}}/20</span>
                                @else
                                    <a href="{{ route('goPageEvaluer', $u->id) }}"><button type="button" class="btn btn-danger">Évaluer</button></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
