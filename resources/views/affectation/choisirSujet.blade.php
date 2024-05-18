@extends('.navbar/navbar')
@section('title')
    Sujets
@endsection
@section('content')
    <section>
        <h2 class="text-center mt-2"> listes des Sujets:</h2>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-2">

            </div>
            <div class="col-8">

                <table class="table table-white table-hover">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">titre</th>
                        <th scope="col">description</th>
                        <th scope="col">proc</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sujets as $s)
                        <tr>
                            <th scope="row">{{$s->id}}</th>
                            <td>{{$s->titre}}</td>
                            <td>{{$s->description}}</td>
                            <td>

                                <form action="{{ route('affecterSujet', ['id' => $s->id]) }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="sujet_id" value="{{ $s->id }}">
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









