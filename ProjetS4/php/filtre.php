<?php 
	require_once "connexionBD.php";
    Connexion::initConnexion();

    class Filtre extends Connexion{

    	public function __construct() {

		}

		public function getListCategory(){
			$sql = self::$bdd -> prepare("SELECT DISTINCT nomCategory FROM category ORDER BY nomCategory;");
			$sql->execute(array());

			return $sql->fetchAll();
		}

		public function displayListCategory($listCat){ ?>
            <div class="form-group">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-list-ul"></i></span>    
                <select class="form-select form-control" aria-label="Default select example" name="section" id="section-select">
                    <option selected>--Choisir une catégorie--</option>
                    <option value="tout">Tous les produits</option>
                <?php

                foreach ($listCat as $value){ ?>
                    <option value="<?php echo $value['nomCategory']; ?>"><?php echo $value['nomCategory']; ?></option>
                 <?php
                } ?>               
            </div> </select></div> <?php         
		}

    }
?>