
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
                    <h1>Confirmer Mot de pass ?</h1>
                    <h4 class="text-gris">
                    {{ __('vous devez confirmer votre mot de passe avant de continuer.') }}
                    </h4>
                </div>
                <x-validation-errors class=" d-flex w-75 align-items-center " />
                @if (session('status'))
                <div class="w-75 font-medium text-sm text-green-600 dark:text-green-400">
                    vous devez confirmer votre mot de passe avant de continuer
                </div>
            @endif

                <form class="form" method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="email mt-3 mt-md-2 mt-lg-3 d-flex flex-column">
                        <x-label for="password" value="{{ __('Mot de pass') }}" />
                        <input class="mt-2 rounded px-3 w-100" type="password" name="password" placeholder="Entrer voytr mot de passe" required autocomplete="current-password" autofocus>
                            
                    </div>



                    <div class="flex items-center justify-end mt-4">


                        <button type="submit" class="rounded bg-noir text-white">
                            {{ __('Confirm') }}
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
