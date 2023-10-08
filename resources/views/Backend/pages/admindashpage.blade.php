@extends('layouts.admin.indexAdmin')


@section('admin')
    <section class="content">
        <div class="mainheader d-flex justify-content-between w-100">
            <div class="time">
                <h1 class="mt-2">Dashboard</h1>
            </div>
            <div class="newmember bg-white d-flex align-items-center gap-2 rounded p-3">
                <a class="nav-link d-flex align-items-center  gap-3" href={{ route('admin.adduser') }}>
                    <h3>Ajouter member</h3>
                    <div class="icon rounded bg-yellow h-[40px] w-[40px] flex items-center justify-center">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </a>
            </div>
        </div>
        {{-- ********************************* banner ******************************* --}}
        <div class="bannerdiv d-flex gap-5 justify-content-between align-items-center  h-[200px] rounded bg-[#ffc80183] mt-3  mb-4 ">
            <div class="imgbanner1 w-[200px] rounded">
                <img src={{ asset('images/men.png') }} alt="">
            </div>
            <div class="infoadmin d-flex justify-content-center align-items-start flex-column m-0 h-[100%]">
                <span class="fs-[20px]">Hi, Mahdi Bouziane
                </span>
                <h1 class="mt-2">Bienvenue sur le tableau de bord
                </h1>
                <p class="m-0 opacity-80">Réservez, gérez et suivez facilement les matériel et l'équipement de studio
                    <br>Rationalisez le flux de travail de votre studio
                </p>
            </div>
            <div class="imgbanner2 mb-5 ml-2">
                <img src={{ asset('images/pattern.png') }} alt="">
            </div>
        </div>
        {{-- ***************************************historique********************************* --}}
        <div class="containerme p-5  ">
            <h1 class="history ">Plan d'aujourdui</h1>
            <table class="tablemainhistorique">
                <thead>
                    <tr>
                        <th>Members</th>
                        <th>Reservation</th>
                        <th>Emails</th>
                        <th>Time</th>
                        <th>Espace</th>

                    </tr>
                </thead>
                <tbody>

                    {{-- Jma3t ReservationClass::all() m3a ReservationStudio::all() bach nbeyen kolchi --}}
                    @foreach ($combinedReservations as $res)
                        <tr>
                            <td>
                                <div class="infomember">
                                    <div class="img">
                                        @if (($res->user->img))
                                        <img src="{{ asset('storage/img/profile/' . $res->user->img) }}" alt="">
                                    @else
                                        <img src="{{ asset('storage/img/profile/logo1.png') }}" alt="Default Image">
                                    @endif
                                    </div>
                                    <h2 class="fs-6">{{ $res->user->name }}</h2>
                                </div>
                            </td>
                            <td> <span
                                    class={{ $res->cancel ? 'interne' : 'extern' }}>{{ $res->cancel ? 'Annulé' : 'Reservé' }}</span>
                            </td>
                            <td>
                                {{$res->user->email}}
                            </td>
                            <td><span class={{ $res->cancel ? 'text-[#cac6a4]' : 'text-green' }}>&#9677;</span>
                                {{ date('H:i', strtotime($res->start_time)) }}
                                <b>-</b> {{ date('H:i', strtotime($res->finish_time)) }}
                            </td>

                            <td>
                                @if ($res->classe)
                                    <h5>{{$res->classe->name}}</h5>
                                @else
                                    <h5>{{$res->studio->name}}</h5>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </section>
@endsection
