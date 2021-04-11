<?php

	require_once "connexionBD.php";
    Connexion::initConnexion();

    class Discussion extends Connexion {

    	public function __construct() {
 	
		}

		public function getProfil($unique_id){
			$sql=self::$bdd->prepare("SELECT photo_profil,nomUser,status FROM utilisateurs WHERE unique_id = ?;");
			$sql-> execute(array($unique_id));
			return $sql->fetch();
		}

		public function getListeDiscussion($unique_id){
			$prepare = self::$bdd->prepare("SELECT * FROM `discussions` WHERE idUser1= ? OR idUser2=?");
			$prepare-> execute(array($unique_id,$unique_id));

			$res=$prepare->fetchAll();
			foreach ($res as $value){
				if($value['idUser1']==$unique_id){
					$sql = self::$bdd->prepare("SELECT nomUser,photo_profil FROM utilisateurs WHERE unique_id = ?");
					$sql->execute(array($value['idUser2']));
					$user=$sql->fetch();  
					echo "<a href='chat.php?id_discu=".$value['unique_id_discu']."'>"
					?>
						<div class="content">
							<?php echo "<img src='../images_articles/".$user['photo_profil']."' alt=''>"; ?>
							<div class="details">
								<span><?php echo $user['nomUser']; ?></span>
							</div>
						</div>
					</a>
				<?php
				} else {
					$sql = self::$bdd->prepare("SELECT nomUser,photo_profil FROM utilisateurs WHERE unique_id = ?");
					$sql->execute(array($value['idUser1']));
					$user=$sql->fetch(); 
					echo "<a href='chat.php?id_discu=".$value['unique_id_discu']."'>" ?>
						<div class="content">
							<?php echo "<img src='../images_articles/".$user['photo_profil']."' alt=''>"; ?>
							<div class="details">
								<span><?php echo $user['nomUser']; ?></span>
							</div>
						</div>
					</a>
				<?php
				}

			}
		}

		public function afficherMessages($id_discu,$id_user){
			$sql= self::$bdd->prepare("SELECT message, message_from FROM messages WHERE id_discu= ? ORDER BY date;");
			$sql->execute(array($id_discu));
			$res=$sql->fetchAll();
			foreach ($res as $value){
				if($value['message_from']==$id_user){ ?>
					<div class="chat outgoing">
					<div class="details">				
						<p><?php echo $value['message']; ?></p>
					</div>
				</div><?php
				} else { ?>
					<div class="chat incoming">
					<div class="details">				
						<p><?php echo $value['message']; ?></</p>
					</div>
				</div>
				<?php
				} 
			}

		}

		public function getUser($id_discu, $id_user){
			$sql= self::$bdd->prepare("SELECT* FROM discussions WHERE unique_id_discu = ?;");
			$sql->execute(array($id_discu));
			$res=$sql->fetch();
			if($res['idUser1']==$id_user){
				$user=$this->getProfil($res['idUser2']);
			} else {
				$user=$this->getProfil($res['idUser1']);
			}

			return $user;
		}
    }

?>
