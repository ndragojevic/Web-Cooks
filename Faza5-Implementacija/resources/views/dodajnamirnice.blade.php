
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="dodajRecept.css">

    <script src="dodajRecept.js"></script>

    <title>
        Web kuvar
    </title>
</head>
<!--DODAJ NAMIRNICE-->
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
        <h1 id="header"><br>Web kuvar</h1> 
    </div>
    
   
    <div class="form-group">
        <center>
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
                        <form action="{{ route('obrisimirnicu',[$namirnica->NamId]) }}" method="GET">
                            @csrf

                        <button class="btn btn-danger" onclick="obrisiNamirnicu()">Obriši</button></form>
                    </td>
                </tr>
                @endforeach
                <form action="{{ route('novanamirnica') }}" method="POST">
                    @csrf
                <tr>
                    <td>
                        <input type="text" class="" placeholder="Ime namirnice" name="imenam">
                    </td>
                    <td>
                        <input type="text" class="" placeholder="Količina namirnice" name="kolicina">
                    </td>
                    <td>
                        <select name="mernajed" id="mernajed" class="">
                            <option value="g">g</option>
                            <option value="kg">kg</option>
                            <option value="ml">ml</option>
                            <option value="ostalo">ostalo</option>
                        </select>
                    </td>
                    <td> 
                        <button class="btn btn-success" onclick="">Dodaj</button></form>
                    </td>     
                </tr>
            </tbody>
        </table>
        <form action="{{ route('pregledrecepataK') }}" method="GET">
                @csrf<button class="btn btn-success" onclick="">Dodaj recept</button></form> <!--Ovo dugme samo predje na stranicu sa 
                                                                                ostalim receptima, mi smo recept vec dodali na preth strani-->
    </center>
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
.para{
    color:white;
    height: 300px;
    width:500px;
    margin-left: 15px;

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

.card {
  height: auto;
}

tbody {
  background-color: #F7F2A8;
}

thead{
    background-color: #FFC300;
}
</style>