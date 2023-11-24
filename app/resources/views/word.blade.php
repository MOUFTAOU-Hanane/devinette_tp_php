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
                            <li class="nav-item"><a class="nav-link text-white" href="{{ url('/users') }}">Liste des
                                    utilisateurs</a></li>

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
                <h4 class="text-white">Hi , {{ $name }} </h4>
            </div>
            <div class="border-success p-2   bg-success"><span class="text-white ">Score : {{ $scores }}</span>
                <br></h4>
            </div>

        </div>



        <div class="container">
            <div class="row">

                <h5 class="text-center text-white pb-4">Devinez le mot du jour en choisissant une date !</h5>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @elseif (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('message'))
                 <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif




                <div class="col-md-3"></div>

                <div class="col bg-light p-5 rounded-3">
                    <div class="">
                        <form method="POST" action="{{ route('user-riddle') }}">
                            @csrf

                            <div class="m-3"><input type="date" id="date" name="date" required></div>


                            <div class="d-flex">
                                <div class="m-3">

                                    <input type="name"
                                        class="form-control bg-dark text-center text-white text-bold text-uppercase"
                                        maxlength="1" name="first-name">
                                </div>
                                <div class="m-3">
                                    <input type="name"
                                        class="form-control bg-dark text-center text-white text-bold text-uppercase"
                                        maxlength="1" name="second-name">
                                </div>
                                <div class="m-3">

                                    <input type="name"
                                        class="form-control bg-dark text-center text-white text-bold text-uppercase"
                                        maxlength="1" name="third-name">
                                </div>
                                <div class="m-3">

                                    <input type="name"
                                        class="form-control bg-dark text-center text-white text-bold text-uppercase"maxlength="1"
                                        name='four-name'>
                                </div>
                                <div class="m-3">
                                    <input type="name"
                                        class="form-control bg-dark text-center text-white text-bold text-uppercase"maxlength="1"
                                        name="five-name">
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Entrer</button>
                            </div>

                        </form>
                    </div>


                </div>
                <div class="col-md-3"></div>
            </div>
        </div>














        <hr>
        <footer>
            <div class="row">
                <span class="text-white text-center">© 2023 LexiQuiz </span>
            </div>
        </footer>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        const datepicker = new Pikaday({
            field: document.getElementById('datepicker'),
            format: 'DD/MM/YYYY' // Format de la date
        });
    </script>
</body>

</html>
