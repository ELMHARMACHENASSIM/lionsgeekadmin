@extends('frontend.index')
@section('content')
    <section class="classes mt-2 p-5">
        <div class="descri ps-5 pe-5">
            <h1>All Classes <span class="text-yellow">*</span></h1>
            <p class="mt-4 text-gris">LionsGeek propose une gamme de salles de classe bien équipées, parfaites pour
                accueillir des conférences et des classes de toutes tailles. Faites passer votre enseignement au niveau
                supérieur avec nos solutions de réservation flexibles, conçues pour répondre à vos besoins.</p>
        </div>
        <div class="d-flex align-items-center justify-content-center flex-wrap">
            @foreach ($classes as $classe)
                <div class="m-3 studioImage d-flex flex-column align-items-center justify-content-center ">
                    <div class="image d-flex aling-items-center justify-content-center">
                        <img class="mt-3" src="{{ asset('storage/img/classe/' .$classe->images[0]->images ) }}" alt="">
                    </div>
                    <div class="text d-flex align-items-center justify-content-between  pt-3 pb-3">
                        <h1 class="fs-6">{{ $classe->name }}</h1>
                        {{-- !!!!!!!!! fin ghadi ydar lien --}}
                        <button class="btn btn-noir"> 
                            <a class="nav-link" href={{route("user.classShow", $classe)}}>Aller a {{$classe->name}}</a>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

    </section>
@endsection
