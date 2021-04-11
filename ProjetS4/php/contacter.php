<?php session_start(); ?>
<?php
	try{
    	$bdd = new PDO('mysql:host=localhost;dbname=collection;charset=utf8', 'root', '');
    }catch (Exception $e){
    	die('Erreur : ' . $e->getMessage());
	}

	$idUser1=$_SESSION['unique_id'];
	$idUser2=$_POST['idUser2'];

	$sql= $bdd->prepare("SELECT unique_id_discu FROM discussions WHERE idUser1=".(int)$idUser1." AND idUser2=".(int)$idUser2." OR idUser1=".(int)$idUser2." AND idUser2=".(int)$idUser1."");
	$sql->execute();
	$res=$sql->fetch()['unique_id_discu'];

	if(!empty($res)){
		echo $res;
	} else {	
		$id_discu=rand(time(),10000000);		
		$sql= $bdd->prepare("INSERT INTO discussions(unique_id_discu,idUser1,idUser2) VALUES(?,?,?);");
		$sql->execute(array($id_discu,$idUser1,$idUser2));
		echo $id_discu;
	}
	
?>