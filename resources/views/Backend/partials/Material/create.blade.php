<!-- Button trigger modal -->
<button type="button" class="btn btn-noir  mttr " data-bs-toggle="modal" data-bs-target="#createNewMaterial">
   + &nbsp; Ajouter matérial
</button>

<!-- Modal -->
<div class="modal fade" style="z-index: 11111" id="createNewMaterial" tabindex="-1" aria-labelledby="createNewMaterialLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ps-3 pe-3">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createNewMaterialLabel">Ajouter un matérial</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="mt-3" action="{{ route('material.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mt-2">
                        <label for="name" class=" mb-1">Nom de Matérial</label>
                        <input class="form-control" type="text" id="name" name="name" required>
                    </div>
                    <div class="mt-2">
                        <label for="reference" class=" mb-1">Reference de Matérial</label>
                        <input class="form-control" type="text" id="reference"  name="reference" >
                    </div>
                    <div class="mt-2">
                         <label for="type" class=" mb-1">Type de material</label>
                        <select name="type" class="form-control fs-6 text-gris" id="type">
                            <option selected disabled >Choisire le type de Material</option>
                            @foreach ($types as $type)
                                <option value="{{$type}}">{{$type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="quantite" class=" mb-1">quantite</label>
                        <input class="form-control" type="number" id="quantite" name="quantite" required>
                    </div>
                    <div class="mt-2">
                        <label for="image" class=" mb-1">Upload l'image</label>
                        <input class="form-control" type="file" id="image" name="image" required>
                    </div>
                    {{-- <div class="mt-2">
                        <label for="nombre_utilisation">nombre_utilisation</label>
                        <input class="form-control" type="number" id="nombre_utilisation" name="nombre_utilisation" required>
                    </div> --}}
                    <div>
                        <label for="disponible" class=" mb-1">le material est disponible</label>
                        <select class="form-control" name="disponible" id="disponible" required>
                            <option disabled selected>choisi option</option>
                            <option value={{1}} >disponible</option>
                            <option value={{0}}>Non disponible</option>
                        </select>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">

                        <button type="submit" class="btn btn-noir mt-3 mb-3 mttr">Ajouter le matérial</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
