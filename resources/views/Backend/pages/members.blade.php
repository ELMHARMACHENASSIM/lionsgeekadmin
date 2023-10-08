@extends('layouts.admin.indexAdmin')

@section('admin')
    <section class="content">
        <div class="containerme p-5">
            <x-validation-errors class=" d-flex w-75 " />
            @if ($message = Session::get('success'))
                <div class="fade show" role="alert">
                    <strong class="text-success mb-3">{{ $message }}</strong>
                </div>
            @endif

            <div class="main-title">
                <div class="info">
                    <h1>Tous les membres <span class="text-yellow">*</span></h1>
                    <p>{{ $recordCount }} membres disponibles</p>
                </div>

                <a href={{ route('admin.adduser') }}>
                    <i class="fa-solid fa-plus text-light"></i>
                    <span class="text-light">Ajouter membre</span>
                </a>
            </div>
            <table class="tablemain">
                <thead>
                    <tr>
                        <th>Membres</th>
                        <th>Type</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-center">Modifier</th>
                        <th class="text-center">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users->reverse() as $user)
                        <tr>
                            <td>
                                <div class="infomember py-3">
                                    <div class="img">
                                        @if (isset($user->img))
                                            <img src="{{ asset('storage/img/profile/' . $user->img) }}" alt="">
                                        @else
                                            <img src="{{ asset('storage/img/profile/logo1.png') }}" alt="Default Image">
                                        @endif
                                    </div>


                                    <h2>{{ $user->name }}</h2>
                                </div>
                            </td>
                            @if ($user->usertype_id == 1)
                                <td><span class="extern">Externe</span></td>
                            @else
                                <td> <span class="interne">Interne</span></td>
                            @endif
                            <td>{{ $user->email }}</td>


                            @if ($user->roles->isNotEmpty())
                                <td><span class={{ $user->roles->last()->name }}>{{ $user->roles->last()->name }}</span>
                                </td>
                            @else
                                <td><span class="gstudio bg-transparent"></span></td>
                            @endif


                            <td class="text-center">
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#updateus{{ $user->id }}">
                                    <i class="fa-solid fa-pen-to-square iconcolor"></i>
                                </button>
                                @include('Backend.partials.users.update')
                            </td>

                            <td class="text-center">
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#deleteuser{{ $user->id }}">
                                    <i class="fa-solid fa-trash-can text-danger"></i>
                                </button>
                                @include('Backend.partials.users.delete')
                            </td>

                        </tr>
                    @endforeach


                </tbody>



            </table>
        </div>


    </section>
@endsection
