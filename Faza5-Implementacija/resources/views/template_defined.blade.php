@extends('template')

@section('title','Web kuvar')

@section('imports')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
@endsection


@section('header')

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Web kuvar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="login.html" id="login">Prijava </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../register/register.html" id="sign-up">Registracija</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="" id="logout">Odjava</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../dodajRecept/dodajRecept.html" id="create_post">Dodaj recept</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../recepti/recepti.html">Prikazi recepte</a>
                </li>
                <li class="nav-item">
                     <a class="nav-link active" href="../namirnice/namirnice.html">Prikazi namirnice</a>
                </li>
        </div>
        </li>
        </ul>
        </div>
    </nav>


@endsection

@section('footer')
<hr>
<center>Copyright WebCooks 2022</center>
@endsection