<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RendezVous</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <link href="{{ asset('css/fullcalendar.min.css') }}" rel='stylesheet' />
    <link href="{{ asset('css/fullcalendar.print.min.css') }}" rel='stylesheet' media='print' />
</head>
<body>
<div id="app" class="container">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">RendezVous</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @role('patient')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Acceuil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patient.profile') }}">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patient.appointments') }}">Mes rendez vous</a>
                    </li>
                    @elserole('receptionist')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Reception</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Rendez Vous <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('appointment.unconfirmed') }}">Non-confirmés</a>
                            <a class="dropdown-item" href="{{ route('appointment.confirmed') }}">Confirmés</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patient.index') }}">Patients</a>
                    </li><li class="nav-item">
                        <a class="nav-link" href="{{ route('receptionist.search') }}">Chercher</a>
                    </li>
                    @elserole('doctor')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('doctor.home') }}">Rendez vous</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patient.index') }}">Patients</a>
                    </li>
                    @elserole('admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.home') }}">Acceuil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.list') }}">Médecins-Secrétaire</a>
                    </li>
                    @endrole
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Déconnexion
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>


    </nav>

    <main class="py-4">
        <div id='calendar'></div>
    </main>
</div>

<!-- Scripts -->
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/fullcalendar.min.js') }}"></script>
<script src="{{ asset('js/fr.js') }}"></script>
<script>
    $(document).ready(function() {

        var appointments = JSON.parse('{!! $appointments !!}');

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'listDay,listWeek,month'
            },

            lang: 'fr',

            // customize the button names,
            // otherwise they'd all just say "list"
            views: {
                listDay: { buttonText: 'Jour' },
                listWeek: { buttonText: 'Semaine' }
            },

            defaultView: 'listWeek',
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            events: appointments
        });

    });
</script>
</body>
</html>
