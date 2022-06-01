@extends('template_defined')

@section('customImports')
    <link rel="stylesheet" href="{{ asset('css/namirnice.css') }}">

    <script src="{{ asset('js/namirnice.js') }}"></script>
@endsection

@section('content')
<h4 class="center">
    {{$kor['KorisnickoIme']}} namirnice:
</h4>
<table class="table table-stripped table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Ime sastojka</th>
            <th>Kolicina(g)</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($namirnice as $namirnica)    
        <tr id="namirnica{{ $namirnica['NamId'] }}">
            <td>{{ $namirnica['Naziv'] }}</td>
            <td>{{ $namirnica['Kolicina'] }}</td>
            <td>
                <button class="btn btn-danger obrisi" id="{{ $namirnica['NamId'] }}">Obrisi</button>
            </td>
        </tr>
        @endforeach
        <tr id="mesto">
            <!-- Mesto za dodavanje namirnica-->
        </tr>
        <tr>
            <td>
                <input type="text" class="" placeholder="Ime namirnice" name="imeNamirnice">
            </td>
            <td>
                <input type="text" class="" placeholder="Kolicina namirnice" name="kolicinaNamirnice">

                <input type="text"  id="korId" value="{{$kor['KorId']}}" style="display: none" />
            </td>
            <td>
                <button class="btn btn-info dodaj" >Dodaj</button>
            </td>
        </tr>
    </tbody>
</table>

@endsection

<style>

body {
    background: rgb(26, 25, 25);
}
#header{
    color:rgb(245, 242, 242);
    margin-top: 10px;
    text-align:center;
    font-family: 'Raleway',Helvetica,Arial,Lucida,sans-serif;
    text-shadow: 0.08em 0.08em 0em rgb( 200 200 200 / 40%);
    font-weight: 400;
    font-size: 3vw;
}
.slika{
    width: 70px;
    height: 65px;
}
#divh{
    height: 60px;
    background: rgb(26, 25, 25);
    width: 100%;
}
    

#prva{
    background: rgb(241, 83, 15);
    height: 70px;
   text-align: right;
   color:white;
}
.btnn{
    background: rgb(241, 83, 15);
    font-size: 20px;
    color:rgb(70, 69, 69);
    border: 0px;
    width: 200px;
    margin-top: 17px;
  
}

.receptslika{
    width: 350px;
    height: 350px;
}

.center {
  display: flex;
  justify-content: center;
  margin-top: 5%;
}

.card-img-top {
  height: 15%;
}

.space {
  display: flex;
  justify-content: space-between;
}


table {
  margin: 7px;
  width: min-content;
  height: min-content;
}



.row {
  margin-top: 3%;
  margin-bottom: 3%;
}

.form-inline {
  margin-bottom: 2%;
}


.userComment {

.row-line {
  display: flex;
  justify-content: space-between;
}  
</style>    