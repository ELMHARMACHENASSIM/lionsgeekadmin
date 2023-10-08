
@extends('layouts.index')

    @section('content')
    <x-guest-layout>

        <div class="holder w-75 container d-flex align-items-center justify-content-center">
            <div class="row w-100 p-0 m-0 mt-0  ">
                {{-- left --}}
                <div
                    class="height bg-yellow col-5 d-none d-md-flex align-content-center justify-content-center flex-column ">
                    <div class="image d-flex align-items-center justify-content-center">
                        <img src={{ asset('final.png') }}>
                    </div>
                    <h1 class="lions text-noir mt-md-4 mt-lg-5">LIONSGEEK</h1>
                </div>
                {{-- right --}}
                <div class="height col-md-7 d-flex flex-column  justify-content-center align-items-center ">
                    <div class="bienvenu">

                        <h1 class="text-gris">
                            {{ __('Authentification') }}
                        </h1>
                    </div>

<<<<<<< HEAD
                <div class="flex items-center justify-end mt-4">
                    <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
=======
                    <div class="form" x-data="{ recovery: false }">
                        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-show="! recovery">
                            {{ __("Veuillez confirmer l'accès à votre compte en saisissant le code d'authentification fourni par votre application d'authentification.") }}
                        </div>

                        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-cloak x-show="recovery">
                            {{ __("Veuillez confirmer l'accès à votre compte en saisissant l'un de vos codes de récupération d'urgence.") }}
                        </div>

                        <x-validation-errors class="mb-4" />

                        <form method="POST" action="{{ route('two-factor.login') }}">
                            @csrf

                            <div class="mt-4" x-show="! recovery">
                                <x-label for="code" value="{{ __('Code') }}" />
                                <input id="code" class="mt-2 rounded px-3 w-100" type="text" inputmode="numeric"
                                    name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                            </div>

                            <div class="mt-4" x-cloak x-show="recovery">
                                <x-label for="recovery_code" value="{{ __('Recovery Code') }}" />
                                <input id="recovery_code" class="mt-2 rounded px-3 w-100" type="text"
                                    name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                            </div>




                            <div class="flex flex-col-reverse items-center justify-end mt-4">
                                <button type="button"
                                    class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 underline cursor-pointer"
>>>>>>> 619755e4cdd19ea5997e5699d37abdd34b168579
                                    x-show="! recovery"
                                    x-on:click="
                                            recovery = true;
                                            $nextTick(() => { $refs.recovery_code.focus() })
                                        ">
                                    {{ __('Use a recovery code') }}
                                </button>

<<<<<<< HEAD
                    <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                                    x-cloak
                                    x-show="recovery"
=======
                                <button type="button"
                                    class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 underline cursor-pointer"
                                    x-cloak x-show="recovery"
>>>>>>> 619755e4cdd19ea5997e5699d37abdd34b168579
                                    x-on:click="
                                            recovery = false;
                                            $nextTick(() => { $refs.code.focus() })
                                        ">
                                    {{ __('Use an authentication code') }}
                                </button>

                                <button class="ml-4 w-100 btn btn-noir">
                                    {{ __('Log in') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            </x-guest-layout>
        @endsection
