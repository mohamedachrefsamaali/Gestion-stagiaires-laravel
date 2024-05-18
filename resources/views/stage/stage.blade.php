@extends('.navbar/navbar')
@section('title')
    Stage
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-center mt-2 " style="color: #385170"> listes des Stages</h2>
                <table class="table table-white table-hover">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">type</th>
                        <th scope="col">name</th>
                        <th scope="col">date debut</th>
                        <th scope="col">date fin</th>
                        <th scope="col">proc</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stages as $stage)
                        @foreach($stagePersonnels[$stage->id] as $personnel)
                            <tr>
                                <th scope="row">{{$stage->id}}</th>
                                <td>{{$stage->type}}</td>
                                <td>{{$personnel->name}}</td>
                                <td>{{$stage->date_debut}}</td>
                                <td>{{$stage->date_fin}}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{route('editStage',$stage->id)}}"><button type="button" class="btn btn-warning mx-2">Modifier</button></a>
                                        <form action="{{route('deleteStage',$stage->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger ml-2">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection









