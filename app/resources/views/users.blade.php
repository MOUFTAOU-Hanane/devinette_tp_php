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

        <body>
            <div class="container">
                <div class="row">
                 @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
             @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

                    <h4 class="text-white text-bold text-decoration-underline mb-3 text-center">Liste des utilisateurs</h4>

                    @foreach ($users as $user)
                        <div class="col-md-4 mt-2">
                            <div class="card d-flex">
                                @if (!empty($user->avatar))
                                    <img src="https://via.placeholder.com/150" class="card-img-top"
                                        alt="Photo de profil">
                                @endif

                                <div class="card-body">
                                    <p class="text-bold">Username : {{ $user->username }}</p>
                                    <p class="pb-3 text-bold">Email : {{ $user->email }}</p>

                                    <div class="d-flex justify-content-between">
                                       <a href="{{ url('/users-friend/' . $user->id) }}" class="btn btn-primary">Ajouter</a>

                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class='mt-4'><a href="{{ url()->previous() }}" class="btn btn-success">Retour</a></div>
                
            </div>
            


        </body>



















        <hr>
        <footer>
            <div class="row">
                <span class="text-white text-center">© 2023 LexiQuiz </span>
            </div>
        </footer>


    </div>
</body>

</html>
