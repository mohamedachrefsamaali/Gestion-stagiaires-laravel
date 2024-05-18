@extends('.navbar/navbar')
@section('title')
    Encadrants
@endsection
@section('content')
    <section>
        <h2 class="text-center mt-2"> listes des Encadrants</h2>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-2">

            </div>
            <div class="col-8">

                <table class="table table-white table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $u)
                        <tr>
                            <th scope="row">{{$u->id}}</th>
                            <td>{{$u->name}}</td>
                            <td>{{$u->titre}}</td>
                            <td>

                                <form action="{{ route('affecterEncadrant', ['id' => $u->id]) }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="encadrant_id" value="{{ $u->id }}">
                                    <input type="hidden" name="stagiaire_id" value="{{ $stagiaire->id }}">
                                    <button type="submit" class="btn btn-primary">OK</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-2">

            </div>
        </div>
    </div>

    </body>


@endsection









