<!DOCTYPE html>
<!--Autori: Anastasija Vasić 0430/2019,
          Nikola Jovanović 0440/2019
          Natalija Dragojević 0325/2019-->

<!--GOST: Pocetna strana aplikacije kada joj pristupa neregistrovani korisnik, tj gost. Gost ima opciju pretrage namirnica
  prema nazivu, prema kategoriji, opciju logovanje i registraciju. Podrazumevano se izlistavaju svi recepti sa sajta.-->
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

    <script src="<?php echo e(asset('js/recepti.js')); ?>"></script>
        <title>Web kuvar</title>
    </head>
  
    <body>
        <div id="prva">
            <table>
                <tr>
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

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="row-line">
                        <div class="form-inline">
                            <form name="filter" action=" <?php echo e(route('filtrirajRecepteGost')); ?>" method="post" class="form-inline">
                            <?php echo csrf_field(); ?>
                            <input type="text" class="form-control mr-sm-2" type="search" placeholder="Pretrazi po imenu" aria-label="Search" id="naziv" name="naziv" />
                            <input type="text"  id="kategorije" name="kategorije" value="" style="display: none" />
                            <button type="submit" class="btn btn-primary" >
                            Pretrazi
                            </button>
                    </form>
                            <div class="dropdown">
                              <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton"
                           data-toggle="dropdown" aria-haspopup="true"      aria-expanded="false">
                                Kategorije
                                </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" onclick="dodajTag(this.innerText)">Salate</a>
                        <a class="dropdown-item" href="#" onclick="dodajTag(this.innerText)">Torte i kolaci</a>
                        <a class="dropdown-item" href="#" onclick="dodajTag(this.innerText)">Supe i corbe</a>
                        <a class="dropdown-item" href="#" onclick="dodajTag(this.innerText)">Riba i morski plodovi</a>
                        <a class="dropdown-item" href="#" onclick="dodajTag(this.innerText)">Glavna jela</a>
                        </div>
                        </div>
                <div id="tags"></div>
                        </div>
                      </div>           
          </div>
                <?php $__currentLoopData = $recepti; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class=col-sm-4>
                
                  <img class="receptslika" src=<?php echo e("/img/".$recept['SlikaJela']); ?> >
                  <a href="<?php echo e(route('receptpregledGost',[$recept['ReceptId']])); ?>"> <p class="naziv"> <?php echo e($recept['Naziv']); ?></p></a>
                  <div class="rating" id="ocena<?php echo e($recept['ReceptId']); ?>">
                                    <?php if($recept['BrojOcena'] != 0): ?>
                                        <?php echo e(round($recept['ZbirOcena'] / $recept['BrojOcena'],2)); ?> /5
                                    <?php else: ?>
                                        Nema ocena
                                    <?php endif; ?>
                                    <i class='fa fa-star' style='color: #f3da35'></i>
                                </div>
                </div>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
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

<?php /**PATH C:\wamp64\www\Faza5-Implementacija\resources\views/index.blade.php ENDPATH**/ ?>