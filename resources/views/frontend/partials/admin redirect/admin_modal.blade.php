<!-- Modal -->
<div class="modal fade" id="reservemodaladmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 w-100 text-center" id="exampleModalLabel">Type de reservation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center align-items-center flex-column gap-2 -bottom-3">
                    <!-- Link 1: Reservation for Classe -->
                    <div class="col-md-6 linkreserve">

                        <a href="{{ route('reservationClasse.index') }}" class="text-decoration-none">
                            <div class="card h-100 p-8 d-flex align-items-center justify-center  bgimage"
                                style="background-image: url('{{ asset('images/bgresclass.jpg') }}')">
                                <h5 class="card-title">Reservation pour Classe</h5>
                            </div>
                        </a>

                    </div>

                    <!-- Link 2: Reservation pour Studio -->
                    <div class="col-md-6 linkreserve">

                        <a href="{{ route('reservationStudio.index') }}" class="text-decoration-none">
                            <div class="card h-100 p-8 d-flex align-items-center justify-center  bgimage"
                                style="background-image: url('{{ asset('images/bgresstudio.jpg') }}')">
                                <h5 class="card-title">Reservation pour Studio</h5>
                            </div>
                        </a>


                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
