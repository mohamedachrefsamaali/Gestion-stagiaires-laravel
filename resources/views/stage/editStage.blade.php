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
                <h1 class="text-center" style="color: #385170">Modifier Stage</h1>
                <form action="{{route('updateStage',$stage->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Type de Stage</label>
                        <input type="text" name="type" value="{{ old('type', $stage->type) }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @if ($errors->has('type'))
                            <div class="text-danger">{{ $errors->first('type') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Date Debut</label>
                        <input type="date" name="date_debut" value="{{ old('date_debut', $stage->date_debut) }}" class="form-control" id="exampleInputPassword1">
                        @if ($errors->has('date_debut'))
                            <div class="text-danger">{{ $errors->first('date_debut') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputTelephone1" class="form-label">Date Fin</label>
                        <input type="date" name="date_fin" value="{{ old('date_fin', $stage->date_fin) }}" class="form-control" id="exampleInputPassword1">
                        @if ($errors->has('date_fin'))
                            <div class="text-danger">{{ $errors->first('date_fin') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputTelephone1" class="form-label">Listes des stagiaires</label>
                        <select name="stagiaire_id" class="form-control">
                            @foreach($stag as $s)
                                <option value="{{$s->id}}" {{ old('stagiaire_id', $stage->stagiaire_id) == $s->id ? 'selected' : '' }}>{{$s->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('stagiaire_id'))
                            <div class="text-danger">{{ $errors->first('stagiaire_id') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputTelephone1" class="form-label">Listes des sujets</label>
                        <select name="sujet_id" class="form-control">
                            @foreach($sujets as $suj)
                                <option value="{{$suj->id}}" {{ old('sujet_id', $stage->sujet_id) == $suj->id ? 'selected' : '' }}>{{$suj->titre}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('sujet_id'))
                            <div class="text-danger">{{ $errors->first('sujet_id') }}</div>
                        @endif
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
