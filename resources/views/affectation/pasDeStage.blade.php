@extends('.navbar/navbar')
@section('title')
    Stage
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <img src="{{asset('addp.png')}}" alt="office" width="100%" height="100%">
            </div>
            <div class="col-6">
                <h1 class="text-center">Ajouter des Stages</h1>
                <form action="{{route('creerStagePasdeStage')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Type de Stage</label> <br/>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="stageEte" value="Stage d'été" {{ old('type') == "Stage d'été" ? 'checked' : '' }}>
                            <label class="form-check-label" for="stageEte">
                                Stage d'été
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="stagePfe" value="Stage PFE" {{ old('type') == "Stage PFE" ? 'checked' : '' }}>
                            <label class="form-check-label" for="stagePfe">
                                Stage PFE
                            </label>
                        </div>
                        @error('type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Date Debut</label>
                        <input type="date" name="date_debut"  class="form-control" id="exampleInputPassword1" value="{{ old('date_debut') }}">
                        @error('date_debut')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputTelephone1" class="form-label">Date Fin</label>
                        <input type="date" name="date_fin"  class="form-control" id="exampleInputPassword1" value="{{ old('date_fin') }}">
                        @error('date_fin')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputTelephone1" class="form-label">Nom de stagiaire</label>
                        <p>{{$stagiaire->name}}</p>
                        <input type="hidden" name="stagiaire_id" value="{{$stagiaire->id}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputTelephone1" class="form-label">Listes des sujets</label>
                        <select name="sujet_id" class="form-control">
                            @foreach($sujets as $suj)
                                <option value="{{$suj->id}}" {{ old('sujet_id') == $suj->id ? 'selected' : '' }}>{{$suj->titre}}</option>
                            @endforeach
                        </select>
                        @error('sujet_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary ">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
