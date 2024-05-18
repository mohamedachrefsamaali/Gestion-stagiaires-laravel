@extends('.navbar/navbar')
@section('title')
    Consulter
@endsection
@section('content')
    <h1 class="text-center mt-2"  style="color: #385170">Listes des encadrants et leurs stagiaires</h1>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                @foreach($enca as $en)
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $en->id }}" aria-expanded="true" aria-controls="collapse{{ $en->id }}">
                                    {{ $en->name }}
                                </button>
                            </h2>
                            <div id="collapse{{ $en->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th style="color: #9fd3c7;">Nom du stagiaire</th>
                                            <th style="color: #9fd3c7;">Type de stage</th>
                                            <th style="color: #9fd3c7;">Titre du sujet</th>
                                            <th style="color: #9fd3c7;">Date de début</th>
                                            <th style="color: #9fd3c7;">Date de fin</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($stag[$en->id] as $s)
                                            <tr>
                                                <td >{{ $s->name }}</td>
                                                <td>{{ $s->stage->type }}</td>
                                                <td>{{ $s->sujet->titre }}</td>
                                                <td>{{ $s->stage->date_debut }}</td>
                                                <td>{{ $s->stage->date_fin }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
