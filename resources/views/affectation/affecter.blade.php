@extends('.navbar/navbar')
@section('title')
    Affecter
@endsection
@section('content')

   <div class="container">
       <div class="row">
           <div class="col-5">
               <img src="{{asset('aff.png')}}" alt="office" width="100%" height="100%">
           </div>
           <div class="col-7">
               <h1 class="text-center mt-2 mb-4"  style="color: #385170" >Vous pouvez choisir un stagiaire</h1>
               <table class="table table-white table-hover">
                   <thead>
                   <tr>
                       <th scope="col">id</th>
                       <th scope="col">name</th>
                       <th scope="col">proc</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($stag as $u)
                       <tr>
                           <th scope="row">{{$u->id}}</th>
                           <td>{{$u->name}}</td>
                           <td>
                               @if ($u->encadrant_id)
                                   <a href="{{route('RejeterEncadrant',$u->id)}}"><button type="button" class="btn btn-success">Encadrant Affecté</button></a>
                               @else
                                   <a href="{{route('goAffecter', $u->id)}}"><button type="button" class="btn btn-primary">Affecter encadrant</button></a>
                               @endif
                                   @if ($u->sujet_id)
                                       <a href="{{route('RejeterSujet',$u->id)}}"><button type="button" class="btn btn-success">Sujet Affecté</button></a>
                                   @else
                                       <a href="{{route('goAffecterSujet', $u->id)}}"><button type="button" class="btn btn-primary">Affecter Sujet</button></a>
                                   @endif
                                   @if ($u->stage_id)
                                       <a href="#"><button type="button" class="btn btn-success">Stage Reservé</button></a>
                                   @else
                                       <a href="{{ route('pasDeStage',$u->id) }}"><button type="button" class="btn btn-primary">Pas de Stage</button></a>
                                   @endif

                           </td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>
           </div>
       </div>
   </div>
@endsection

