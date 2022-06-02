<!--Autor: Nikola Jovanovic 0440/2019-->
<!--REGISTROVANI KORISNIK I ADMIN: Prikaz namirnica koje korisnik ima kod kuce, njihovo dodavanje i brisanje-->



<?php $__env->startSection('customImports'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/namirnice.css')); ?>">

    <script src="<?php echo e(asset('js/namirnice.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<h4 class="center">
    <?php echo e($kor['KorisnickoIme']); ?> namirnice:
</h4>
<table class="table table-stripped table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Ime sastojka</th>
            <th>Kolicina(g)</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $namirnice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $namirnica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
        <tr id="namirnica<?php echo e($namirnica['NamId']); ?>">
            <td><?php echo e($namirnica['Naziv']); ?></td>
            <td><?php echo e($namirnica['Kolicina']); ?></td>
            <td>
                <button class="btn btn-danger obrisi" id="<?php echo e($namirnica['NamId']); ?>">Obrisi</button>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr id="mesto">
            <!-- Mesto za dodavanje namirnica-->
        </tr>
        <tr>
            <td>
                <input type="text" class="" placeholder="Ime namirnice" name="imeNamirnice">
            </td>
            <td>
                <input type="text" class="" placeholder="Kolicina namirnice" name="kolicinaNamirnice">

                <input type="text"  id="korId" value="<?php echo e($kor['KorId']); ?>" style="display: none" />
            </td>
            <td>
                <button class="btn btn-info dodaj" >Dodaj</button>
            </td>
        </tr>
    </tbody>
</table>

<?php $__env->stopSection(); ?>

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
    

#prva{
    background: rgb(241, 83, 15);
    height: 70px;
   text-align: right;
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

.row {
  margin-top: 3%;
  margin-bottom: 3%;
}

.form-inline {
  margin-bottom: 2%;
}


.userComment {}

.row-line {
  display: flex;
  justify-content: space-between;
}  
</style>    
<?php echo $__env->make('template_defined', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Faza5-Implementacija\Faza5-Implementacija\resources\views/korisnikoveNamirnice.blade.php ENDPATH**/ ?>