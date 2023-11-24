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
                    <a class="navbar-brand text-success" href="{{ url('/')}}">LexiQuiz</a>
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
                    <div class="col ">
                        <h4 class="text-white text-bold text-decoration-underline mb-3">Mon profil</h4>

                        <!-- Informations de profil -->
                        <div class="">
                            @if(!empty($avatar))
                               <img src="https://via.placeholder.com/150" class="card-img-top" alt="Photo de profil">
                            @endif

                            <div class="">
                                <p class="text-white text-bold">Username : {{$name}}</p>
                                <hr>

                                <p class="pb-3 text-white text-bold">Email : {{$email}}</p>
                                <hr>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
                                    <a href="{{ url('/show-page-update-profil')}}" class="btn btn-primary">Modifier le compte</a>
                                    <a href="{{ route('delete-profil', ['id' => $user_id]) }}" class="btn btn-danger">Supprimer le compte</a>

                                </div>
                                <!-- Boutons de modification et de suppression -->
                               

                            </div>
                        </div>
                    </div>
                </div>
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
