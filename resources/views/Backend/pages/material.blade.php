@extends('layouts.admin.indexAdmin')
@section('admin')
    <section class="content">
        <div class="containerme p-5">
            <div class="main-title">
                <div class="info">
                    <h1>Tout le matériel <span class="text-yellow">*</span></h1>
                    <p>{{ $materialcount }} matériel disponible</p>
                </div>
                @include('Backend.partials.Material.create')
                {{-- <a href="">
                    <i class="fa-solid fa-plus"></i>
                    <span>Ajouter un nouveau matériau</span>
                </a> --}}
            </div>
            <table class="table-material">
                <thead>
                    <tr class="">
                        <th class=""></th>
                        <th class="">Nom</th>
                        <th class="text-center">Quantité </th>
                        <th class="text-center">Disponible</th>
                        <th class="text-center">N° Utilisation</th>
                        <th class="text-center">Editer</th>
                        <th class="text-center">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materials as $material)
                        <tr class="p-2">
                            <td class="p-2">
                                <div class="infomaterial">
                                    <div class="img">
                                        <img src={{ asset('storage/img/material/' . $material->image) }} alt="">
                                    </div>
                                </div>
                            </td>
                            <td class="w-25 pt-2 pb-2">
                                <div class="infomaterials">
                                    <div class="materialname">
                                        <h2>{{ $material->name }}
                                        </h2>
                                        @if ($material->reference)
                                            <h3 class="mt-2 "><span>Ref : </span>{{ $material->reference }}</h3>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class=" text-center"> <span class="qte">{{ $material->quantite }}</span></td>
                            @if ($material->disponible)
                                <td class="text-center">Disponible</td>
                            @else
                                <td class="text-center">Non disponible</td>
                            @endif
                            <td class="text-center">{{ $material->nombre_utilisation }}</td>
                            <td class="text-center">
                                @include('Backend.partials.Material.Edite')
                            </td>
                            {{-- *** --}}
                            <td class="text-center">
                                <button type="button" class="btn" data-bs-toggle="modal"
                                data-bs-target="#deletematerial{{ $material->id }}">
                                <i class="fa-solid fa-trash-can text-danger"></i>
                            </button>
                            @include('Backend.partials.Material.delete')

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
