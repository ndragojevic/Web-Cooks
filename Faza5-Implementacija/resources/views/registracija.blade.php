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

    <link rel="stylesheet" href="register.css">

    <!--<script src="register.js"></script>-->

    <title>
        Web kuvar
    </title>
</head>

<body>
    <div id="prva"  > <!--id?-->
            <table>
                <tr>
                   <form action="{{ route('index') }}" method="GET">
                        @csrf<button class="btnn" onclick=""> Pocetak</button></form>
                    
                </tr>
            </table>
          
        </div>

        <div id="divimg">
            <h1 id="header"><br>Web Kuvar</h1>    
        </div>

    <!--Dzoni, za autentifikaciju:-->
    <div class="alert alert-danger alter-dismissible fade show" role="alert" hidden="true">
        Neuspešna registracija
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
    </div>
    <div class="alert alert-success alter-dismissible fade show" role="alert" hidden="true">
        Uspešno registrovanje
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
    </div>
<center>
    @if (session('status'))
    <font color='red'>{{session('status')}}</font>
    @endif</center>



    <form action="{{ route('regsubmit') }}" method="POST"> 
        @csrf
        
    <div class="form-group" style="text-align: center;">
        <div class="form-group">
            
            <label for="name" style="color:white">Ime</label><br>
               <center>
            <input type="text" id="name" name="ime" placeholder="Ime" size="50" style="border-radius: 5px;" value="{{old('name')}}">
               </center>
            <td> @error('ime')  <font color='red'> {{ $message }} </font>
            @enderror</td>
          
        </div>
        <div class="form-group">
            <label for="surname" style="color:white">Prezime</label><br>
            <center>
            <input type="text" id="surname" name="prezime" placeholder="Prezime" size="50" style="border-radius: 5px;"></center>
            <td> @error('prezime')  <font color='red'> {{ $message }} </font>
                @enderror</td>
        </div>
        <div class="form-group">
            <label for="username" style="color:white">Korisničko ime</label><br>
            <center>
            <input type="text" id="username" name="korisnickoime" placeholder="Korisničko ime" size="50" style="border-radius: 5px;"></center>
            <td> @error('korisnickoime')  <font color='red'> {{ $message }} </font>
                @enderror</td>
        </div>
        <div class="form-group">
            <label for="email" style="color:white">Email</label><br>
           <center> <input type="email" id="email" name="email" placeholder="Email" size="50" style="border-radius: 5px;"></center>
           <td> @error('email')  <font color='red'> {{ $message }} </font>
            @enderror</td>
        </div>
        <div class="form-group">
            <label for="password" style="color:white">Šifra</label><br>
            <center>
            <input type="password" id="password" name="sifra" placeholder="Šifra" size="50" style="border-radius: 5px;"></center>
            <td> @error('sifra')  <font color='red'> {{ $message }} </font>
                @enderror</td>
        </div>
        <div class="form-group">
            <label for="password2" style="color:white">Potvrdi šifru</label><br>
            <center>
            <input type="password" id="password2" name="potvrdasifre" placeholder="Potvrdi šifru" size="50" style="border-radius: 5px;"></center>
            <td> @error('potvrdasifre')  <font color='red'> {{ $message }} </font>
                @enderror</td>
        </div>
        <button type="submit" class="btn btn-primary btn-success">Registruj se</button>
    </div>
    </form>

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

</style>