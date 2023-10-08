@extends('frontend.index')
@section('content')
    <section class="classes mt-2 p-5">
        <div class="descri ps-5 pe-5">
            <h1>All Material <span class="text-yellow">*</span></h1>
            <p class="mt-4 text-gris">
                LionsGeek rationalise les réservations de matériel, offrant une large gamme d'équipements de haute qualité
                pour vos efforts créatifs. Des caméras au matériel d'éclairage et au-delà, réservez les outils dont vous
                avez besoin sans effort et améliorez vos projets.
            </p>
        </div>
        <div class="d-flex align-items-center justify-content-center flex-wrap">
            @foreach ($materials as $material)
            <div class="m-3 materialImage d-flex flex-column align-items-center justify-content-center ">
                <div class="image d-flex aling-items-center justify-content-center">
                    <img class="mt-3" src="{{asset('storage/img/material/' . $material->image)}}" alt="">
                </div>
                <div class="text  pt-3 pb-3">
                    <h1>{{$material->name}}</h1>
                    <div class="desc d-flex align-items-center justify-content-between">
                        <h4 class="text-gris"><span class="bold">Ref: </span>H-HSA1203hg</h4>
                        <h5 class="{{ $material->disponible ? 'text-yellow' : 'text-danger' }} ">{{ $material->disponible ? 'disponible' : 'non disponible' }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@endsection
