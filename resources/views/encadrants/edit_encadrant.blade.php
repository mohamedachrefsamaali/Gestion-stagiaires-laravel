@extends('.navbar/navbar')
@section('title')
    Modifier Encadrant
@endsection
@section('content')
    <h1 class="text-center" style="color: #385170">Modifier Encadrant</h1>
    <div class="container">
        <div class="row">
            <div class="col-2">

            </div>
            <div class="col-8">
                <form action="{{route('updateEncadrant',$user->id)}}" method="POST">
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
                        <label for="exampleInputtitre" class="form-label">Titre</label>
                        <input name="titre" value="{{$user->titre}}" class="form-control" id="exampleInputNiveau">
                        @error('titre')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                   <div class="text-center">
                       <button type="submit" class="btn btn-primary">Modifier</button>
                   </div>
{{--                    @if ($errors->any())--}}
{{--                        <div class="alert alert-danger mt-3">--}}
{{--                            <ul>--}}
{{--                                @foreach ($errors->all() as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    @endif--}}
                </form>
            <div class="col-2">

            </div>
        </div>
    </div>
@endsection

