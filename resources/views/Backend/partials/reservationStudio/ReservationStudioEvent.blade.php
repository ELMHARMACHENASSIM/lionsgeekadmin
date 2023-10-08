@extends('layouts.admin.indexAdmin')

@section('admin')
    <section class="content">
        <div class="containerme p-5">
            <h1 class="fs-6 fw-bold ">Modifier la Reservation <span class="text-yellow">*</span></h1>
            <br>
            <div class="d-flex align-items-center justify-content-between">

                <h6 class="text-white ms-2 fs-6">Details</h6>

                <div>
                    <button type="button" class="btn btn-noir  calen" data-bs-toggle="modal"
                        data-bs-target="#eventDetailModal">
                        Update Modal
                    </button>
                    {{-- modale --}}
                    <div class="modal fade" id="eventDetailModal" tabindex="-1" role="dialog"
                        aria-labelledby="eventDetailModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="eventDetailModalLabel">Modifier Data </h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>
                                <div class="modal-body">

                                    <div class="p-2">

                                        <form action={{ route('reservationStudio.update', [$chosenReservation]) }}
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="d-flex flex-column mt-4">
                                                <label for="title">Reservation Title: </label>
                                                <input class="form-control" type="text" name="title" id="title"
                                                    value="{{ old('title', $chosenReservation->title) }}" required>
                                            </div>


                                            <div class="d-flex flex-column mt-4">
                                                <label for="description">Description: </label>
                                                <textarea class="form-control" name="description" id="description" cols="30" rows="3">{{ $chosenReservation->description }}</textarea>
                                            </div>

                                            <div class="d-flex mt-3 mb-2 flex-row-reverse gap-2">

                                                <button class="btn btn-noir calen" id="updateEvent">Update event</button>
                                        </form>

                                        <form action={{ route('reservationStudio.cancel', [$chosenReservation]) }}
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-line calen" type="submit">Cancel Reservation</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <table class="table-material">
            <thead>
                <tr class="">
                    <th class="text-center">Material</th>
                    <th class="">Nom</th>
                    <th class="text-center">Editer</th>
                    <th class="text-center">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chosenReservation->materials as $material)
                    <tr class="p-2">
                        <td class="p-5  me-5  w-0">
                            <div class="infomaterial">
                                <div class="img">
                                    <img src={{ asset('storage/img/material/' . $material->image) }} alt="">
                                </div>
                            </div>
                        </td>
                        <td class="w-25 pt-2 pb-2">
                            <div class="infomaterials">
                                <div class="materialname">
                                    <h2>{{ $material->name }}</h2>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            @include('Backend.partials.reservationStudio.editMaterialModal')
                        </td>
                        {{-- *** --}}
                        <td class="text-center">
                            <form action={{ route('ReservationStudioMat.destroy', [$chosenReservation, $material]) }}
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="" type="submit"><i
                                        class="fa-solid fa-trash-can text-danger"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </section>
@endsection
