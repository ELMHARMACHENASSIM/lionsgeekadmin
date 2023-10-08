<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create{{ $material->id }}">
    Show
</button>

<!-- Modal -->
<div class="modal fade" id="create{{ $material->id }}" tabindex="-1" aria-labelledby="create{{ $material->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="create{{ $material->id }}Label">Description</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p> name:{{ $material->name }}</p>
                <h3> qnt:{{ $material->quantite }}</h3>


                @if ($material->disponible)
                    <h3> Etat: disponible</h3>
                @else
                <h3> Etat: non disponible</h3>

                @endif
                <h3> utilisation: {{ $material->nombre_utilisation }}</h3>
            </div>

        </div>
    </div>
</div>
