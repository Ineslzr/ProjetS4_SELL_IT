<?php
	session_start();

	include_once 'discussion.php';
	$chat=new Discussion(); 

	try{
    	$bdd = new PDO('mysql:host=localhost;dbname=collection;charset=utf8', 'root', '');
    }catch (Exception $e){
    	die('Erreur : ' . $e->getMessage());
	}

	if(isset($_POST['message']) AND !empty($_POST['message'])){
		$message=$_POST['message'];
		$id_discu=$_POST['id_discu'];
		$from=$_SESSION['unique_id'];

		$sql = $bdd->prepare("INSERT INTO messages(id_discu,message,message_from) VALUES (?,?,?);");
		$sql->execute(array($id_discu,$message,$from));

		$chat->afficherMessages($id_discu,$_SESSION['unique_id']);

	}
?>