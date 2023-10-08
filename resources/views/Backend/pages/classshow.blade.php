@extends('layouts.admin.indexAdmin')

@section('admin')
    <section class="content">
        <div class="containerme p-5">
            <div class="main-title">
                <div class="info">
                    <h1>Classes <span class="text-yellow">*</span></h1>
                </div>

                <button class="btnAddClass" data-bs-toggle="modal" data-bs-target="#addClasse">

                    <i class="fa-solid fa-plus text-white"></i>
                    <span class="text-light">Ajouter classe</span>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="addClasse" tabindex="-1" aria-labelledby="addClasseLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h1 class="modal-title text-center " id="addClasseToggleLabel2">Ajouter</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="containerme pb-4 pt-2 ">
                                    <div class="classform">
                                        <form action={{ route('class.store') }} method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="labelinput">
                                                <label for="">Nom de class</label>
                                                <input type="text" name="name" placeholder="Nom de class"
                                                    class="form-control mt-2 p-2" required>
                                            </div>
                                            <div class="labelinput">
                                                <label for="formFile" class="form-label">Upload image
                                                </label>
                                                <input class="form-control " name="images[]" type="file" id="formFile"
                                                    multiple>

                                            </div>
                                            <button type="submit" class="rounded">Ajouter une classe</button>
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
                        <th class="text-center">Supprimer</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($classes as $index => $classe)
                        <tr valign="middle">
                            <td class="text-center">
                                <h2 class="name">{{ $classe->name }}</h2>
                            </td>
                            <td class=" text-center">
                                {{-- slide --}}
                                <div id="carouselExample{{ $index }}" class="carousel slide widthslide">
                                    <div class="carousel-inner childslide">
                                        @foreach ($classe->images as $image)
                                            <div
                                                class="carousel-item imgslide @if ($loop->first) active @endif">
                                                <img src="{{ asset('storage/img/classe/' . $image->images) }}" class=" w-100" alt="...">
                                                
                                                
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
                                @if ($classe->disponible)
                                    Disponible
                                @else
                                    Non isponible
                                @endif
                            </td>
                            <td class="text-center">{{ $classe->nombre_utilisation }}</td>
                            <td class="text-center">
                                <a href={{ route('updateclass.index', $classe) }}>
                                    <i class="fa-solid fa-pen-to-square iconcolor"></i></a>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#deleteclass{{ $classe->id }}">
                                    <i class="fa-solid fa-trash-can text-danger"></i>
                                </button>
                                @include('Backend.partials.classe.add')
                            </td>
                            {{-- <td class="text-center">
                                <form action={{ route('class.delete', $classe)  }} method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit">
                                        <i class="fa-solid fa-trash-can text-danger"></i>
                                    </button>
                                </form>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </section>
@endsection
