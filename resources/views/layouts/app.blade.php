<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Livewire</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    {{-- <script src="https://cdn.tiny.cloud/1/2k1v2zo1p5yo9ubgu26533wy4myqzyd8xsut7oz98g0twbr0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}

    <style>
        #left{
            height:100vh;
        }
    </style>
    {{-- <script>
    tinymce.init({
        selector: '#konten'
    });
    </script> --}}
{{--
    @livewireStyles()
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-3 fixed-top bg-primary bg-gradient text-white" id="left">
                @livewire('side-bar')
            </aside>
            <main class="col offset-3 h-100 px-0">
                <nav class="navbar sticky-top navbar-light bg-light" style="height: 50px">
                @livewire('top-bar', ['judul' => $judul])
                </nav>
                <div class="container pt-3">
                    {{$slot}}
                </div>
        </main>
    </div>
    @livewireScripts()
    <script src="{{ mix('js/app.js') }}"></script>
</div>
</body>
</html> --}}
