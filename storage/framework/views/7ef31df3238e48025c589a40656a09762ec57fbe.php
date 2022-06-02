<!DOCTYPE html>
<html lang="en">
    <!--Autor: Anastasija Vasić 0430/2019,-->
    <!--REGISTROVANI KORISNIK I ADMIN: Dodavanje namirnica u okviru dodavanja recepta, mogucnost i brisanja dodatih namirnica-->

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

    <link rel="stylesheet">

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
        <h1 id="header"><br>Web kuvar</h1> 
    </div>
    
   
    <div class="form-group">
        <center>
        <table class="table table-stripped table-hover" name="namirnice" id="namirnice" style="width: 80%;">
            <thead>
                <tr>
                    <th>Ime namirnice</th><th></th>
                    <th>Količina</th><th></th>
                    <th>Merna jedinica<th>
                    
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $namirnice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $namirnica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($namirnica->Naziv); ?></td><td></td>
                    <td><?php echo e($namirnica->Kolicina); ?></td><td></td>
                    <td><?php echo e($namirnica->MerJed); ?></td>
                    <td>
                        <form action="<?php echo e(route('obrisimirnicu',[$namirnica->NamId])); ?>" method="GET">
                            <?php echo csrf_field(); ?>

                        <button class="btn btn-danger" onclick="obrisiNamirnicu()">Obriši</button></form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <form action="<?php echo e(route('novanamirnica')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                <tr>
                    <td>
                        <input type="text" class="" placeholder="Ime namirnice" name="imenam">
                    
                       

                    </td>
                    <td> <?php $__errorArgs = ['imenam'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  <font color='red'> <?php echo e($message); ?> </font>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></td>
                
                    <td>
                        <input type="text" class="" placeholder="Količina namirnice" name="kolicina">
                       
                    </td>
                    <td> <?php $__errorArgs = ['kolicina'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  <font color='red'> <?php echo e($message); ?> </font>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></td>
                  
                    <td>
                        <select name="mernajed" id="mernajed" class="">
                            <option value="g">g</option>
                          
                        </select>
                    </td>
                    <td> 

                        <button class="btn btn-success" onclick="">Dodaj</button></form>
                    </td>     
                </tr>
            </tbody>
        </table>
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
</style><?php /**PATH C:\wamp64\www\Faza5-Implementacija\Faza5-Implementacija\resources\views/dodajnamirnice.blade.php ENDPATH**/ ?>