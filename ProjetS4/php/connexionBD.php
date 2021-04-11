<?php
	class Connexion {

		protected static $bdd;

		public static function initConnexion(){
			try {
				$dns = "mysql:host=localhost;dbname=collection;charset=utf8";
				$user = "root";
				$password="";
				self::$bdd = new PDO($dns,$user,$password);
			}
			catch (PDOException $pdoe){
				echo $pdoe->getMessage().$pdoe->getCode();
			}
		}
	}
?>