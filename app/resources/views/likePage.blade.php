<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LexiQuiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    body {
        background-color: black;


    }

    hr {
        color: white
    }
</style>

<body class = "">
    <div class="container">
        <header class="px-20">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand text-success" href="{{ url('/') }}">LexiQuiz</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item "><a class="nav-link active text-white" aria-current="page"
                                    href="{{ url('/show-profil') }}">Mon compte</a></li>
                            <li class="nav-item "><a class="nav-link active text-white" aria-current="page"
                                    href="{{ url('/show-riddle') }}">Devinette</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="{{ url('/users')}}">Liste des utilisateurs</a></li>  

                            <li class="nav-item"><a class="nav-link text-white"
                                    href="{{ url('/show-users-score') }}">Score de mes amis</a></li>  
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <hr>
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="text-white">Hi , {{ $name }}</h4>
            </div>

        </div>



        <div class="container">
            <div class="row">
                <div class="col-4 bg-light p-5 rounded-3 mx-auto shadow">
                    <div class="">
                        <form method="POST" action="{{ route('like-word') }}">
                            @csrf
                            @if (session('error'))
                                <div class="pt-3 alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('message'))
                                <div class="pt-3 alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif

                            <div class="">
                                <h5 class="text-bold">Le mots du jour est {{ session('word') }}</h5>
                            </div>
                            <div class="p-2">
                                <h6>Avez-vous aimé le mot du jour</h6>

                                <div class="">
                                    <div class="form-check pe-2">
                                        <input class="form-check-input" type="radio" name = "response" value="true"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault" name = "response">
                                            Oui
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="false" name = "response"
                                            id="flexCheckChecked" >
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Non
                                        </label>
                                    </div>

                                </div>
                                <div class="py-2">
                                    <h6>Quelle note donneriez-vous à ce mot</h6>
                                    <input type="number" name="note" id="" style="width: 50px;">

                                </div>

                            </div>



                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success"><a class="navbar-brand"
                                        href="{{ url('/show-riddle') }}">Retour</a></button>
                                <button type="submit" class="btn btn-success">Envoyez</button>


                            </div>

                        </form>
                    </div>


                </div>
            </div>
        </div>
        <hr>
        <footer>
            <div class="row">
                <span class="text-white text-center">© 2023 LexiQuiz </span>
            </div>
        </footer>


    </div>

</body>

</html>
