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
                    <h1>Bienvenue</h1>
                    <h4 class="text-gris">Veuillez changer vos mot de pass</h4>
                </div>


                @if ($message = Session::get("success"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if ($message = Session::get("error"))
                <div class="w-100 text-center fade show">
                    <strong class="text-danger">{{ $message }}</strong>
                </div>
            @endif
                <form class="form" method="POST" action="{{ route("password.reupdate") }}">
                    @csrf
                    @method("PUT")

                    <div class="mdp mt-3 mt-md-2 mt-lg-3 d-flex flex-column">
                        <x-label class="mb-3" for="current_password" value="{{ __('Current Password') }}" />
                        <input id="current_password" type="password" class="rounded px-3" name="current_password" wire:model="state.current_password" autocomplete="current-password" />
                        <x-input-error for="current_password" class="mt-2" />
                    </div>


                    <div class="mdp mt-3 mt-md-2 mt-lg-3 d-flex flex-column">
                        <x-label class="mb-3" for="password" value="{{ __('New Password') }}" />
                        <input id="password" type="password" class="rounded px-3" wire:model="state.password" name="new_password" autocomplete="new-password" />
                        <x-input-error for="password" class="mt-2" />
                    </div>

                    
                    <div class="mdp mt-3 mt-md-2 mt-lg-3 d-flex flex-column">
                        <x-label class="mb-3" for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <input id="password_confirmation" type="password" class="rounded px-3" wire:model="state.password_confirmation" name="confirm_new_password" autocomplete="new-password" />
                        <x-input-error for="password_confirmation" class="mt-2" />
                    </div>

                    
                    


                    <div class="flex items-center justify-end mt-4">


                        <button type="submit" class="rounded bg-noir text-white">Sauvegarder </button>

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
