<?php 
 include_once '../php/product.php';
 $product=new Product();
 include_once '../php/filtre.php'; 
 $filtre=new Filtre();
?>

<!DOCTYPE html>
<html>
    <head>       
        <meta charset="utf-8">
        <!--<link rel="stylesheet" href="cours.css">-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <title>Home</title>

    </head>
    <body>
        <?php require("nav.html"); ?> 

        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-2">
                    <h5 class="text-center">Filtrez les produits !</h5>
                    <hr>
                    <h6 class="text-info text-center">Selectionnez un intervalle de prix </h6>
                    <label for="customRange2" class="form-label">Moins de : </label><br>
                    <input type="range" class="form-range" min="0" max="1000" id="customRange2">
                    <span class="border border-5" id="val_range">500 </span>

                </div>
                <div class="col-lg-10">
                    <h5 class="text-center" id="textChange"> Les produits</h5>
                    <hr>
                     <?php  
                            $listCat=$filtre->getListCategory();
                            $filtre->displayListCategory($listCat);
                        ?>   
                    <div class="row" id="result">
                        <?php 
                            $product->displayProduct();
                        ?>
                    </div>


                </div>
            </div>
            
        </div>
    <script type="text/javascript" src="../js/filtre.js"> </script>
    <script type="text/javascript" src="../js/users.js" > </script>
    </body>
</html>