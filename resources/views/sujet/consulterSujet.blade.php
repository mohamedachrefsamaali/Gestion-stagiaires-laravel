@extends('.navbar/navbar')
@section('title')
    Sujet
@endsection
@section('content')
    <h1 class="text-center mt-2" style="color: #385170">Listes des Sujets</h1>
    <div class="container mt-5">
        <div class="card-container">
            @foreach($all as $al)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$al->titre}}</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary"></h6>
                        <p class="card-text">{{$al->description}}</p>
                            <div class="d-flex">
                                <a href="{{route('editSujet',$al->id)}}" class="card-link">
                                    <button class="btn btn-warning mx-2">Modifier</button>
                                </a>
                                <form action="{{route('destroySujet',$al->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
