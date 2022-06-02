@extends('template')
<!--Autor: Nikola Jovanović 0440/2019-->


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

<div id="prva">
        <table>
            <tr>
                    <td>
                        <form action="{{ route('pregledrecepataK') }}" method="GET">
                        @csrf<button class="btnn" onclick="">Pregled recepata</button></form>
                    </td>

                
                <td><form action="{{ route('dodajrecept') }}" method="GET">
                    @csrf<button class="btnn" onclick="">Dodaj recept</button></form>
                </td>

                <td><form action="{{ route('omrecepti') }}" method="GET">
                    @csrf<button class="btnn" onclick="">Omiljeni recepti</button></form>
                </td>

                <td><form action="{{ route('mojirecepti') }}" method="GET">
                    @csrf<button class="btnn" onclick="">Moji recepti</button></form>
                </td>

                <td><form action="{{ route('prikaziKorisnikoveNamirnice',['id' =>  $kor['KorId'] ]) }}" method="GET">
                    @csrf<button class="btnn" onclick="">Namirnice kod kuće</button></form>
                </td>

                <td><form action="{{ route('odjava')  }}" method="POST">
                    @csrf<button class="btnn" onclick="">Odjavi se</button></form>
                </td>
            </tr>
        </table>
    </div>

@endsection

@section('footer')
<hr>
@endsection