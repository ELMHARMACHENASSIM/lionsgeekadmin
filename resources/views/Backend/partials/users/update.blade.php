<div class="modal fade" id="updateus{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title text-center w-100 fs-5" id="exampleModalLabel">{{ $user->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="d-flex align-items-center justify-center flex-col" action="{{route("adminUser.update" , $user)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-2 w-[80%]">
                    <div class="flex flex-col mt-3 items-start justify-around">
                        <label for="">Nom et Prenom</label>
                        <input class="rounded mt-2 w-100 form-control" type="text" name="name" id="name"
                            value="{{ old('name', $user->name) }}">
                    </div>

                    <div class="flex flex-col mt-3 items-start justify-around">
                        <label for="">Email</label>
                        <input class="rounded mt-2 w-100 form-control" type="text" name="email" id="email"
                            value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="flex flex-col mt-3 items-start justify-around">
                        <label for="">Mot de passe</label>
                        <input class="rounded mt-2 w-100 form-control " type="text" name="password" id="name"
                            placeholder="Entrez un nouveau mot de passe">
                    </div>

                    <div class="labelinput mt-3">
                        <label class="text-start w-100" for="">Type de membre</label>
                        <select name="user_type" class="form-select w-100 mt-2" aria-label="Default select example">
                            @if ($user->userType)
                                <option selected disabled>{{ $user->userType->user_type }}</option>
                            @else
                                <option selected disabled>No User Type</option>
                            @endif
                            <option value="externe">Externe</option>
                            <option value="interne">Interne</option>

                        </select>
                    </div>

                    <div class="labelinput w-100 mt-3">
                        <label class="w-100 text-start" for="">Member Role</label>
                        <div class="checkboxuser d-flex w-100 justify-content-evenly mt-2">
                            <div class="checku">
                                <input type="checkbox" id="gestionnaire_classe" name="roles[]" value="gestionnaire_classe" class="checkboxclass"
                                    @if ($user->hasRole('gestionnaire_classe')) checked @endif>
                                <label for="gestionnaire_classe">Gestion Classe</label>
                            </div>
                            <div class="checku">
                                <input type="checkbox" id="gestionnaire_studio" name="roles[]" value="gestionnaire_studio" class="checkboxclass"
                                    @if ($user->hasRole('gestionnaire_studio')) checked @endif>
                                <label for="gestionnaire_studio">Gestion Studio</label>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="mt-4 mb-4">
                    <button type="submit" class="btn btn-noir">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>
