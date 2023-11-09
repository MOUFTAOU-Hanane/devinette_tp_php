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
    hr {
        color: black;
    }
</style>

<body class="">
    <div class="container  p-5">
        <div class="text-center">
            <h1><a class="navbar-brand text-success" href="{{ url('/home')}}">LexiQuiz</a></h1>
        </div>


        <div class="container pt-4">

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <div class="row">
                <div class="col-1"></div>
                <div class=" col-4  p-4 border  mx-5 rounded bg-white">
                    <h4 class="text-start  pb-4">Se connecter</h4>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">

                            <input type="text" class="form-control text-start" id="" placeholder="Username"
                                name="username">
                        </div>

                        <div class="mb-3 pt-3">
                            <input type="password" class="form-control text-start" id="exampleInputPassword1"
                                placeholder="Password" name='password'>
                        </div>
                        <div class="pt-4 row">
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Se connecter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-4   p-4 rounded border text-center  bg-white">
                    <h4 class="text-start  pb-4">Pas encore de compte?</h4>
                    <p class="text-start">
                        Prêt à percer les mystères des mots ? Rejoignez-nous en créant un compte aujourd'hui !
                    </p>
                    <button type="button" class="btn btn-outline-success text-center"><a class="navbar-brand text-success" href="{{ url('/register')}}">S'inscrire</a></button>



                </div>


            </div>


        </div>



    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>