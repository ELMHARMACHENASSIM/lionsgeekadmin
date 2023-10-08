@extends('layouts.admin.indexAdmin')


@section('admin')
    <section class="content">
        <div class="containerme p-5">

            <div class="infouser">
                <a href={{ route('studios.index') }}><i class="fa-solid fa-chevron-left"></i></a>
                <h1 class="ms-2">Modifier le studio</h1>
            </div>

            <div class="d-flex align-items-start tabscontent">
                <div class="nav flex-column nav-pills me-5" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link text-noir btnclick active" id="v-pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                        aria-selected="true">Modifier le studio</button>
                    <button class="nav-link text-noir btnclick  " id="v-pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">Modifier les images</button>
                </div>
                <div class="tab-content maintabcontent" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab" tabindex="0">
                        {{-- content update class --}}
                        <div class="updateclass">
                            <form action={{ route('studio.update', $studio) }} method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="labelinput ">
                                    <label for="">Nom de studio</label>
                                    <input name="name" value="{{ old('name', $studio->name) }}" type="text"
                                        placeholder="Nom de studio" class="form-control mt-2 p-2" required>
                                </div>
                                <div class="labelinput">
                                    <label for="">Disponible</label>
                                    <select name="disponible" class="form-select mt-2" aria-label="Default select example">
                                        <option value="1" {{ $studio->disponible ? 'selected' : '' }}>oui</option>
                                        <option value="0" {{ !$studio->disponible ? 'selected' : '' }}>non</option>
                                    </select>

                                </div>
                                <div class="d-flex align-items-center justify-content-center">

                                    <button type="submit" class="rounded">Modifier le studio</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade imageupdate" id="v-pills-profile" role="tabpanel"
                        aria-labelledby="v-pills-profile-tab" tabindex="0">
                        {{-- content update images --}}
                        <div class="updateclass">
                            <div class="headerupdate">
                                <h1>Tout les images</h1>
                                <form action={{ route('studioimage.store', $studio) }} method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex justify-content-evenly align-items-center ">
                                        <input name="images[]" class="form-control w-50 " type="file" id="formFile"
                                            multiple>
                                        <button type="submit" class="rounded btnupdate">Ajouter</button>
                                    </div>
                                </form>
                            </div>
                            <div class="classes-images">
                                @foreach ($studio->images as $image)
                                    <div class="images">
                                        <div class="imageclass">
                                            <img src={{ asset('storage/img/studio/' . $image->images) }} alt="">
                                        </div>
                                        <form class="formul" action={{ route('classImage.update', $image) }} method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="d-flex align-item-center justify-content-evenly gap-4 w-75 ">

                                                <input type="file" class="form-control" name="images" id="">
                                                <button type="submit" class="btn btn-noir mt-0 p-0">Modifier</button>
                                            </div>
                                        </form>
                                        <form class="formul" action={{ route('classimage.delete', $image) }} method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btnsubmit deletbtn"><i
                                                    class="fa-regular fa-trash-can text-danger "></i></button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>


    </section>
@endsection
