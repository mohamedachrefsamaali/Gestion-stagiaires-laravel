@extends('.navbar/navbar')
@section('title')
    Admin
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-center mt-2"> listes des administrateurs</h2>
                <table class="table table-white table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admins as $u)
                        <tr>
                            <th scope="row">{{$u->name}}</th>
                            <td>{{$u->email}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{route('editAdministrateur',$u->id)}}"><button type="button" class="btn btn-warning mx-2">Modifier</button></a>
                                    <form action="{{route('softDeleteAdmin',$u->id)}}" method="POST">
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
                    <a href="#">
                        <button type="button" class="btn btn-danger mb-2">Delete All</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection








