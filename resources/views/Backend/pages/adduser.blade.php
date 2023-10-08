@extends('layouts.admin.indexAdmin')

@section('admin')
    <section class="content">
        <div class="containerme p-5 mt-2">

            <div class="infouser">
                <a href={{ route("admin.members") }}>
                    <i class="fa-solid fa-chevron-left me-4"></i></a>
                <h1>Add new member</h1>
            </div>
            @if ($message = Session::get('success'))
            <div class="text-success fade show" role="alert">
                <strong class="text-valid">{{ $message }}</strong>
            </div>
        @endif
        {{-- <h1 class="heading mt-3  ms-5">Informations personnelles</h1> --}}
            <div class="userform mt-5" >
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="labelinput ">
                        <label for="">Nom et prénom</label>
                        <input :value="old('name')" required autofocus autocomplete="name" name="name" type="text" placeholder="Nom et prenom" class="form-control mt-2 p-2" required>
                    </div>
                    <div class="labelinput">
                        <label for="">Email</label>
                        <input id="email" type="email" name="email"
                        :value="old('email')" required autocomplete="username" placeholder="Email" class="form-control mt-2 p-2" required>
                    </div>
                    <div class="labelinput">
                        <label for="formFile" class="form-label">Image de profil
                        </label>
                        <input name="img" class="form-control " type="file" id="formFile">

                    </div>
                    <div class="labelinput pt-2">
                        <label for="">Type de membre</label>
                        <select  name="user_type" class="form-select mt-2" aria-label="Default select example">
                            {{-- <option >Sélectionnez le type de membre</option> --}}
                            <option value="externe">Externe</option>
                            <option value="interne">Interne</option>
                            
                        </select>
                    </div>
                    <div class="labelinput">
                        <label for="">Member Role</label>
                        <div class="checkboxuser mt-3">
                            <div class="checku">
                                <input type="checkbox" id="gestionnaire_classe" name="roles[]" value="gestionnaire_classe" class="checkboxclass">
                                <label for="gestionnaire_classe">Gestion Classe</label>
                            </div>
                            <div class="checku">
                                <input type="checkbox" id="gestionnaire_studio" name="roles[]" value="gestionnaire_studio" class="checkboxclass">
                                <label for="gestionnaire_studio">Gestion Studio</label>
                            </div>
                        </div>
                    </div>

                    
                    
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />

                                    <div class="ml-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' =>
                                                '<a target="_blank" href="' .
                                                route('terms.show') .
                                                '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                __('Terms of Service') .
                                                '</a>',
                                            'privacy_policy' =>
                                                '<a target="_blank" href="' .
                                                route('policy.show') .
                                                '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                __('Privacy Policy') .
                                                '</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif
                    <div class="d-flex align-items-center justify-content-center">

                        <button type="submit" class="rounded mt-4 ">Ajouter un utilisateur</button>
                    </div>
                </form>
            </div>


        </div>


    </section>
@endsection
