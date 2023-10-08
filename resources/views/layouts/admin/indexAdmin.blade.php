<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/js/app.js'])
    @vite('resources/css/app.css')
    @vite(['resources/js/date.js'])
    <title>lionsgeek_managing_app</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    

</head>

<body class="adminDash">
    {{-- sideBare --}}
    <header class="">
        <div class="containerme">
            <nav class="d-flex justify-content-center align-items-center flex-column">
                {{-- logo --}}
                <div class="logo mt-3   d-flex justify-content-center align-items-center">
                    <div class="imglogo d-flex align-items-center justify-content-center ">
                        <img src="{{ asset('images/logo1.png') }}" alt="Logo">
                    </div>
                    <h1>Lions<span class="text-yellow">Geek</span></h1>
                </div>
                {{-- links --}}
                <ul class="links " >

                    <a class="link" href="{{ route('admin.admindashpage') }}">
                        <i class="fa-solid fa-chart-line"></i>

                        <div class="div">Dashboard</div>
                    </a>
                    <a class="link" href={{ route('admin.members') }}>

                        <i class="fa-solid fa-users"></i>
                        <div class="div">Members</div>
                    </a>

                    @if (auth()->check())
                        @if (auth()->user()->hasRole('gestionnaire_classe'))
                            <a class="link"href={{ route('classes.index') }}>
                                <i class="fa-solid fa-graduation-cap"></i>

                                <div class="div">Classes</div>
                            </a>
                        @endif
                    @endif
                    <a class="link" href={{ route('studios.index') }}>
                        <i class="fa-solid fa-film"></i>
                        <div class="div">Studios</div>
                    </a>
                    <a class="link" href={{ route('material.index') }}>
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                        <div class="div">Material</div>
                    </a>

                    <div class="dropdown w-100">
                        <a class="link" href="#">
                            <i class="fa-regular fa-calendar"></i>
                            <div class="div">Calendrier</div>
                        </a>
                        <div class="dropdown-content">
                            <a class="link" href="{{ route('reservationClasse.index') }}">
                                <i class="fa-regular fa-calendar"></i>
                                <div class="">Calendar Class</div>
                            </a>
                            <a class="link" href="{{ route('reservationStudio.index') }}">
                                <i class="fa-regular fa-calendar"></i>
                                <div class="">Calendar Studio</div>
                            </a>
                        </div>
                    </div>


                    <a class="link" href="{{route("admin.historique")}}">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <div class="div">Historique</div>
                    </a>
                    <a class="link" href="{{ route('profile.show') }}">

                        <i class="fa-solid fa-gear"></i>
                        <div class="div">Settings</div>
                    </a>

                    <form class="link" action={{ route('logout') }} method="post">
                        @csrf
                        <button type="submit" class="d-flex text-danger logout items-center ">
                            <i class="fa-solid fa-arrow-right-from-bracket text-danger me-4"></i>

                            <div class="text-danger div">Logout</div>
                        </button>

                    </form>
            </nav>
        </div>
    </header>
    {{--  navbar --}}
    <div class="navmenu">
        <div class="containerme mt-2 ">
            <div class="title">
                <h1 class="clock"></h1>
                <span class="date text-gris"></span>
            </div>
            {{-- admin info --}}
            <div class="useradmin">
                <div class="name">
                    <h1>{{ Auth::user()->name }}</h1>
                    <p>{{ Auth::user()->roles->isNotEmpty() ? Auth::user()->roles->first()->name : '' }}</p>
                </div>
                <div class="image">
                    <img src="{{ asset('images/mido.jpeg') }}" alt="mido">
                </div>
            </div>
        </div>
    </div>
    @yield('admin')

</body>

</html>

