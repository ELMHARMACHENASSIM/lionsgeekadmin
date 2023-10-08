

@extends('layouts.index')

@section('content')
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ session('status') }}
        </div>
    @endif

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
                    <h1>Renitialiser le mot de passe</h1>
                    <h4 class="text-gris">Tapez un mot de passe dont vous vous souviendrez</h4>
                </div>
                <x-validation-errors class=" d-flex w-75 " />


                <form class="form" method="POST" action="{{ route("password.update") }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="email mt-3 mt-md-2 mt-lg-3 d-flex flex-column">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="mt-2 rounded px-3 w-100 bg-transparent text-black" type="email" name="email" :value="old('email', $request->email)" required readonly autofocus autocomplete="username" />

                    </div>

                    <div class="mdp mt-3 mt-md-2 mt-lg-3 d-flex flex-column">
                        <x-label for="password" value="{{ __('Entrez un nouveau mot de passe') }}" />
                        <input class="mt-2 rounded px-3" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" >
                    </div>

                    <div class="mdp mt-3 mt-md-2 mt-lg-3 d-flex flex-column">
                        <x-label for="password" value="{{ __('Retapez un nouveau mot de passe') }}" />
                        <input class="mt-2 rounded px-3" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password">
                    </div>



                    <div class="flex items-center justify-end mt-4">


                        <button type="submit" class="rounded bg-noir text-white">Reinitialiser le mot de passe </button>

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
