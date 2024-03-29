<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ url('css/favicon.png') }}">
    <title>{{ config('app.name', 'Final CEG 2023') }}</title>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

    {{-- Bootsrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!----Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!---- Bootstrap Select ---->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
        integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>

    <!---- Pusher ---->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <!---- Dropzone ---->
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    @yield('head')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        .spacing {
            height: 100px;
        }

        .navbar {
            background-color: #dfe2be;
        }

        .navbar-nav{
            display: flex;
            align-items: center;
        }

        .nav-link,
        .nav-link:focus {
            font-weight: bold;
            font-size: 16px;
            color: #515940 !important;
            padding: 5px 0px;
            border-radius: 5px;
            margin-left: 15px;
            padding-left: 5px;
        }

        .nav-link:hover {
            color: #ffff !important;
            background-color: #515940;
            border-radius: 5px;
            padding: 5px 0px;
            padding-left: 5px;
        }

        #page-name {

            font-weight: bold;

        }

        @media screen and (max-width:968px) {
            .nav-link {
                font-size: 12px;
            }

            .nav-item {
                display: flex;
                align-items: center;
            }

            .nav-link:hover{
                padding: 5px 5px;
            }
            .nav-link,
            .nav-link:focus{
                padding: 5px 5px;
            }
        }
    </style>
    @yield('css')
</head>

<body style="background: url('{{ asset('assets') }}/background/background.png') center / cover no-repeat fixed">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light  shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('assets/logo/Kelapa_navbar.png') }}" alt=""
                        style="width: 32px;height:auto;">
                    <img src="{{ asset('assets/logo/Logo_CEG.png') }}" alt="" style="width: 32px;height:auto;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @can('isPlayer')
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('listDowngrade') }}" class="nav-link">List Downgrade</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('listHarga') }}" class="nav-link">List Harga</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('playerHint') }}" class="nav-link">Hint</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pengumpulan') }}" class="nav-link">Flowsheet</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pengumpulanppt') }}" class="nav-link">Submission</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('history') }}" class="nav-link">History</a>
                            </li>
                        @elsecan("isAdminBahan")
                            <li class="nav-item">
                                <a href="{{ route('penjualBahanSell') }}" class="nav-link">Sell</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('penjualBahanBuy') }}" class="nav-link">Buy</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('history') }}" class="nav-link">History</a>
                            </li>
                        @elsecan("isAdminDowngrade")
                            <li class="nav-item">
                                <a href="{{ route('penjualDowngradeSell') }}" class="nav-link">Sell</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('penjualDowngradeBuy') }}" class="nav-link">Buy</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('history') }}" class="nav-link">History</a>
                            </li>
                        @elsecan("isDnC")
                            <li class="nav-item">
                                <a href="{{ route('tinkerer') }}" class="nav-link">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('history') }}" class="nav-link">History</a>
                            </li>
                        @elsecan("isIngredient")
                            <li class="nav-item">
                                <a href="{{ route('ingredients') }}" class="nav-link">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('done_playing') }}" class="nav-link">Done Playing</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('history') }}" class="nav-link">History</a>
                            </li>
                        @elsecan("isTool")
                            <li class="nav-item">
                                <a href="{{ route('tools') }}" class="nav-link">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('done_playing') }}" class="nav-link">Done Playing</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('history') }}" class="nav-link">History</a>
                            </li>
                        @elsecan("isHint")
                            <li class="nav-item">
                                <a href="{{ route('hint') }}" class="nav-link">Hint</a>
                            </li>
                        @endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown" style="border: none !important;">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container-fluid py-4 px-1 sm-px-4">
            @yield('content')
        </main>
    </div>

    {{-- Modal Sesi --}}
    <div class="modal fade" id="ModalSesi" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalSesiLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalSesiLabel">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="alert-body" class="modal-body flex">
                    <b id="sesi-alert"></b>
                </div>
                <div class="modal-footer">
                    {{-- button OK --}}
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    var pusher = new Pusher('ee40c583b896ff3cfaa7', {
        cluster: 'ap1'
    });

    var sesiPusher = pusher.subscribe('sesiPusher');
    sesiPusher.bind('sesi', (e) => {
        // alert("Hai")
        $("#sesi-alert").html(e.sesiMsg)
        $("#ModalSesi").modal("show")
    });
</script>

</html>
