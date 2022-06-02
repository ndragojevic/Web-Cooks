<!DOCTYPE html>
<!--Autor: Anastasija Vasic 0430/2019-->
<!--GOST: Prikaz jednog recepta. Gost vidi datum objavljivanja, autora recepta, prosecnu ocenu, vreme pripreme, sliku, postupak,
    listu namirnica. Postoji i opcija prikaz komentara ispod recepta-->
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="<?php echo e(asset('css/recepti.css')); ?>">
        <title>Web kuvar</title>
    </head>
    
    <body>
    
        <div id="prva" class=row-inline >
            <table>
                <tr>
                    <form action="<?php echo e(route('index')); ?>" method="GET">
                        <?php echo csrf_field(); ?><button class="btnn" onclick=""> Pocetak</button></form>
                    <form action="<?php echo e(route('login')); ?>" method="GET">
                        <?php echo csrf_field(); ?><button class="btnn" onclick="">Prijava</button></form>
                     <form action="<?php echo e(route('registracija')); ?>" method="GET"> 
                        <?php echo csrf_field(); ?> <button class="btnn" onclick="">Registracija</button></form>
                </tr>
            </table>
          
        </div>
        <div id="divimg">
            <h1 id="header"><br>Web Kuvar</h1> 
        </div>
        <br><br>
        <div class=container>
            <div style="display:none">
            <?php if($recept['TezinaIzrade'] == 'tesko'): ?>
                <?php echo e($boja = 'red'); ?>

            <?php else: ?>
                <?php if($recept['TezinaIzrade'] == 'lako'): ?>
                <?php echo e($boja = 'green'); ?>

                <?php else: ?>
                    <?php echo e($boja = 'yellow'); ?>

                <?php endif; ?>
            <?php endif; ?>
        </div>
            <p class="naziv"><?php echo e($recept->Naziv); ?>

            <font color="<?php echo e($boja); ?>" size="4px">
                (<?php echo e($recept['TezinaIzrade']); ?>)
            </font></p>
            <hr style="color:white;">
          <h4 style="color:white;">
            
              <img src="/img/cl.png" id="cl">
              <?php echo e($recept->VremeIzrade); ?>min
            </h4> <font color="white" size="5px"><i> Autor: <?php echo e($autor->KorisnickoIme); ?></i></font>
            &ensp;&ensp;&ensp; <font color="white" size="5px"><i> Datum: <?php echo e($recept->Datum); ?></i></font>
            <div class="rating" id="ocena<?php echo e($recept['ReceptId']); ?>">
                                    <?php if($recept['BrojOcena'] != 0): ?>
                                        <?php echo e(round($recept['ZbirOcena'] / $recept['BrojOcena'],2)); ?> /5
                                    <?php else: ?>
                                        Nema ocena
                                    <?php endif; ?>
                                    <i class='fa fa-star' style='color: #f3da35'></i>
                                </div>
            <hr style="color:white;">
        <div class=row>
        <div class=col-sm-6 id="rp">
           
           <center> <img class="receptslika" src=<?php echo e("/img/".$recept->SlikaJela); ?> > </center><br>
            
            <?php echo e($recept->Postupak); ?><br><br>
            
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
                    <?php $__currentLoopData = $namirnice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $namirnica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($namirnica->Naziv); ?></td>
                        <td><?php echo e($namirnica->Kolicina); ?></td>
                        <td><?php echo e($namirnica->MerJed); ?></td>
                        <td>
                          
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        </div>
        <hr style="color: white;">
      <div   id="komm">
          <a href="<?php echo e(route('komentarirGost',[$recept->ReceptId])); ?>" style="color: white;">
            Prikaz komentara</a> <img src="/img/com.png" id="slcom">
      </div>
      <hr style="color: white;">
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
.receptslika{
    width: 330px;
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

<?php /**PATH C:\wamp64\www\Faza5-Implementacija\Faza5-Implementacija\resources\views/receptGost.blade.php ENDPATH**/ ?>