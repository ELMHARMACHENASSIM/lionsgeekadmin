@extends('layouts.admin.indexAdmin')
@section('admin')
    <section class="content">
        <div class="containerme p-5">

            <h1 class=" fw-semibold fs-5">Calendrier des salles <span class="text-yellow">*</span></h1>
            <table class="tablemain text-center">
                <thead>
                    <tr>
                        <th class="fs-6 col-30">Name</th>
                        <th class="fs-6 col-30">Image</th>
                        <th class="fs-6 col-30">Show</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $index => $classe)
                        @if ($classe->disponible)
                            <tr>
                                <td class="fs-5 col-30">
                                    {{ $classe->name }}
                                </td>
                                <td class="col-30">
                                    <div id="carouselExampleback{{ $index }}" class="carousel slide widthslide">
                                        <div
                                            class="carousel-inner childslid d-flex align-items-center justify-content-center">
                                            @foreach ($classe->images as $image)
                                                <div
                                                    class="carousel-item imgslid  @if ($loop->first) active @endif">
                                                    <img src="{{ asset('storage/img/classe/' . $image->images) }}"
                                                        class=" w-100" alt="...">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev prvbtn" type="button"
                                            data-bs-target="#carouselExampleback{{ $index }}" data-bs-slide="prev">
                                            <i class="fa-solid fa-chevron-left colorarrow" aria-hidden="true"></i>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next nxtvbtn" type="button"
                                            data-bs-target="#carouselExampleback{{ $index }}" data-bs-slide="next">
                                            <i class="fa-solid fa-chevron-right colorarrow" aria-hidden="true"></i>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </td>
                                <td class="col-30">
                                    <a href={{ route('reservationClasse.info', $classe) }}>
                                        <button class="btn btn-noir calen">
                                            Calendrier vue
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
