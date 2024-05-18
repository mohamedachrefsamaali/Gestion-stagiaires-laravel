@extends('.navbar/navbar')
@section('title')
        Stagiaires
@endsection
@section('content')
    <h2 class="text-center mt-2" style="color: #385170">Liste des Stagiaires</h2>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-white table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telephone</th>
                            <th scope="col">Université</th>
                            <th scope="col">Niveau d'étude</th>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $u)
                            <tr>
                                <th scope="row">{{$u->name}}</th>
                                <td>{{$u->email}}</td>
                                <td>{{$u->telephone}}</td>
                                <td>{{$u->universite}}</td>
                                <td>{{$u->niveau}}</td>
                                <td><img src="{{Storage::url($u->path)}}" alt="" style="width: 100px" >
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{route('editStagiaire', $u->id)}}"><button type="button" class="btn btn-warning mx-2">Modifier</button></a>
                                        <form action="{{route('destroyStagiaire', $u->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger ml-2">Supprimer au archive</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center">
                <a href="{{route('deleteAllStagiaire')}}">
                    <button type="button" class="btn btn-danger">Supprimer tous</button>
                </a>
            </div>
        </div>
    </div>
@endsection







