<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ajout articles</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    </head>
    <body style="background-color: #DBDBE1;">
    	<?php require("nav.html"); ?>  
    	
        <h1 class='text-center mt-3'>Ajoutez un article</h1>

        <div class="container">
				<div class="row">
        <form action="addProduct.php" method="post" enctype="multipart/form-data" style="margin-top: 50px; background-color: #252a37; padding: 50px; text-align: center; color: white; border-radius: 30px;" class="col-lg-8 me-auto mx-auto">
        	<input type="hidden" name="size" value="1000000">
        	<div class="form-group">
				<div class="input-group mb-3">
				<span class="input-group-text"><i class="fas fa-user"></i></span>
				<input type="text" name="nom" class="form-control" placeholder="Nom">
			</div>
			</div>
			<div class="form-group">
				<div class="input-group mb-3">
					<span class="input-group-text"><i class="fas fa-image"></i></span>			
					<input type="file" name="image" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<div class="input-group mb-3">
					<span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
					<input type="text" name="titre" class="form-control" placeholder="Titre">
				</div>
			</div>
			<div class="form-group">
				<div class="input-group mb-3">
					<span class="input-group-text"><i class="fas fa-list-ul"></i></span>	
				<select class="form-select form-control" aria-label="Default select example" name="section" id="section-select">
  					<option selected>--Choisir une catégorie--</option>
 					<option value="Sport">Sport</option>
					<option value="Mobilier">Mobilier</option>
					<option value="High-Tech">High-Tech</option>
					<option value="Musique">Musique</option>
					<option value="Litterature">Littérature</option>
				</select>
				</div>
				<div class="row">
					<div id="liste_mot_clef_1">
						<div class="form-group">
							<div class="input-group mb-3">
								<span class="input-group-text"><i class="fas fa-list-ul"></i></span>
								<select class="form-select form-control" aria-label="Default select example" name="mot_clef_1" id="mot_clef_1">
  									<option selected>--Choisir un mot clef--</option>
  								</select>
  							</div>
  						</div>
					</div>
					<div id="liste_mot_clef_2">
						<div class="form-group">
							<div class="input-group mb-3">
								<span class="input-group-text"><i class="fas fa-list-ul"></i></span>
								<select class="form-select form-control" aria-label="Default select example" name="mot_clef_2" id="mot_clef_2">
  									<option selected>--Choisir un mot clef--</option>
  								</select>
  							</div>
  						</div>
  					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group mb-3">
					<span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>				
					<textarea class="form-control" rows="5" name="description" placeholder="Description"> </textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group mb-3">
					<span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
				  <input type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" placeholder="Prix" name="prix">
				</div>
			</div>
			<button type="submit" name="envoie">Envoyer</button>
		</form>   
		</div></div>  


	<script type="text/javascript" src="../js/product.js" > </script> 

    </body>
</html>

<?php
	include_once '../php/product.php';
	$product=new Product();

	if(isset($_POST['envoie'])){
		$image=$_FILES['image']['name'];
		$idUser=$product->getIdUser();
		$int=(int)$idUser;
		$idImage=$product->uploadImage($image,$idUser);
		$titre=$_POST['titre'];
		$category=$_POST['section'];
		$mot_clef_1=$_POST['mot_clef_1'];
		$mot_clef_2=$_POST['mot_clef_2'];

		$description=$_POST['description'];
		$prix=$_POST['prix'];

		$product->addProduct($titre,$category,$description, $prix,$idUser,$idImage,$mot_clef_1,$mot_clef_2);
	}

?>





