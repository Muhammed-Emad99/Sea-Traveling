<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset("assets/modules/bootstrap/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/modules/fontawesome/css/all.min.css") }}">


    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset("assets/css/style.css") }}">

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
{{--        <div class="navbar-bg"></div>--}}
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('clients.index') }}">All Clients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contracts.index') }}">All Contracts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('trips.index') }}">All Trips</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
{{--        <nav class="navbar navbar-expand-lg main-navbar">--}}
{{--            <ul class="navbar-nav navbar-right">--}}
{{--                --}}
{{--            </ul>--}}
{{--        </nav>--}}
        @yield('content')
    </div>
</div>

<!-- General JS Scripts -->
<script src="{{ asset("assets/modules/jquery.min.js") }}"></script>
<script src="{{ asset("assets/modules/popper.js") }}"></script>
<script src="{{ asset("assets/modules/bootstrap/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("assets/js/stisla.js") }}"></script>

<!-- Template JS File -->
<script src="{{ asset("assets/js/scripts.js") }}"></script>
<script src="{{ asset("assets/js/custom.js") }}"></script>
</body>
</html>
