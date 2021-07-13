<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Artikel</title>
</head>
<body>
    <a href="{{ route('welcome') }}">Back To Dashboard</a>
    <h1>List Available Artikel to view from Guest</h1>
    <ul>
        @forelse ($artikels as $artikel)
            <li><a href="{{ route('show-artikel', ['slug'=> $artikel->slug]) }}"> {{$artikel->judul}} </a></li>
        @empty
            <li>Tidak ada artikel yang aktif</li>
        @endforelse
    </ul>
</body>
</html>
