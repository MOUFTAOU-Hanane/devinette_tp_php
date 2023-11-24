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

        <div class="container mt-3">
            <h1 class="text-center text-white pb-4">Score des utilisateurs</h1>

            <table class="table">
                <tbody>
                    @if (isset($userScores) && count($userScores) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nom utilisateur</th>
                                    <th scope="col">Score</th>
                                    <th scope="col">Historique</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userScores as $user)
                                    <tr>
                                        <td>{{ $user['friend']->username }}</td>
                                        <td>{{ $user['totalScore'] }}</td>
                                        <td><a href="{{ route('historique', ['id' => $user['friend']->id]) }}"
                                                class="btn-link btn-primary">Historique</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Aucun ami trouvé. Ajoutez des amis pour voir leurs scores.</p>
                    @endif


                </tbody>
            </table>

            <a href="{{ url()->previous() }}" class="mt-2 btn btn-success">Retour</a>

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
