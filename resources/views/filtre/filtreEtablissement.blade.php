@extends('.navbar/navbar')

@section('title')
    Stagiaires
@endsection

@section('content')
    <h2 class="text-center mt-2">Liste des Stagiaires par Etablissement</h2>
    <div class="mt-2 mb-2 d-flex justify-content-end" style="margin-right: 10px;">
        <a href="{{ route('stagiaires') }}"><button type="button" class="btn btn-primary mx-2">Retour liste des stagiaires</button></a>
        <a href="{{route('filtreParSujet')}}"><button type="button" class="btn btn-primary ml-2">Filtre par sujet</button></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-white table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telephone</th>
                            <th scope="col">Niveau d'étude</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($universitesUniques as $universite)
                            <tr>
                                <td colspan="5" class="text-center bg-light"><strong>{{ $universite }}</strong> ({{ $resultat[$universite]->count() }} stagiaires)</td>
                            </tr>
                            @foreach($resultat[$universite] as $stagiaire)
                                <tr>
                                    <th scope="row">{{ $stagiaire->name }}</th>
                                    <td>{{ $stagiaire->email }}</td>
                                    <td>{{ $stagiaire->telephone }}</td>
                                    <td>{{ $stagiaire->niveau }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('editStagiaire', $stagiaire->id) }}"><button type="button" class="btn btn-warning mx-2">Modifier</button></a>
                                            <form action="{{ route('destroyStagiaire', $stagiaire->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger ml-2">Supprimer au archive</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('deleteAllStagiaire') }}">
                <button type="button" class="btn btn-danger">Supprimer tous</button>
            </a>
        </div>
    </div>
@endsection






