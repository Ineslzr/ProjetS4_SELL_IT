<?php session_start(); ?>
<?php 	
	include_once '../php/product.php';
	$product=new Product();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Comparateur</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    </head>
    <body style="background-color: #DBDBE1;">
    	<?php require("nav.html"); ?>  
    	<div class="container-fluid mt-3">
            <div class="row">
				<div class="col-lg-10">	
					<h6 class="text-center" id="indication">Sélectionnez un de vos produits que vous voulez analyser</h6>
						<div class="row mx-auto" id="produit_selected">							
							<?php
								$product->getProductUser();
							?>	
						</div>					
	
					<div class="row mx-auto" id="result"></div>
					
				</div>
			</div></div>

	<script type="text/javascript" src="../js/comparateur.js" > </script> 
    </body>

</html>