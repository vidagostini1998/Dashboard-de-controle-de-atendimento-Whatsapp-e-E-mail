<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('scripts1')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="{{ URL::asset('img/iap.ico'); }}" rel="shortcut icon">
    <link rel="stylesheet" href="{{ URL::asset('css/font.css'); }}">
    <link rel="stylesheet" href="{{ URL::asset('css/header_home.css'); }}">
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/d4a766c662.js"></script>
    <title>Relatorios</title>
</head>

<body>
    <div class="container-fluid home">
        <header class="d-flex flex-wrap align-items-center justify-content-center align-center py-1 mb-1    ">
            <img src="{{ URL::asset('img/iap.png'); }}" style="width: 125px" alt="">
        </header>
    </div>
    <div class="container-fluid">
        <div class="text-center mb-4">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                Selecione o Relatorio
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('whatsapp')}}">Whatsapp</a></li>
                <li><a class="dropdown-item" href="{{route('email')}}">E-mail</a></li>
            </ul>
        </div>
        @yield('main')
    </div>


    <footer>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

        </script>
        @stack('chart')
        @stack('form')
    </footer>
</body>

</html>
