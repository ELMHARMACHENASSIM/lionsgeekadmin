<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/js/app.js'])
    @vite('resources/css/app.css')
    @vite(['resources/js/date.js'])
    <title>lionsgeek_managing_app</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
</head>

<body>
    <nav class="pt-4 pb-4 container-fluid d-flex align-items-center justify-content-between">
        <div class=" ms-5 logofront d-flex align-items-center justify-content-center">
            <div class="me-2">
                <img src="{{ asset('final.png') }}" alt="logo">
            </div>
            <h1 class="text-red">Lions<span class="text-yellow">Geek</span></h1>
        </div>
        <ul class="d-flex @auth w-50 @else w-25 @endauth align-items-center justify-content-center mt-2 mobiledn">
            <li><a href="{{ route('user.Home') }}" class="p-2 nav-link fs-6">Accueil</a></li>

            @if (auth()->user() &&
                    auth()->user()->hasRole('gestionnaire_classe'))
                <li><a href="{{ route('user.classes') }}" class="p-2 nav-link fs-6">Classes</a></li>
            @endif

            @if (auth()->user() &&
                    auth()->user()->hasRole('gestionnaire_studio'))
                <li><a href="{{ route('user.studios') }}" class="p-2 nav-link fs-6">Studios</a></li>
                <li><a href="{{ route('user.materials') }}" class="p-2 nav-link fs-6">Material</a></li>
            @endif

            @auth
                <li><a href="{{ route('user.reservation') }}" class="p-2 nav-link fs-6">Reservation</a></li>
                <li><a href="{{ route('user.settings') }}" class="p-2 nav-link fs-6">Parametres</a></li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="p-2 nav-link fs-6 text-danger">Deconnexion</button>
                </form>
            @else
                <li class="login"><a href="{{ route('login') }}"
                        class=" ms-3 p-2 nav-link fs-6  bg-yellow rounded">Connecter</a></li>
            @endauth
        </ul>
        <div class="icon" id="menuIcon">
            <i class="fa-solid fa-bars openicon"></i>
            <i class="fa-solid fa-xmark closeicon"></i>

        </div>
          <ul class="mobilemenu" id="mobileMenu">
        <li><a href="{{ route('user.Home') }}" class="p-2 nav-link fs-6">Accueil</a></li>

        @if (auth()->user() &&
                auth()->user()->hasRole('gestionnaire_classe'))
            <li><a href="{{ route('user.classes') }}" class="p-2 nav-link fs-6">Classes</a></li>
        @endif

        @if (auth()->user() &&
                auth()->user()->hasRole('gestionnaire_studio'))
            <li><a href="{{ route('user.studios') }}" class="p-2 nav-link fs-6">Studios</a></li>
            <li><a href="{{ route('user.materials') }}" class="p-2 nav-link fs-6">Material</a></li>
        @endif

        @auth
            <li><a href="{{ route('user.reservation') }}" class="p-2 nav-link fs-6">Reservation</a></li>
            <li><a href="{{ route('user.settings') }}" class="p-2 nav-link fs-6">Parametres</a></li>
            <form action="{{ route('logout') }}" method="POST" class="deconnect">
                @csrf
                <button type="submit" class="p-2 nav-link fs-6 text-danger">Deconnexion</button>
            </form>
        @else
            <li class="login"><a href="{{ route('login') }}"
                    class=" ms-3 p-2 nav-link fs-6  bg-yellow rounded">Connecter</a></li>
        @endauth
    </ul>
    </nav>
  
    @yield('content')
</body>

</html>
