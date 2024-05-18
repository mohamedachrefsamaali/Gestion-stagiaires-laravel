
@extends('.navbar/navbar')
@section('title')
    Archives
@endsection
@section('content')
    <section>
        <h2 class="text-center mt-3" style="color: #385170"> listes des utilisateurs effacée :</h2>
    </section>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">role</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $u)
            <tr>
                <th scope="row">{{$u->id}}</th>
                <td>{{$u->name}}</td>
                <td>{{$u->email}}</td>
                <td>{{$u->role}}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{route('restore',$u->id)}}"><button type="button" class="btn btn-warning mx-2">Restore</button></a>
                        <form action="{{route('forceDelete',$u->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger ml-2">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        @foreach($admins as $ad)
            <tr>
                <th scope="row">{{$ad->id}}</th>
                <td>{{$ad->name}}</td>
                <td>{{$ad->email}}</td>
                <td>{{$ad->role}}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{route('restoreAdmin',$ad->id)}}"><button type="button" class="btn btn-warning mx-2">Restore</button></a>
                        <form action="{{route('forceDeleteAdmin',$ad->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger ml-2">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="text-center">
        <a  href="{{route('deleteAll')}}"><button type="button" class="btn btn-danger">Supprime tous</button></a>
    </div>


@endsection










