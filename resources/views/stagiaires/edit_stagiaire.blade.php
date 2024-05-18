@extends('.navbar/navbar')
@section('title')
    Modifier Stagiaire
@endsection
@section('content')
    <h1 class="text-center">Modifier Stagiaire</h1>
    <div class="container">
        <div class="row">
            <div class="col-2">

            </div>
            <div class="col-8">
                <form action="{{route('updateStagiaire',$user->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nom</label>
                        <input name="name" value="{{$user->name}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputRole1" class="form-label">Rôle</label>
                        <input name="role" value="{{$user->role}}" type="text" class="form-control" id="exampleInputRole1">
                        @error('role')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control" id="exampleInputEmail1">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputTelephone1" class="form-label">Téléphone</label>
                        <input type="tel" name="telephone" value="{{$user->telephone}}" class="form-control" id="exampleInputTelephone1">
                        @error('telephone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputUniversite" class="form-label">Université</label>
                        <input type="text" name="universite" value="{{$user->universite}}" class="form-control" id="exampleInputUniversite">
                        @error('universite')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputNiveau" class="form-label">Niveau d'étude</label>
                        <input name="niveau" value="{{$user->niveau}}" class="form-control" id="exampleInputNiveau">
                        @error('niveau')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary ">Submit</button>
                    </div>
{{--                    @if ($errors->any())--}}
{{--                        <div class="text-danger mt-3">--}}
{{--                            <ul>--}}
{{--                                @foreach ($errors->all() as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    @endif--}}
                </form>
            </div>
            <div class="col-2">

            </div>
        </div>
    </div>
@endsection
