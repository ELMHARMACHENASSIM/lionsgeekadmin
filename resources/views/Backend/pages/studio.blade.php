@extends('layouts.admin.indexAdmin')

@section('admin')
    <section class="content">
        <div class="containerme p-5">
            <div class="main-title">
                <div class="info">
                    <h1>Studio <span class="text-yellow">*</span></h1>
                </div>

                <button class="btnAddClass" data-bs-toggle="modal" data-bs-target="#addStudio">

                    <i class="fa-solid fa-plus text-yellow"></i>
                    <span class="text-light">Ajouter un nouveau Studio</span>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="addStudio" tabindex="-1" aria-labelledby="addStudioLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header modalborder">
                                <h1 class="modal-title" id="addStudioToggleLabel2">Ajouter</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body ">
                                <div class="containerme p-2 pb-4">
                                    <div class="classform">

                                        <form action={{ route('studio.store') }} method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="labelinput">
                                                <label for="">Nom de studio</label>
                                                <input type="text" name="name" placeholder="Nom de studio"
                                                    class="form-control mt-2 p-2" required>
                                            </div>
                                            <div class="labelinput">
                                                <label for="formFile" class="form-label">Upload image
                                                </label>
                                                <input class="form-control " name="images[]" type="file" id="formFile"
                                                    multiple>

                                            </div>
                                            <button type="submit" class="rounded">Ajouter studio</button>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <table class="table-classe">
                <thead>
                    <tr>
                        <th class="text-center">Nom</th>
                        <th class="text-center">images </th>
                        <th class="text-center">Disponible</th>
                        <th class="text-center">N° Utilisation</th>
                        <th class="text-center">Editer</th>
                        <th class="text-center"> Supprimer</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($studios as $index => $studio)
                        <tr>
                            <td class="text-center">
                                <h2>{{ $studio->name }}</h2>
                            </td>
                            <td class=" text-center">
                                {{-- slide --}}
                                <div id="carouselExample{{ $index }}" class="carousel slide widthslide">
                                    <div class="carousel-inner childslide">
                                        @foreach ($studio->images as $image)
                                            <div
                                                class="carousel-item imgslide @if ($loop->first) active @endif">
                                                <img src="{{ asset('storage/img/studio/' . $image->images) }}"
                                                    class=" w-100" alt="...">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev prvbtn" type="button"
                                        data-bs-target="#carouselExample{{ $index }}" data-bs-slide="prev">
                                        <i class="fa-solid fa-chevron-left colorarrow" aria-hidden="true"></i>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next nxtvbtn" type="button"
                                        data-bs-target="#carouselExample{{ $index }}" data-bs-slide="next">
                                        <i class="fa-solid fa-chevron-right colorarrow" aria-hidden="true"></i>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                {{-- end slide --}}
                            <td class="text-center">
                                @if ($studio->disponible)
                                    Disponible
                                @else
                                    Non isponible
                                @endif
                            </td>
                            <td class="text-center">{{ $studio->nombre_utilisation }}</td>
                            <td class="text-center">
                                <a href={{ route('admin.updateStudio', $studio) }}>
                                    <i class="fa-solid fa-pen-to-square iconcolor"></i></a>
                            </td>
                            <td class="text-center">
                                <form action={{ route('studio.delete', $studio) }} method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit">
                                        <i class="fa-solid fa-trash-can text-danger iconcolorred"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>



            </table>
        </div>


    </section>
@endsection
