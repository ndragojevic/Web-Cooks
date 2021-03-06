<!DOCTYPE html>
<!--Autor: Natalija Dragojevic 0325/2019-->
<!--REGISTROVANI KORISNIK I ADMIN: Prikaz omiljenih recepata-->
<?php  use App\Models\ReceptModel;?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Web kuvar</title>
    </head>

    <body>
      
      <div id="prva" class=row-inline> 
        <table>
            <tr>
              <form action="{{ route('pregledrecepataK') }}" method="GET">
                @csrf<button class="btnn" onclick="">Pregled recepata</button></form>

                <form action="{{ route('dodajrecept') }}" method="GET">
                    @csrf<button class="btnn" onclick="">Dodaj recept</button></form>

               <form action="{{ route('omrecepti') }}" method="GET">
                    @csrf<button class="btnn" onclick="">Omiljeni recepti</button></form>
              
               <form action="{{ route('mojirecepti') }}" method="GET">
                    @csrf<button class="btnn" onclick="">Moji recepti</button></form>
               
               <form action="{{ route('prikaziKorisnikoveNamirnice',['id' =>  $kor['KorId'] ]) }}" method="GET">
                    @csrf<button class="btnn" onclick="">Namirnice kod kuće</button></form>
               
                <form action="{{ route('odjava') }}" method="POST">
                    @csrf<button class="btnn" onclick="">Odjavi se</button></form>
            </tr>
        </table>
               
    </div>

        <div id="divimg">
            <h1 id="header"><br>Web Kuvar</h1> 
        </div>
     
<div class=container>
             <div class=row>
                <center> <h3 style="color:white;">Omiljeni recepti:</h3> </center><br><br>
                @foreach ( $omiljeni as $om )
                <?php
                 $recept= ReceptModel::where('ReceptId',$om->ReceptId)->first();
                ?>
               <div class=col-sm-4>
                  <img class="receptslika" src={{"/img/".$recept->SlikaJela}} >
                  <a href="{{ route('receptpregled',[$recept->ReceptId]) }}"> <p class="naziv"> {{$recept->Naziv}}</p></a>
                </div>
                   @endforeach
                </div>
</div>
    
        
</html>

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
    
#divimg{
  height: 150px;
  background: white;
  width: 100%;
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/img/p.jpg');
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
</style>    

