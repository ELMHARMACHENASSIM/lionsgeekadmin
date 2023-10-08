
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
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
                </div>
            @endif
            <div class="height col-md-7 d-flex flex-column  justify-content-center align-items-center ">
                <div class="bienvenu">
                    <h1 class="text-gris">Vérifiez votre e-mail</h1>
                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Avant de continuer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer par e-mail ? Si vous n'avez pas reçu l'e-mail, nous vous en enverrons volontiers un autre.") }}
                    </div>
                </div>
                <x-validation-errors class=" d-flex w-75 " />


                <div class="flex w-75 items-center justify-around">

                    <a href="{{ route('user.Home') }}"
                        class="underline  btn btn-yellow fw-semibold px-4 h-100 d-flex items-center justify-center text-sm text-noir dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('Confirmer') }}</a>

                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div>
                            <button class="btn text-gris px-5" type="submit">
                                {{ __('Renvoyer') }}
                            </button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf

                        <button type="submit"
                            class="underline btn px-5 text-sm text-gris dark:text-white hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 ml-2">
                            {{ __('Deconnexion') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
