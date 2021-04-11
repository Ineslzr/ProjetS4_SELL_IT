<?php
	try{
    	$bdd = new PDO('mysql:host=localhost;dbname=collection;charset=utf8', 'root', '');
    }catch (Exception $e){
    	die('Erreur : ' . $e->getMessage());
	}
	if(isset($_POST['produit'])){
		$idProduit=(int)$_POST['produit'];
		$sql=$bdd->prepare("SELECT mot_clef_1,mot_clef_2,prix FROM produits WHERE  idProduit= ?;");
		$sql->execute(array($idProduit));
		$res=$sql->fetch();
		$mot_clef_1=$res['mot_clef_1'];
		$mot_clef_2=$res['mot_clef_2'];
		$prix=$res['prix'];

		$sql=$bdd->prepare("SELECT AVG(prix) FROM produits WHERE mot_clef_1=? AND mot_clef_2= ?;");
		$sql->execute(array($mot_clef_1,$mot_clef_2));

		$moyenne=$sql->fetch()['AVG(prix)'];

		$result="<div class='border border-danger rounded ms-2'><h6>Analyse votre produit</h6>
				<p>La moyenne de prix des produits similaire au votre est de :".$moyenne."</p>";

		if($prix >= $moyenne){
			$result.="<p>Votre produit est plus cher, il risque d'être perçue comme moins intéressant et donc vous aurez du mal à le vendre. <strong>Conseil : </strong> Si personne ne semble interessé par votre produit, baissez le prix pour vous aligner avec la concurrence.</p> ";
		} else {
			$result.="<p>Votre produit est moins cher, il devrait être perçu comme intéressant, si vous n'êtes toutefois contacter par personne, n'hésitez pas à apporter plus de détails à la déscription de votre produit ou à la qualité de l'image</p></div>";
		}
		

		$sql=$bdd->prepare("SELECT titre,category, description, prix ,titreImage FROM produits,images where produits.idImage=images.id AND idProduit= ?");
		$sql->execute(array($idProduit));
		$produit=$sql->fetch(); 
		?>

		<div class="col-lg-8 ms-2 my-1">
			<div class="card border-secondary" style="width: 18rem;">
	  			<?php echo "<img src='../images_articles/".$produit['titreImage']."' alt='img_product'> "; ?>
		  		<div class="card-body">
		    		<h5 class="card-title text-light bg-info text-center rounded p-1 " ><?php echo $produit['titre'] ?></h5>
						<p class="card-text"><strong>Categorie : </strong><?php echo $produit['category'] ?></p>
						<p class="card-text"><strong>Description : </strong><?php echo $produit['description'] ?></p>
						<p class="card-text"><strong>Prix : </strong> <?php echo $produit['prix'] ?></small></p>
		  		</div>
			</div>

		</div> <?php
		echo $result;
	}

	if(isset($_POST['val'])){
		$idProduit=(int)$_POST['val'];
		$sql=$bdd->prepare("SELECT mot_clef_1,mot_clef_2 FROM produits WHERE  idProduit= ?;");
		$sql->execute(array($idProduit));
		$res=$sql->fetch();
		$mot_clef_1=$res['mot_clef_1'];
		$mot_clef_2=$res['mot_clef_2'];

		$sql=$bdd->prepare("SELECT idProduit,titre,category, description, prix,titreImage FROM produits,images,utilisateurs where produits.idImage=images.id AND produits.idUser=utilisateurs.idUser AND mot_clef_1=? AND mot_clef_2= ?;");
		$sql->execute(array($mot_clef_1,$mot_clef_2));

		$produits=$sql->fetchAll(); ?>

		<h6 class="text-center">Les produits similaires</h6>
		<?php
		foreach ($produits as $value){
		?>
				<div class="col-md-3 ms-2 my-5">
				    <div class="card border-secondary" style="width: 18rem;">
	  					<?php echo "<img src='../images_articles/".$value['titreImage']."' alt='img_product'> "; ?>
		  				<div class="card-body">
		    				<h5 class="card-title text-light bg-info text-center rounded p-1 " ><?php echo $value['titre'] ?></h5>
							<p class="card-text"><strong>Categorie : </strong><?php echo $value['category'] ?></p>
						    <p class="card-text"><strong>Description : </strong><?php echo $value['description'] ?></p>
						    <p class="card-text"><strong>Prix : </strong> <?php echo $value['prix'] ?></small></p>
		  				</div>
					</div>
				</div>
			<?php
		}


	}
?>