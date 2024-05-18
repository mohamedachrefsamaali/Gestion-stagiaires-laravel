@extends('.navbar/navbarEncadrant')
@section('title')
    Taches
@endsection
@section('content')
    <h1 class="text-center mt-2" style="color: #385170">Les Taches de : {{$stagiaire->name}} </h1>
    <div class="container mt-5">
        <div class="card-container">
            @foreach($taches as $al)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$al->titre}}</h5>
                        <p class="card-text">{{$al->description}}</p>
                        @if($al->terminer)
                            <h6 class="mt-2 text-success">Tâche terminée</h6>
                        @else
                            <h6 class="mt-2">Il reste que {{$al->nombre_jours}} jours</h6>
                        @endif
                        <div class="text-end">
                            <div class="d-flex">
                                <a href="{{route('editTache',$al->id)}}" class="card-link">
                                    <button class="btn btn-warning mx-2">Modifier</button>
                                </a>
                                <form action="{{route('deleteTache',$al->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
