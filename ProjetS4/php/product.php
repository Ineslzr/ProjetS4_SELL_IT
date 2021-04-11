<?php
    require_once "connexionBD.php";
    Connexion::initConnexion();
    
    class Product extends Connexion{

		public function __construct() {

		}

		public function uploadImage($image,$idUser){

			$target ="../images_articles/".basename($_FILES['image']['name']);

			$sql = self::$bdd -> prepare("INSERT INTO images(titreImage,idUser) VALUES(?,?);");
			$sql->execute(array($image,(int)$idUser));

			$sql = self::$bdd -> prepare("SELECT id FROM images where titreImage = ?;");
			$sql->execute(array($image));
			move_uploaded_file($_FILES['image']['tmp_name'], $target);

			return $sql->fetch();

		}


		public function addProduct($titre,$category, $description, $prix,$idUser,$idImage,$mot_clef_1,$mot_clef_2){
			$int=(int)$idUser;
			$prepare = self::$bdd->prepare("INSERT INTO produits(titre,category,description,prix,idUser,idImage,mot_clef_1,mot_clef_2) VALUES(?,?,?,?,?,?,?,?);");
			$prepare-> execute(array($titre,$category,$description,$prix,(int)$idUser,$idImage['id'],$mot_clef_1,$mot_clef_2));
		}

		public function getIdUser(){
			$unique_id=$_SESSION['unique_id'];
			$sql= self::$bdd->prepare("SELECT idUser FROM utilisateurs WHERE unique_id = ?");
			$sql->execute(array($unique_id));
			return $sql->fetch();
		}

		public function displayProduct(){
			$prepare = self::$bdd->prepare("SELECT nomUser,unique_id,titre,category, description, prix,idImage, titreImage FROM produits,images,utilisateurs where produits.idImage=images.id AND produits.idUser=utilisateurs.idUser; ");
			$prepare->execute();
			$product=$prepare->fetchAll();
?>
		<?php
			foreach ($product as $value){ ?>
				<div class="col-md-3 ms-2 my-1">
				    <div class="card border-secondary" style="width: 18rem;">
	  					<?php echo "<img src='../images_articles/".$value['titreImage']."' alt='img_product'> "; ?>
		  				<div class="card-body">
		    				<h5 class="card-title text-light bg-info text-center rounded p-1 " ><?php echo $value['titre'] ?></h5>
							<p class="card-text"><strong>Categorie : </strong><?php echo $value['category'] ?></p>
						    <p class="card-text"><strong>Description : </strong><?php echo $value['description'] ?></p>
						    <p class="card-text"><strong>Prix : </strong> <?php echo $value['prix'] ?></small></p>
						    <div class="btn-group center-block" role="group" aria-label="Basic example">
  								<button type="button" class="btn btn-secondary" id="contact" <?php echo "data-id=\"".$value['unique_id']."\"";?> >Contacter l'offreur</button>
  							</div>
		  				</div>
					</div>
				</div>
			<?php
			}
			
		}

		public function getProductUser(){
			$unique_id=$_SESSION['unique_id'];
			$sql = self::$bdd->prepare("SELECT idProduit,titre,category, description, prix,titreImage FROM produits,images,utilisateurs where produits.idImage=images.id AND produits.idUser=utilisateurs.idUser AND utilisateurs.unique_id=".$unique_id."; ");
			$sql->execute();
			$product=$sql->fetchAll();

			foreach ($product as $value){
		?>
				<div class="col-md-3 ms-2 my-1">
					<div class="input-group-text">
    					<input class="form-check-input mt-0" type="checkbox" value="<?php echo $value['idProduit'] ?>" aria-label="Checkbox for following text input" id="prod_comp">
 					</div>
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

	}
?>