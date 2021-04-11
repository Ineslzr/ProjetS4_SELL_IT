<?php
	try{
    	$bdd = new PDO('mysql:host=localhost;dbname=collection;charset=utf8', 'root', '');
    }catch (Exception $e){
    	die('Erreur : ' . $e->getMessage());
	}

	
    if(isset($_POST['category'])){
    	$category=$_POST['category'];

    	if(empty($_POST['prix'])){  	
	    	if($category== "tout"){
	    		$sql = $bdd -> prepare("SELECT titre,category, description, prix,idImage, titreImage FROM produits,images where produits.idImage=images.id;");
	    	} else {
	    		$sql = $bdd -> prepare("SELECT titre,category, description, prix,idImage, titreImage FROM produits,images where produits.idImage=images.id AND category ='".$category."';");
	    	}
	    } else {
	    	$prix=(int)$_POST['prix'];
	    	$sql = $bdd -> prepare("SELECT titre,category, description, prix,idImage, titreImage FROM produits,images where produits.idImage=images.id AND prix < ".$prix." AND category='".$category."';");
	    }
    	$sql->execute();
    	$res=$sql->fetchAll();
  	
    	$result='';
    	if(!empty($res)){
	    	foreach ($res as $value) {
	    		$result .='<div class="col-md-3 ms-2">
					    <div class="card border-secondary" style="width: 18rem;">
		  					<img src="../images_articles/'.$value['titreImage'].'" alt="img_product">
			  				<div class="card-body">
			    				<h5 class="card-title text-light bg-info text-center rounded p-1 " >'.$value['titre'].'</h5>
								<p class="card-text"><strong>Categorie : </strong>'.$value['category'].'</p>
							    <p class="card-text"><strong>Description : </strong>'.$value['description'].'</p>
							    <p class="card-text"><strong>Prix : </strong>'.$value['prix'].'</small></p>
			  				</div>
						</div>
					</div>';
	    	}

	    }else{
	    	$result="<h3>Aucun produits trouvé</h3>";
	    }

	    echo $result;
	    	    	
    }

?>