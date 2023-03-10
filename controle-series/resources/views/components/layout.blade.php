<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Series</title>

        <link rel="stylesheet" href="{{asset('/css/app.css')}}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('series.index')}}">Home</a>
                @auth
                    <a href="{{route('logout')}}">Sair</a> 
                @endauth

                @guest
                    <a href="{{route('login')}}">Entrar</a>
                @endguest
            </div>            
          </nav>
        <div class="container">
            <h1>{{$title}}</h1>

            @isset($messagemSucesso)
                <div class="alert alert-success">
                    {{$messagemSucesso}}
                </div>
            @endisset

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{$slot}}
        </div>
    </body>
</html>