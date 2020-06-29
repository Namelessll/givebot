<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

	<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;500;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <style type="text/css">
    	* {
    		font-family: 'Comfortaa', cursive !important;
    	}
    </style>
</head>

<body>
<header style="margin-bottom: 50px;">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding-left: 0; padding-right: 0;">
            <a class="navbar-brand" href="#">Givebot</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Api</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Competitions
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{route('getCompetitionCreatePage')}}">Create competition</a>
                            <a class="dropdown-item" href="#">Competitions statistic</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mailer</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
@yield('content')
@stack('competition-create')
</body>

</html>
