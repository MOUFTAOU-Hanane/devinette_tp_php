    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
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
                        <a class="navbar-brand text-success" href="{{ url('/home') }}">LexiQuiz</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item "><a class="nav-link active text-white" aria-current="page"
                                        href="{{ url('/show-login') }}">Se connecter</a></li>
                                <li class="nav-item"><a class="nav-link text-white"
                                        href="{{ url('/register') }}">S'inscrire</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <hr>
            <div class="container">
                <h4 class="text-center text-white pb-4">Modifier son profil</h4>
                <div class="row">
                    <div class="col-md-3"></div>

                    <div class="col">
                        <form method="POST" action="{{ route('update-profil', ['id' => $user_id]) }}">

                            @method('PUT')
                            @csrf
                            <div class="mb-3">

                                @error('username')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control text-center" id=""
                                    placeholder ="Username" name="username">

                            </div>
                            <div class="mb-3 pt-3">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <input type="email" class="form-control text-center" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder ="Email" name="email">
                            </div>


                            <div class="mb-3 pt-3">
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="password" class="form-control text-center" id="exampleInputPassword1"
                                    placeholder ="Password" name="password">
                            </div>
                            <div class="pt-4 row">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">Modifier son profil</button>
                                </div>
                            </div>

                        </form>
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
        </script>
    </body>

    </html>
