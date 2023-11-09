<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <style>

 
    hr{
        color:white
    }
    a{
        text-decoration: none;
    }
  </style>
  <body>
    <div class="container bg-black">
    <header class="px-20">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <h1><a class="navbar-brand text-success" href="{{ url('/home')}}">LexiQuiz</a>
                </h1>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   <ul class="navbar-nav ms-auto">
                                <li class="nav-item "><a class="nav-link active text-white" aria-current="page"
                                        href="{{ url('/show-login')}}">Se connecter</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/register')}}">S'inscrire</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <hr>
    <div class="container p-4">
        <h4 class="text-white text-center">Chaque jour un nouveau défi de mots avec LexiQuiz</h4>

        <div class="container pt-4" style="width:; height:">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6"> <img src="{{ asset('img/coup-moyen-femme-posant-points-interrogation.jpg') }}" alt="" class="img-fluid"></div>
            <div class="col-md-3"></div>
        </div>
        </div>

       <div class=" pt-4 row">
          <div class="text-center">
          <button type="button" class="btn  btn-success"><a class="link text-white" href="{{ url('/show-login') }}">Commencer</a></button>
          </div>
       </div>
    </div>
    <hr>

    <footer class="bg-black">
        <div class="row">
            
            <span class="text-white text-center">© 2023 LexiQuiz </span>

        </div>
    </footer>
    
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>