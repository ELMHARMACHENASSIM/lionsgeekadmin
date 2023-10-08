@extends('layouts.admin.indexAdmin')

@section('admin')
    <section class="content">
        <div class="containerme p-5">
            <h1 class="fw-semibold ">Historique <span class="text-yellow">*</span></h1>
            <table class="tablemainhistorique">
                <tbody>

                    {{-- Jma3t ReservationClass::all() m3a ReservationStudio::all() bach nbeyen kolchi --}}
                    @foreach ($combinedReservations->reverse() as $res)
                        <tr>
                            <td>
                                <div class="infomember">
                                    <div class="img">
                                        @if ($res->user->img)
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
                            <td><span class={{ $res->cancel ? 'text-[#cac6a4]' : 'text-green' }}>&#9677;</span>
                                {{ date('H:i', strtotime($res->start_time)) }}
                                <b>-</b> {{ date('H:i', strtotime($res->finish_time)) }}
                            </td>

                            <td><!-- Button trigger modal -->
                                <button type="button" class="btn btnshowreserve calen" data-bs-toggle="modal"
                                    data-bs-target="#{{ implode('-', explode(' ', $res->title . $res->id)) }}">
                                    show
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="{{ implode('-', explode(' ', $res->title . $res->id)) }}"
                                    tabindex="-1"
                                    aria-labelledby="{{ implode('-', explode(' ', $res->title . $res->id)) }}Label"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content p-3">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-4 ms-0 text-center"
                                                    id="{{ implode('-', explode(' ', $res->title . $res->id)) }}Label">
                                                    Detail de reservation {{ $res->title }}
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h1 class="fs-6 mt-2">{{ $res->user->name }} à
                                                    {{ $res->cancel ? 'annulé la reservation de' : 'reservé le' }}
                                                    @if ($res->classe)
                                                        {{ $res->classe->name }}
                                                    @else
                                                        {{ $res->studio->name }}
                                                        @foreach ($res->equipe->users as $user)
                                                            {{-- 3la 7sab ch7al kayn mn memeber --}}
                                                            <h6 class="mt-2 ms-1"><b>Team Memberes
                                                                    : </b> {{ $loop->iteration }}. {{ $user->name }}
                                                            </h6>
                                                        @endforeach
                                                        @foreach ($res->materials as $material)
                                                            {{-- 3la 7sab ch7al khda mn material --}}

                                                            <h6 class="mt-2 ms-1 fw-bold">Matérial:
                                                            </h6>
                                                            <h6 class=" text-noir elipsis ms-5"> <b>{{ $loop->iteration }}.
                                                                </b> {{ $material->name }}</h6>
                                                        @endforeach
                                                    @endif
                                                </h1>
                                                <h6 class="mt-2 ms-1"><b>Description: </b> {{ $res->description }}</h6>


                                                {{-- kanakhod la date o kan7awelha l format HH:MM --}}
                                                <h6 class="mt-2 ms-1"><b>Date: </b>
                                                    {{ date('H:i', strtotime($res->start_time)) }} -
                                                    {{ date('H:i', strtotime($res->finish_time)) }}
                                                </h6>
                                                <h6 class="mt-2 ms-1"><b>Type: </b> {{ $res->user->userType->user_type }}
                                                </h6>

                                                <h6 class="mt-2 ms-1"><b>Role: </b>
                                                    {{ Auth::user()->roles->first()->name }}</h6>


                                                {{-- f Admin Controller, jma3t ReservationStudio + ReservationClass f array wa7d --}}
                                                {{-- la kan 3ando class rah ResClass else rah ResStudio --}}

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </section>
@endsection
