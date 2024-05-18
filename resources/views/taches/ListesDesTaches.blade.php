@extends('.navbar/navbarStagiaire')
@section('title')
    Taches
@endsection
@section('content')
    <h1 class="text-center mt-2" style="color: #385170">Les Taches  </h1>
    <div class="container mt-5">
        <div class="card-container">
            @foreach($taches as $al)
                <div class="card @if($al->terminer) terminer-card @endif">
                    <div class="card-body">
                        <h5 class="card-title">{{$al->titre}}</h5>
                        <p class="card-text">{{$al->description}}</p>
                        @if(!$al->terminer)
                            <h6 class="mt-2">Il reste que {{$al->nombre_jours}} jours</h6>
                        @endif
                        <div class="text-end">
                            @if ($al->terminer)
                                <a href="{{route('tacheNonTerminer',$al->id)}}" class="card-link">
                                    <button class="btn btn-success">Terminé</button>
                                </a>
                            @else
                                <a href="{{ route('tacheTerminer', $al->id) }}" class="card-link">
                                    <button class="btn btn-danger" onclick="terminerTache(this)">Non Terminé</button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function terminerTache(button) {
            var card = button.closest('.card');
            card.classList.add('terminer-card');
            var cardText = card.querySelector('.card-text');
            cardText.textContent = '';
            var nombreJours = card.querySelector('h6');
            nombreJours.style.display = 'none';
        }
    </script>
@endsection
