@extends("frontend.index")


@section('content')
    <section class="content">
        <div class="containerme p-5">
            @foreach ($allStudios as $studio)
                @if ($studio->id === $chosenStudio->id)
                    <h1 class="fw-semibold">Reservation Du {{ $studio->name }}<span class="text-yellow">*</span></h1>
                    <form class="studioReservationForm" action={{ route('reservationStudio.store', $studio) }} method="POST">
                        <h3 class="mt-4 ms-4 mb-4 text-gris fs-5">Information</h3>
                        @csrf
                        <div class="d-flex align-items-center justify-content-around mt-3">
                            <div class="inputHolder">
                                <label for="title">Title of Reservation</label>
                                <input class="form-control" type="text" name="title" id="title" placeholder="Title"
                                    required>
                            </div>

                            <div class="inputHolder">
                                <label for="day">Day: </label>
                                <input class="form-control" type="date" name="day" id="day" required
                                    min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <br>
                        <div class="d-flex align-items-center justify-content-around mt-3">
                            <div class="inputHolder">
                                <label for="start_hour">Starting Time: </label>
                                <input class="form-control" type="time" name="start_hour" id="start_hour" step="1800"
                                    required min="09:30" max="17:30" value="09:30">
                            </div>

                            <div class="inputHolder">
                                <label for="finish_hour">Finishing Time: </label>
                                <input class="form-control" type="time" name="finish_hour" id="finish_hour"
                                    step="1800" required min="09:30" max="17:30" value="17:30">
                            </div>
                        </div>

                        <div class=" flex justify-center items-center mt-4">
                            <div class="d-flex flex-column w-[90%] ">
                                <label class="fw-bold" for="description">Description of Reservation: </label>
                                <textarea class="form-control" name="description" id="description" placeholder="Description" cols="30"
                                    rows="5"></textarea>
                            </div>
                        </div>


                        <div class="inputHolder mt-5">
                            <label for="finish_hour">Team </label>
                            <input type="text" name="search" id="search" placeholder="Enter search name"
                                class="form-control" onfocus="this.value=''">
                        </div>

                        <div id="search_list"></div>

                        <script>
                            $(document).ready(function() {
                                $('#search').on('keyup', function() {
                                    var query = $(this).val();
                                    $.ajax({
                                        url: "/search",
                                        type: "GET",
                                        data: {
                                            'search': query
                                        },
                                        success: function(data) {
                                            $('#search_list').html(data);
                                        },
                                        error :function(error){
                                            alert("fghjk");
                                            console.error(error)
                                        }
                                    });
                                    //end of ajax call
                                });
                            });
                        </script>



                        <h3 class="mt-4 ms-4">Material</h3>

                        <div class="d-flex align-items-center justify-content-center w-100">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-dark active" id="pills-camera-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-camera" type="button" role="tab"
                                        aria-controls="pills-camera" aria-selected="true">Camera</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-dark" id="pills-casque-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-casque" type="button" role="tab"
                                        aria-controls="pills-casque" aria-selected="false">Casque</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-dark" id="pills-light-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-light" type="button" role="tab"
                                        aria-controls="pills-light" aria-selected="false">Light</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-dark" id="pills-micro-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-micro" type="button" role="tab"
                                        aria-controls="pills-micro" aria-selected="false">Micro</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link text-dark" id="pills-autres-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-autres" type="button" role="tab"
                                        aria-controls="pills-autres" aria-selected="false">Others</button>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-camera" role="tabpanel"
                                    aria-labelledby="pills-camera-tab" tabindex="0">
                                    <div class="scrollMaterial p-1 bg-body-bg">
                                        <table class="tablemain text-center">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>Reference</th>
                                                    <th>N° d'utilisation</th>
                                                    <th>quantité</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($materials as $index => $material)
                                                    @if ($material->disponible === 1 && $material->type === 'camera')
                                                        <tr valign="middle">
                                                            <td>
                                                                <input type="checkbox" class="btn-check"
                                                                    name="materials[]" value={{ $material->id }}
                                                                    id="{{ $material->id }}" autocomplete="off">
                                                                <label class="btn btn-outline-yellow fw-bold"
                                                                    for="{{ $material->id }}">+</label>
                                                            </td>
                                                            <td class="materialImageRes">
                                                                <img src="{{ asset('storage/img/material/' . $material->image) }}"
                                                                    alt="Material Image">
                                                            </td>
                                                            <td class="w-[30%]">
                                                                {{ $material->name }}
                                                            </td>
                                                            <td>
                                                                <p class="w-[200px] m-0">{{ $material->reference }}</p>
                                                            </td>
                                                            <td>
                                                                {{ $material->nombre_utilisation }}
                                                            </td>
                                                            <td>
                                                                {{ $material->quantite }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-casque" role="tabpanel"
                                    aria-labelledby="pills-casque-tab" tabindex="0">
                                    <div class="scrollMaterial p-1 bg-body-bg">
                                        <table class="tablemain text-center">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>Reference</th>
                                                    <th>N° d'utilisation</th>
                                                    <th>Quantité</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($materials as $index => $material)
                                                    @if ($material->disponible === 1 && $material->type === 'casque')
                                                        <tr valign="middle">
                                                            <td>
                                                                <input type="checkbox" class="btn-check"
                                                                    name="materials[]" value={{ $material->id }}
                                                                    id="{{ $material->id }}" autocomplete="off">
                                                                <label class="btn btn-outline-yellow fw-bold"
                                                                    for="{{ $material->id }}">+</label>
                                                            </td>
                                                            <td class="materialImageRes">
                                                                <img src="{{ asset('storage/img/material/' . $material->image) }}"
                                                                    alt="Material Image">
                                                            </td>
                                                            <td>
                                                                <p class="w-[200px] m-0">{{ $material->name }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="w-[200px] m-0">{{ $material->reference }}</p>
                                                            </td>
                                                            <td>
                                                                {{ $material->nombre_utilisation }}
                                                            </td>
                                                            <td>
                                                                {{ $material->quantite }}
                                                            </td>
                                                            <td>
                                                                {{ $material->quantite }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-light" role="tabpanel"
                                    aria-labelledby="pills-light-tab" tabindex="0">
                                    <div class="scrollMaterial p-1 bg-body-bg">
                                        <table class="tablemain text-center">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>Reference</th>
                                                    <th>N° d'utilisation</th>
                                                    <th>Quantité</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($materials as $index => $material)
                                                    @if ($material->disponible === 1 && $material->type === 'light')
                                                        <tr valign="middle">
                                                            <td>
                                                                <input type="checkbox" class="btn-check"
                                                                    name="materials[]" value={{ $material->id }}
                                                                    id="{{ $material->id }}" autocomplete="off">
                                                                <label class="btn btn-outline-yellow fw-bold"
                                                                    for="{{ $material->id }}">+</label>
                                                            </td>
                                                            <td class="materialImageRes">
                                                                <img src="{{ asset('storage/img/material/' . $material->image) }}"
                                                                    alt="Material Image">

                                                            </td>
                                                            <td>
                                                                <p class="w-[200px] m-0">{{ $material->name }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="w-[200px] m-0">{{ $material->reference }}</p>
                                                            </td>
                                                            <td>
                                                                {{ $material->nombre_utilisation }}
                                                            </td>
                                                            <td>
                                                                {{ $material->quantite }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-micro" role="tabpanel"
                                    aria-labelledby="pills-micro-tab" tabindex="0">
                                    <div class="scrollMaterial p-1 bg-body-bg">
                                        <table class="tablemain text-center">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>Reference</th>
                                                    <th>N° d'utilisation</th>
                                                    <th>Quantité</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($materials as $index => $material)
                                                    @if ($material->disponible === 1 && $material->type === 'micro')
                                                        <tr valign="middle">
                                                            <td>
                                                                <input type="checkbox" class="btn-check"
                                                                    name="materials[]" value={{ $material->id }}
                                                                    id="{{ $material->id }}" autocomplete="off">
                                                                <label class="btn btn-outline-yellow fw-bold"
                                                                    for="{{ $material->id }}">+</label>
                                                            </td>
                                                            <td class="materialImageRes">
                                                                <img src="{{ asset('storage/img/material/' . $material->image) }}"
                                                                    alt="Material Image">

                                                            </td>
                                                            <td>
                                                                <p class="w-[200px] m-0">{{ $material->name }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="w-[200px] m-0">{{ $material->reference }}</p>
                                                            </td>
                                                            <td>
                                                                {{ $material->nombre_utilisation }}
                                                            </td>
                                                            <td>
                                                                {{ $material->quantite }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-autres" role="tabpanel"
                                    aria-labelledby="pills-autres-tab" tabindex="0">
                                    <div class="scrollMaterial p-1 bg-body-bg">
                                        <table class="tablemain text-center">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>Reference</th>
                                                    <th>N° d'utilisation</th>
                                                    <th>Quantité</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($materials as $index => $material)
                                                    @if ($material->disponible === 1 && $material->type === 'autres')
                                                        <tr valign="middle">
                                                            <td>
                                                                <input type="checkbox" class="btn-check"
                                                                    name="materials[]" value={{ $material->id }}
                                                                    id="{{ $material->id }}" autocomplete="off">
                                                                <label class="btn btn-outline-yellow fw-bold"
                                                                    for="{{ $material->id }}">+</label>
                                                            </td>
                                                            <td class="materialImageRes">
                                                                <img src="{{ asset('storage/img/material/' . $material->image) }}"
                                                                    alt="Material Image">
                                                            </td>
                                                            <td>
                                                                <p class="w-[200px] m-0">{{ $material->name }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="w-[200px] m-0">{{ $material->reference }}</p>
                                                            </td>
                                                            <td>
                                                                {{ $material->nombre_utilisation }}
                                                            </td>
                                                            <td>
                                                                {{ $material->quantite }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button class="btn btn-dark w-[50%] btnStudioRes" type="submit">Create Reservation</button>
                        </div>
                    </form>
                @endif
            @endforeach
        </div>
    </section>
@endsection
