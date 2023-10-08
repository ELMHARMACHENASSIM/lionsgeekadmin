<div class="modal fade" id="deleteclass{{ $classe->id }}" tabindex="-1" aria-labelledby="exampleModalLabelclass"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title text-center w-100 fs-5" id="exampleModalLabelclass">{{ $classe->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
       
            <form class="d-flex align-items-center justify-center flex-col" action={{ route('class.delete', $classe)  }} method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body p-2 w-[80%]">
                    <h6>Êtes-vous sûr de vouloir supprimer la class  {{ $classe->name }}</h6>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-line" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>
