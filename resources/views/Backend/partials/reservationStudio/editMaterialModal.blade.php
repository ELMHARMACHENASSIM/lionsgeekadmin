<!-- Button trigger modal -->
<button type="button" data-bs-toggle="modal" data-bs-target="#update{{ $material->id }}">
    <i class="fa-solid fa-pen-to-square iconcolor"></i>

</button>

<!-- Modal -->
<div class="modal fade" id="update{{ $material->id }}" tabindex="-1" aria-labelledby="update{{ $material->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ps-3 pe-3">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="update{{ $material->id }}Label">Modifier le material</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="mt-3" action="{{ route('material.update', $material->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mt-2">
                        <label for="nombre_utilisation">nombre_utilisation</label>
                        <input class="form-control" disabled min="0" type="number" id="nombre_utilisation"
                            name="nombre_utilisation" value="{{ old('name', $material->nombre_utilisation) }}" required>
                    </div>
                    <div class="mt-2">
                        <label for="disponible">le material est disponible</label>
                        <select class="form-control" name="disponible" id="disponible" required>
                            <option disabled>choisi option</option>
                            <option value="1"
                                {{ old('disponible', $material->disponible) == '1' ? 'selected' : '' }}>Bon Etat
                            </option>
                            <option value="0"
                                {{ old('disponible', $material->disponible) == '0' ? 'selected' : '' }}>Defectueux
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-noir mt-3 mb-3">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>
