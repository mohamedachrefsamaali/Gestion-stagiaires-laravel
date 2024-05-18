@extends('.navbar/navbar')
@section('title')
    Sujet
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-6">
                <img src="{{asset('addsujet.png')}}" alt="office" width="100%" height="100%">
            </div>
            <div class="col-6">
                <h1 class="text-center mt-2 mb-4" style="color: #385170">Ajouter des Sujets</h1>
                <form  action="{{route('createSujet')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Titre</label>
                        <input type="text" name="titre" placeholder="enter titre" value="{{ old('titre') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('titre')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Description</label>
                        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary ">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-2">

        </div>
    </div>
@endsection
