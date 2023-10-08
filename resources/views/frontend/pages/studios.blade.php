@extends('frontend.index')
@section('content')
    <section class="classes mt-2 p-5">
        <div class="descri ps-5 pe-5">
            <h1>All Studios <span class="text-yellow">*</span></h1>
            <p class="mt-4 text-gris">Découvrez notre service de réservation de studio chez LionsGeek, où la créativité ne
                connaît pas de limites. Choisissez parmi une variété d'espaces inspirants pour vos projets, le tout en
                quelques clics. Réservez le studio de vos rêves dès aujourd'hui et libérez votre potentiel artistique !</p>
        </div>
        
        <div class="container d-flex align-items-center justify-content-center flex-wrap">
            @foreach ($studios as $studio)
                <div class="m-3 studioImage d-flex flex-column align-items-center justify-content-center ">
                    <div class="image d-flex aling-items-center justify-content-center">
                        <img class="mt-3" src="{{ asset('storage/img/studio/'.$studio->images[0]->images ) }}" alt="">
                    </div>
                    <div class="text d-flex align-items-center justify-content-between  pt-3 pb-3">
                        <h1 class="m-0">{{ $studio->name }}</h1>

                        <button class="btn btn-noir">   <a class="nav-link" href={{ route('user.studioShow', $studio) }}>Go to
                            {{ $studio->name }}</a>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
