@extends('.navbar/navbarEncadrant')
@section('title')
    Modifier Tache
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <img src="{{asset('addp.png')}}" alt="office" width="100%" height="100%">
            </div>
            <div class="col-6">
                <h1 class="text-center" style="color: #385170">Modifier Tache</h1>
                <form  action="{{route('updateTache', $tache->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">titre</label>
                        <input type="text" name="titre" placeholder="enter titre"
                               class="form-control @error('titre') is-invalid @enderror"
                               id="exampleInputEmail1" aria-describedby="emailHelp"
                               value="{{ old('titre', $tache->titre) }}">
                        @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $tache->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputDate1" class="form-label">Date de début</label>
                        <input type="date" name="date_debut" class="form-control @error('date_debut') is-invalid @enderror" id="exampleInputDate1" value="{{ old('date_debut', $tache->date_debut) }}">
                        @error('date_debut')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputDate2" class="form-label">Date de fin</label>
                        <input type="date" name="date_fin" class="form-control @error('date_fin') is-invalid @enderror" id="exampleInputDate2" value="{{ old('date_fin', $tache->date_fin) }}">
                        @error('date_fin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="stagiaire_id" value="{{$tache->stagiaire_id}}">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary ">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
