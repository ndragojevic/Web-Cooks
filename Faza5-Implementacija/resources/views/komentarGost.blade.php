<!DOCTYPE html>
<!--Autor: Natalija Dragojevic 0325/2019-->
<!--GOST(Neregistrovani korisnik): Prikaz svih komentara ispod 1 recepta-->
<?php  use App\Models\KorisnikModel;?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Web kuvar</title>
    </head>
    <body>
        
        <div id="prva" class=row-inline >
            <table>
                <tr>
                    <form action="{{ route('index') }}" method="GET">
                        @csrf<button class="btnn" onclick=""> Pocetak</button></form>
                    <form action="{{ route('login') }}" method="GET">
                        @csrf<button class="btnn" onclick="">Prijava</button></form>
                     <form action="{{ route('registracija') }}" method="GET"> 
                        @csrf <button class="btnn" onclick="">Registracija</button></form>
                </tr>
            </table>
          
        </div>

        <div id="divimg">
            <h1 id="header"><br>Web Kuvar</h1> 
        </div>
        <hr style="color:white;">
        <br>
        <h2 id="h2"> {{$recept->Naziv}} - Komentari</h2>
        <br>
        @foreach ( $kom as $k )

        <?php
        $kor= KorisnikModel::where('KorId',$k->KorId)->first();
        ?>
       <p class="kompara">
       <strong>{{$kor->Ime}}:</strong><br>
      
        {{$k->Tekst}}<br>
       </p><hr style="color:white;">
        @endforeach
       
    </body>
</html>

<style>


body {
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{"/img/".$recept->SlikaJela}});
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
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
    
#divimg{
  height: 150px;
  width: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
  margin-top: 10px;
  text-align: center;
}
#imgdiv{
    height: 60px;
   width: 60px;
}
#prva{
    background: rgb(241, 83, 15);
    height: 70px;
   text-align: left;
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

.korisnik {
  font-weight: bold;
  color: steelblue;
  font-style: italic;
}

.date {
  font-style: italic;
  font-size: small;
}

.grade {
  justify-content: space-around;
}

.checked {
  color: #f3da35;
}

.row {
  margin-top: 3%;
  margin-bottom: 3%;
}

.form-inline {
  margin-bottom: 2%;
}

.tag {
  color: #fff;
  background-color: green;
  display: flex;
  justify-content: space-between;
  text-align: center;
  vertical-align: middle;
  user-select: none;
  border: 2px dotted darkblue;
  padding: 0.375rem 0.75rem;
  font-size: 12px;
  margin: 2px;
  width: 105px;
}

.userComment {
  display: flex;
  float: right;
}

.card {
  height: auto;
}

.row-line {
  display: flex;
  justify-content: space-between;
}  
.naziv{
  color:white;
  font-size: 20px;
} 
.kompara{
    color:rgb(26, 25, 25);;
    font-size: 25px;
    background-color:ivory;
    margin-left: 30px;
    margin-right: 30px;
}
#h2{
   
    color:rgb(245, 242, 242);
    margin-top: 10px;
    text-align:center;
    font-family: 'Raleway',Helvetica,Arial,Lucida,sans-serif;
    text-shadow: 0.08em 0.08em 0em rgb( 200 200 200 / 40%);
    font-weight: 300;
    font-size: 3vw;
    
}
</style>    

