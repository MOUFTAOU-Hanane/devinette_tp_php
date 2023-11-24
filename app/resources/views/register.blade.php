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


<body class="bg-black">
    <div class="container  p-5">
        <div class="text-center">
            <h1><a class="navbar-brand text-success" href="{{ url('/') }}">LexiQuiz</a></h1>
        </div>


        <div class="container pt-4">


           @if (session('message'))
                    <div class="alert alert-danger">
                        {{ session('message') }}
                    </div>
            @endif


            <div class="row">
                <div class=" col-4  p-4 border  mx-auto rounded bg-white">
                    <h4 class="text-center  pb-4">S'inscrire</h4>

                    <form method="POST" action="{{ route('register-user') }}">
                        @csrf



                        <div class="mb-3">
                            @error('username')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" class="form-control text-center" id="" placeholder="Username"
                                name="username"  required>
                        </div>

                        <div class="mb-3 pt-3">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="email" class="form-control text-center" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Email" name="email" required>
                        </div>

                        <div class="mb-3 pt-3">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="password" class="form-control text-center" id="exampleInputPassword1"
                                placeholder="Password" name="password" required>
                        </div>

                        <div class="pt-4 row">
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">S'inscrire</button>
                            </div>
                        </div>
                    </form>
                </div>



            </div>


        </div>



    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>



</html>
