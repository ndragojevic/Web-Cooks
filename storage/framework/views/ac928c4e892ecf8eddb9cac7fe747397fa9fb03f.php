
<!DOCTYPE html>
<html lang="en">
    <!--Autor: Anastasija Vasić 0430/2019,-->
    <!--REGISTROVANI KORISNIK I ADMIN: Dodavanje recepta-->

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

    <title>
        Web kuvar
    </title>
</head>

<body>
    <div id="prva" class=row-inline>
        <table>
            <tr>
              <form action="<?php echo e(route('pregledrecepataK')); ?>" method="GET">
                <?php echo csrf_field(); ?><button class="btnn" onclick="">Pregled recepata</button></form>

                <form action="<?php echo e(route('dodajrecept')); ?>" method="GET">
                    <?php echo csrf_field(); ?><button class="btnn" onclick="">Dodaj recept</button></form>

               <form action="<?php echo e(route('omrecepti')); ?>" method="GET">
                    <?php echo csrf_field(); ?><button class="btnn" onclick="">Omiljeni recepti</button></form>
              
               <form action="<?php echo e(route('mojirecepti')); ?>" method="GET">
                    <?php echo csrf_field(); ?><button class="btnn" onclick="">Moji recepti</button></form>
               
                    <form action="<?php echo e(route('prikaziKorisnikoveNamirnice',['id' =>  $kor['KorId'] ])); ?>" method="GET">
                        <?php echo csrf_field(); ?><button class="btnn" onclick="">Namirnice kod kuće</button></form>
               
                <form action="<?php echo e(route('odjava')); ?>" method="POST">
                    <?php echo csrf_field(); ?><button class="btnn" onclick="">Odjavi se</button></form>
            </tr>
        </table>
               
    </div>

    <div id="divimg">
        <h1 id="header"><br>Web Kuvar</h1> 
    </div>
    
    <div class="alert alert-success alter-dismissible fade show" role="alert" hidden="true">
        Uspešno dodat recept!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
    </div>

    <form action="<?php echo e(route('novirecept')); ?>" method="POST">
        <?php echo csrf_field(); ?>
    <div class="form-group" style="text-align: center;">
        <div class="form-group">
            <label for="name" style="color:white">Ime recepta</label><br>
            <input type="text" id="name" name="name" placeholder="Ime recepta"
                size="50" style="border-radius: 5px;">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  <font color='red'><br> <?php echo e($message); ?> </font>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="image" style="color:white">Dodajte sliku</label><br>
            <input type="file" id="image" name="slika" 
                style="border-radius: 5px;">
                <?php $__errorArgs = ['slika'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  <font color='red'> <br><?php echo e($message); ?> </font>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="username" style="color:white">Opis pripreme</label><br>
            <textarea id="username" name="username" placeholder="Opis..." rows="10" cols="50"
                style="border-radius: 5px;"></textarea>
                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  <font color='red'> <br><?php echo e($message); ?> </font>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="category" style="color:white">Kategorija</label>
            <select name="category" id="category" class="form-select" style="border-radius: 5px;">
                <option value="Salate">Salate</option>
                <option value="Torte i kolaci">Torte i kolači</option>
                <option value="Supe i corbe">Supe i čorbe</option>
                <option value="Riba i morski plodovi">Riba i morski plodovi</option>
                <option value="Glavna jela">Glavna jela</option>
            </select>

        </div>
        <div class="form-group">
            <label for="Work duration" style="color:white">Vreme pripreme u minutima</label><br>
            <input type="number" id="Work duration" name="Workduration"
                placeholder="Vreme pripreme" min="0" max="100000" style="border-radius: 5px;">
                <?php $__errorArgs = ['Workduration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  <font color='red'> <br><?php echo e($message); ?> </font>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
        <label for="level" style="color:white">Težina izrade</label>
            <select name="level" id="level" class="form-select" style="border-radius: 5px;">
                <option value="lako">lako</option>
                <option value="srednje">srednje</option>
                <option value="tesko">teško</option>
            </select>
        </div>
       
        <input type="submit" name="Trazi" value="Dodaj namirnice za recept"  class="btn btn-primary btn-success">

    </form>
    </div>
    <br><br>

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

input[type='number']{
    width: 140px;
} 

</style><?php /**PATH C:\wamp64\www\Faza5-Implementacija\Faza5-Implementacija\resources\views/dodajrecept.blade.php ENDPATH**/ ?>