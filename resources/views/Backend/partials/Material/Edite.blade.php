<!-- Button trigger modal -->
<button type="button"  data-bs-toggle="modal" data-bs-target="#update{{$material->id}}">
    <i class="fa-solid fa-pen-to-square iconcolor"></i>

  </button>

  <!-- Modal -->
  <div class="modal fade" id="update{{$material->id}}" tabindex="-1" aria-labelledby="update{{$material->id}}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content ps-3 pe-3">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="update{{$material->id}}Label">Modifier le material</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="mt-3" action="{{ route("material.update",$material->id)}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="mt-2">
                    <label for="name">Ecrire le nom de Material</label>
                    <input class="form-control" type="text" id="name" name="name" required value="{{old("name",$material->name)}}">
                </div>
                <div class="mt-2">
                    <label for="reference">Ecrire le reference de Material</label>
                    <input class="form-control" type="text" id="reference" name="reference" value="{{old("name",$material->reference)}}">
                </div>
                <div class="mt-2">
                    <label for="type">Ecrire le type de Material</label>
                    <input class="form-control" type="text" id="type" name="type" value="{{old("name",$material->type)}}">
                </div>
                <div class="mt-2">
                    <label for="quantite">quantite</label>
                    <input class="form-control" min="0" type="number" id="quantite" name="quantite" value="{{old("name",$material->quantite)}}" required>
                </div>
                <div class="mt-2">
                    <label for="image">Upload l'image</label>
                    <input class="form-control" type="file" id="image" name="image">
                </div>
                <div class="mt-2">
                    <label for="nombre_utilisation">nombre_utilisation</label>
                    <input class="form-control" disabled min="0" type="number" id="nombre_utilisation" name="nombre_utilisation" value="{{old("name",$material->nombre_utilisation)}}" required>
                </div>
                <div>
                    <label for="disponible">le material est disponible</label>
                    <select class="form-control" name="disponible" id="disponible" required>
                        <option disabled>choisi option</option>
                        <option value="1" {{ old('disponible', $material->disponible) == '1' ? 'selected' : '' }}>disponible</option>
                        <option value="0" {{ old('disponible', $material->disponible) == '0' ? 'selected' : '' }}>Non disponible</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-noir mt-3 mb-3">Modifier</button>
            </form>
        </div>
      </div>
    </div>
  </div>