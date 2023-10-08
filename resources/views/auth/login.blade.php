@extends('layouts.index')

@section('content')
    <div class="holder container d-flex align-items-center justify-content-center">
        <div class="row w-100 p-0 m-0 mt-0  ">
            {{-- left --}}
            <div class="height bg-yellow col-5 d-none d-md-flex align-content-center justify-content-center flex-column ">
                <div class="image d-flex align-items-center justify-content-center">
                    <img src={{ asset('final.png') }}>
                </div>
                <h1 class="lions text-noir mt-md-4 mt-lg-5">LIONSGEEK</h1>
            </div>
            {{-- right --}}
            <div class="height col-md-7 d-flex flex-column  justify-content-center align-items-center ">
                <div class="bienvenu">
                    <h1>Bienvenue</h1>
                    <h4 class="text-gris">Veuillez entrer vous coordonnées</h4>
                </div>
                <x-validation-errors class=" d-flex w-75 " />

                @if ($message = Session::get('success'))
                    <div class="alert-dismissible fade show" role="alert">
                        <strong class="text-success">{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ session('status') }}
                    </div>
                @endif --}}

                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="email mt-3 mt-md-2 mt-lg-3 d-flex flex-column">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <input class="mt-2 rounded px-3 w-100" id="email" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username"
                            placeholder="Entrer votre Email">
                    </div>

                    <div class="mdp mt-3 mt-md-2 mt-lg-3 d-flex flex-column">
                        <x-label for="password" value="{{ __('Mot de passe') }}" />
                        <input class="mt-2 rounded px-3" id="password" class="block mt-1 w-full" type="password"
                            name="password" required autocomplete="current-password" placeholder="**************">
                    </div>



                    <div class="flex items-center justify-end mt-4">


                        <button type="submit" class="rounded bg-noir text-white">Se connecté </button>

                    </div>

                    @if (Route::has('password.request'))
                        <div class="oublie text-end mt-3 mb-3  mt-lg-4 mb-lg-4">
                            <a href="{{ route('password.request') }}"class="text-yellow text-decoration-none">Mot de
                                passe oublié ?</a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
