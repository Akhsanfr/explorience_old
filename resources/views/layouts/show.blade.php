<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Livewire</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style>
        #left{
            height:100vh;
        }
    </style>

    @livewireStyles()
</head>
<body>
    @yield('content')
    @livewireScripts()
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
