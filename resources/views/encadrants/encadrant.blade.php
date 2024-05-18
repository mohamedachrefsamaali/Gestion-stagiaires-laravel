@extends('.navbar/navbar')
@section('title')
        Encadrants
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-center mt-2 " style="color: #385170"> listes des Encadrants</h2>
                <table class="table table-white table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $u)
                        <tr>
                            <th scope="row">{{$u->name}}</th>
                            <td>{{$u->email}}</td>
                            <td>{{$u->telephone}}</td>
                            <td>{{$u->titre}}</td>
                            <td>
                                <div class="d-flex">
                                <a href="{{route('editEncadrant',$u->id)}}"><button type="button" class="btn btn-warning mx-2">Modifier</button></a>
                                <form action="{{route('destroyEncadrant',$u->id)}}" method="POST">
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
                <div class="text-center">
                    <a href="{{route('deleteAllEncadrant')}}">
                        <button type="button" class="btn btn-danger">Supprimer tous</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection









