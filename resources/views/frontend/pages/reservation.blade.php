@extends('frontend.index')
@section('content')
    {{-- <div class="imgbanner1 bg-yellow d-flex align-items-center justify-center w-100">
        <img src={{ asset('images/men.png') }} alt="">
        <h1 class="text-center">Bienvenue <span class="fw-bold"> {{ $onlineUser->name }}</span></h1>

    </div> --}}
    <table class="table  text-center mt-3 res">
        <thead>
            <tr>
                <th class="py-3" scope="col">Title</th>
                <th class="py-3" scope="col">Reservation in</th>
                <th class="py-3" scope="col">Started at</th>
                <th class="py-3" scope="col">Finish time</th>
                <th class="py-3" scope="col">State</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userReservations->reverse() as $res)
                <tr class="">
                    <th class="py-4" scope="row">{{ $res->title }}</th>
                    <td class="py-4">
                        @if ($res->classe)
                            {{ $res->classe->name }}
                        @else
                            {{ $res->studio->name }}
                        @endif
                    </td>
                    <td class="py-4">{{ date('H:i', strtotime($res->start_time)) }}</td>
                    <td class="py-4">{{ date('H:i', strtotime($res->finish_time)) }}</td>
                    <td class="py-4">
                        @if ($res->cancel)
                            <span class="text-danger">Annulée</span>
                        @else
                            <span class="text-success">Active</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
