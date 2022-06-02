<!DOCTYPE html>
<!--Autori: Anastasija Vasic 0430/2019,
          Natalija Dragojevic 0325/2019-->

<!--REGISTROVANI KORISNIK: Prikaz jednog recepta. Registrovani korisnik vidi datum objavljivanja, autora recepta, prosecnu ocenu, 
    vreme pripreme, sliku, postupak, listu namirnica. Postoji i opcija prikaz komentara ispod recepta, dodavanja komentara, 
    dodavanje recepta u omiljene-->
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="<?php echo e(asset('css/recepti.css')); ?>">
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
        <title>Web kuvar</title>
    </head>
    <body>
      <!--Pregled recepta kod ulogovanog korisnika-->
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
            <img src="/img/sr.png" id="slomlj">
            <a href="<?php echo e(route('dodajomiljeni',[$recept->ReceptId])); ?>" style="color: white;">
              Dodaj u omiljene
            </a>
              &ensp;&ensp;&ensp;
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
          <a href="<?php echo e(route('komentarir',[$recept->ReceptId])); ?>" style="color: white;">
          Prikaz komentara</a> <img src="/img/com.png" id="slcom">
      </div>
      <hr style="color: white;">
        <div class="row-line" id="po">
            <form action="<?php echo e(route('novikomentar',[$recept->ReceptId])); ?>" method="POST">
                <?php echo csrf_field(); ?>
             <textarea id="username" name="kom" placeholder="Unesite komentar" rows="4" cols="50"
                style="border-radius: 5px;"></textarea>
                <?php $__errorArgs = ['kom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  <font color='red'> <br><?php echo e($message); ?> </font>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
           <div>
                 <button class="btn btn-info" id="kl" onclick="">Dodaj kometar</button></div>
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

<?php /**PATH C:\wamp64\www\Faza5-Implementacija\resources\views/recept.blade.php ENDPATH**/ ?>