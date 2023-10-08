
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
                            <h1>Mot de pass oubliée ?</h1>
                            <h4 class="text-gris">nous vous aiderons à récupérer votre compte</h4>
                        </div>
                        <x-validation-errors class=" d-flex w-75 align-items-center " />
                        @if (session('status'))
                        <div class="w-75 font-medium text-sm text-green-600 dark:text-green-400">
                            Nous vous avons envoyé par e-mail un lien de réinitialisation de votre mot de passe.
                        </div>
                    @endif
        
                        <form class="form" method="POST" action="{{ route("password.email") }}">
                            @csrf
        
                            <div class="email mt-3 mt-md-2 mt-lg-3 d-flex flex-column">
                                <x-label for="email" value="{{ __('Email') }}" />
                                <input class="mt-2 rounded px-3 w-100" id="email" type="email" name="email" :value="old('email')"
                                    required autofocus autocomplete="username" placeholder="Entrer votre Email">
                                    
                            </div>

        
        
                            <div class="flex items-center justify-end mt-4">
        
        
                                <button type="submit" class="rounded bg-noir text-white">Envoyer </button>
        
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endsection
        