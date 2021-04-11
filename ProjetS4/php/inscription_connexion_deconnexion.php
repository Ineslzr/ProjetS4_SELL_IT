<?php
	session_start();

	require_once "connexionBD.php";
    Connexion::initConnexion();

    class Inscription_connexion_deconnexion extends Connexion{

    	public function __construct() {
 	
		}

		public function inscription($name,$image,$password,$email){

            if(strlen($name) <= 255 && strlen($password) <= 255 && filter_var($email, FILTER_VALIDATE_EMAIL) != false ) {

                $requete=self::$bdd->prepare("SELECT nomUser FROM utilisateurs where nomUser=? ;");
                $requete->execute(array($name));

	            if(!empty($requete->fetch())){
	                echo "<p class='text-center mt-3'><strong>Cet utilisateur existe déjà</strong></p>";
	                            
	            }
	            else{
	            	$status="Active now";
	            	$unique_id=rand(time(),10000000);
	                //Insertion
	                $req=self::$bdd->prepare("INSERT INTO utilisateurs(unique_id,nomUser,password,email,photo_profil,status) VALUES(?,?,?,?,?,?); ");
	                $req->execute(array($unique_id,$name,$password,$email,$image,$status));
	                    echo "<p class='text-center mt-3'><strong>Vous êtes inscrit :)</strong></p>";
	                }
	                header('Location:connexion.php');
	            }
            else {
                echo "<p class='text-center mt-3'><strong>Pseudo trop grand ou de mot de passe incorrecte ou email invalide</strong></p>";
            }
        }

        public function connexion($nameUser,$password){
            $selectprep = self::$bdd->prepare("SELECT unique_id,nomUser,password,status FROM utilisateurs WHERE nomUser=?;");
            $selectprep->execute(array($nameUser));
            $resultat = $selectprep->fetch();

			$isPasswordCorrect=password_verify($password,$resultat['password']);

			if($isPasswordCorrect){
			    $_SESSION['nomUtilisateur']=$nameUser;
				$_SESSION['password']=$password;
				$_SESSION['unique_id']=$resultat['unique_id'];
				$_SESSION['status']=$resultat['status'];
		        echo "<p class=\"text-center mt-3\"><strong>Vous êtes connecté :)</strong></p>";
		        header('Location:displayProduct.php');
			}	
			else {
		        echo "<p class=\"text-center mt-3\"><strong>Mauvais identifiant ou mot de passe !</strong></p>";
		    }
        }

        function deconnexion(){
            $_SESSION = array();
            session_destroy();
            echo "<p class=\"text-center mt-3\"><strong>Vous êtes bien deconnecté :)</strong></p>";
        }

        public function uploadPP($image,$idUser){

			$target ="images_articles/".basename($_FILES['image']['name']);

			$sql = self::$bdd -> prepare("INSERT INTO images(titreImage,idUser) VALUES(?,?);");
			$sql->execute(array($image,$idUser));
			move_uploaded_file($_FILES['image']['tmp_name'], $target);
		}
    }

?>