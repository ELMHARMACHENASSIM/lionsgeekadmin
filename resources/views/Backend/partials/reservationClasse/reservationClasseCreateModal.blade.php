<!-- Button trigger modal -->
<button type="button" class="btn btn-noir calen" data-bs-toggle="modal" data-bs-target="#reservationClasseCreate">
    <i class="fa-solid fa-plus text-light"></i>
    Ajouter Reservation
</button>

<!-- Modal -->
<div class="modal fade" id="reservationClasseCreate" tabindex="-1" aria-labelledby="reservationClasseCreateLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 ms-4 fw-bold" id="reservationClasseCreateLabel">Create Class Reservation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body  p-4">
                <div class="">
                    <form action={{ route('reservationClasse.store', $classe) }} method="POST" class="w-[100]">
                        @csrf

                        <div class="d-flex flex-column mt-4">
                            <label class="fw-bold" for="title">Reservation Name: </label>
                            <input class="form-control" type="text" name="title" id="title"
                                placeholder="Reservation" required>
                        </div>

                        <div class="d-flex flex-column mt-4">
                            <label class="fw-bold" for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="3"
                                placeholder="Your Description Here"></textarea>
                        </div>

                        <div class="d-flex flex-column mt-4">
                            <label class="fw-bold" for="day">Reservation Day: </label>
                            <input class="form-control" type="date" name="day" id="day" required
                                min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}">
                        </div>

                        <div class="d-flex flex-column mt-4">
                            <label class="fw-bold" for="start_hour">Starting Hour: </label>
                            <input class="form-control" type="time" name="start_hour" id="start_hour" step="1800"
                                required min="09:00" max="17:30" value="09:30">
                        </div>

                        <div class="d-flex flex-column mt-4">
                            <label class="fw-bold" for="finish_hour">Finishing Hour: </label>
                            <input class="form-control" type="time" name="finish_hour" id="finish_hour"
                                step="1800" required min="09:00" max="17:30" value="17:00">
                        </div>
<div class="d-flex align-item justify-content-center">

    <button class="btn btn-dark mt-4 w-75 fs-6" type="submit">Ajouter </button>
</div>
                    </form>
            </div>
        </div>
    </div>
</div>
