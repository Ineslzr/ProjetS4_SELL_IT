<?php session_start(); 

include_once '../php/discussion.php';
$chat=new Discussion();
?>

<!DOCTYPE html>
<html>
    <head>       
        <meta charset="utf-8">
        <!--<link rel="stylesheet" href="cours.css">-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style_users.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <title>Home</title>

    </head>

<body>
	<div class="wrapper">
		<section class="chat-area">
			<header>
				<a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
				<?php
					$user = $chat->getUser($_GET['id_discu'], $_SESSION['unique_id']);
					echo "<img src='../images_articles/".$user['photo_profil']."' alt=''>";
				?>
				<div class="details">
					<span><strong><?php echo $user['nomUser']; ?></strong></span>
					<p><?php echo $user['status']; ?></p>
				</div>
			</header>
			<div class="chat-box" <?php echo "data-id=\"".$_GET['id_discu']."\"";?>>
				<?php
					$chat->afficherMessages($_GET['id_discu'],$_SESSION['unique_id']);	
				?>
				
			</div>
			<form action="" method="POST" class="typing-area">
				<input type="text" id="message" placeholder="Type a message here...">
				<button type="submit" id="send" <?php echo "name='".$_GET['id_discu']."'"; ?> ><i class="fab fa-telegram-plane"></i></button>
			</form>
		</section>
	</div>
    <script type="text/javascript" src="../js/chat.js"> </script>	
</body>
</html>
