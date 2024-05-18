@extends('.navbar/navbar')
@section('title')
    Ajouter Encadrant
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-6">
                <img src="{{asset('personne.png')}}" alt="office" width="100%" height="100%">
            </div>
            <div class="col-6">
                <h1 class="text-center" style="color: #385170">Ajouter des Encadrants</h1>
                <form  action="{{route('storeE')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="examplename" class="form-label">Nom</label>
                        <input type="text" name="name" placeholder="enter your name" class="form-control" id="examplename"  value="{{ old('name') }}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" placeholder="enter email" class="form-control" id="exampleInputPassword1" value="{{ old('email') }}">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputTelephone1" class="form-label">Telephone</label>
                        <input type="tel" name="telephone" placeholder="enter telephone" class="form-control" id="exampleInputPassword1" value="{{ old('telephone') }}">
                        @error('telephone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputUniversite" class="form-label">Password</label>
                        <input type="password" name="password" placeholder="enter password" class="form-control" id="exampleInputPassword1">
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputtitre" class="form-label">Titre</label>
                        <input name="titre" placeholder="enter titre" class="form-control" id="exampleInputPassword1" value="{{ old('titre') }}">
                        @error('titre')
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
