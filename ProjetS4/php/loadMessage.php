<?php
	session_start();
	include_once 'discussion.php';

	$chat=new Discussion();
	$chat->afficherMessages($_POST['id_discu'],$_SESSION['unique_id']);
?>