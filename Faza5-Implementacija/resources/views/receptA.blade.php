<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="{{ asset('css/recepti.css') }}">
        <title>Web kuvar</title>
    </head>
    <!--ADMIN: PRIKAZ 1 RECEPTA, POSTOJI DODATNO OPCIJA OBRISI RECEPT-->
    <body>
      
        <div id="prva" class=row-inline> <!--id-->
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
        <br><br>
        <div class=container>
            <p class="naziv">{{$recept->Naziv}}</p>
            <hr style="color:white;">
          <h4 style="color:white;">
            <img src="/img/sr.png" id="slomlj">
            <a href="{{ route('dodajomiljeni',[$recept->ReceptId]) }}" style="color: white;">
              Dodaj u omiljene
            </a>
              &ensp;&ensp;&ensp;
              <img src="/img/cl.png" id="cl">
              {{$recept->VremeIzrade}}min
              <form action="{{ route('brisanjeR', [$recept->ReceptId])}}" method="POST">
                @csrf
                <button class="btnnDelete" onclick="">Obriši recept</button>
            </form>
            </h4>
            <div class="rating" id="ocena{{$recept['ReceptId']}}">
                                    @if ($recept['BrojOcena'] != 0)
                                        {{ round($recept['ZbirOcena'] / $recept['BrojOcena'],2)}} /5
                                    @else
                                        Nema ocena
                                    @endif
                                    <i class='fa fa-star' style='color: #f3da35'></i>
                                </div>
            <hr style="color:white;">
        <div class=row>
        <div class=col-sm-6 id="rp">
           
           <center> <img class="receptslika" src={{"/img/".$recept->SlikaJela}} > </center><br>
            
            {{$recept->Postupak}}<br><br>
            
        </div>
        <div class=col-sm-6 id="nam">
           
            <table class="table table-stripped table-hover" name="namirnice" id="namirnice" style="width: 80%;">
                <thead>
                    <tr>
                        <th>Ime namirnice</th>
                        <th>Količina</th>
                        <th>Merna jedinica<th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $namirnice as $namirnica )
                    <tr>
                        <td>{{$namirnica->Naziv}}</td>
                        <td>{{$namirnica->Kolicina}}</td>
                        <td>{{$namirnica->MerJed}}</td>
                        <td>
                          
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
        <hr style="color: white;">
      <div   id="komm">
          <a href="{{ route('komentarir',[$recept->ReceptId]) }}" style="color: white;">
          
          Prikaz komentara</a> <img src="/img/com.png" id="slcom">
      </div>
      <hr style="color: white;">
        <div class="row-line" id="po">
            <form action="{{ route('novikomentar',[$recept->ReceptId]) }}" method="POST">
                @csrf
             <textarea id="username" name="kom" placeholder="Unesite komentar" rows="4" cols="50"
                style="border-radius: 5px;"></textarea>
           <div>
                 <button class="btn btn-info" id="kl" onclick="">Dodaj komentar</button></div>
                
           </form>

        </div>
        </div>
    </body>
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


  /* Position and center the image to scale nicely on all screens */
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
.btnnDelete{
  background: rgb(241, 83, 15);
  border-radius: 5px;
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
  font-size: 30px;
  font-weight: bold;
  text-align: center;
} 
#rp{
    color:white;
    text-align: center;
    font-size:20px;

}
#nam{
    color:white;
    text-align: center;
    font-size:20px;

}
tbody {
  background-color:rgb(26, 25, 25);
  color:white;
}

thead{
    background-color:  rgb(241, 83, 15);
    color:white;
}
#po{
    text-align: center;
    margin-left: 180px;
}
#kl{
    background:  rgb(241, 83, 15);
    color:white;
}
#slcom{
    width:40px;
    height: 40px;
}
#komm{
    color:white;
    font-size: 20px;
    margin-bottom: 10px;
    margin-left: 5px;
}
#slomlj{
    width: 160px;
    height: 120px;
}
#omh{
    width:60px;
    color: white;
   
}
#cl{
    width:40px;
    height: 40px;
}
</style>    

