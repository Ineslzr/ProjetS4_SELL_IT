<?php
	try{
    	$bdd = new PDO('mysql:host=localhost;dbname=collection;charset=utf8', 'root', '');
    }catch (Exception $e){
    	die('Erreur : ' . $e->getMessage());
	}

	if(isset($_POST['category'])){
		$mot_clef_parent=$_POST['category'];
		$sql=$bdd->prepare("SELECT mot_clef FROM mot_clefs WHERE mot_clef_parent = ?;");
		$sql->execute(array($mot_clef_parent));

		$res=$sql->fetchAll();
		foreach ($res as $value){ 
			$result.='<option value="'.$value['mot_clef'].'">'.$value['mot_clef'].'</option>';							
		}
		
		echo $result;
	}

	if(isset($_POST['mot_clef'])){
		$mot_clef=$_POST['mot_clef'];
		$sql=$bdd->prepare("SELECT mot_clef FROM mot_clefs WHERE mot_clef_parent = ?;");
		$sql->execute(array($mot_clef));
		$res=$sql->fetchAll();
		var_dump($res);

		foreach ($res as $value){ 
			$result.='<option value="'.$value['mot_clef'].'">'.$value['mot_clef'].'</option>';							
		}

		echo $result;
	}

?>
