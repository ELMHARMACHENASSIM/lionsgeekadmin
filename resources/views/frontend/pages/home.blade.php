@extends('frontend.index')
@section('content')
    <div class="main d-flex align-items-center justify-content-center">

        <div class="container d-flex align-items-center justify-content-center">
            <div class="w-50 desc">
                <h5 class="fw-light ">Bienvenue sur LionsGeek</h5>
                <h1 > Réservations de Matériel et salle Simplifiés !</h1>
                <p class="text-gris">
                    Nous sommes fiers de vous offrir une expérience fluide et sans tracas lorsqu'il s'agit de réserver du matériel et des studios pour vos projets créatifs. Que vous soyez artiste, musicien, cinéaste ou créateur de contenu.</p>


                    @auth
                    @if (auth()->user()->hasRole('admin'))
                    <!-- Show modal for admin -->
                    <button class="btn btn-noir" data-bs-toggle="modal" data-bs-target="#reservemodaladmin">Reserver</button>
                    @include("frontend.partials.admin redirect.admin_modal")
                @elseif (auth()->user()->hasRole('gestionnaire_studio') && auth()->user()->hasRole('gestionnaire_classe') && !auth()->user()->hasRole('admin'))
                    <!-- User has both roles but not admin, display a specific button -->
                    <button class="btn btn-noir" data-bs-toggle="modal" data-bs-target="#reservemodaldoublerole">Reserver</button>
                    @include("frontend.partials.redirect2role.doublerole_modal")

                @elseif (auth()->user()->hasRole('gestionnaire_studio'))
                    <!-- Redirect to reservation.studio for gestionnaire_studio -->
                    <a href="{{route("reservationStudio.indexfront")}}" class="btn btn-noir">Reserver</a>
                @elseif (auth()->user()->hasRole('gestionnaire_classe'))
                    <!-- Redirect to reservation.classe for classe -->
                    <a href="{{route("reservationClasse.indexfront")}}" class="btn btn-noir">Reserver</a>
                @else
                    <!-- For regular users, change the button text -->
                    <a href="{{route("user.reservation")}}" class="btn btn-noir">Check Calendar</a>
                @endif
                
                @endauth
                

                </div>
            <div>
                <img src="{{ asset('freind.png') }}" alt="">
            </div>
        </div>
    </div>
@endsection
