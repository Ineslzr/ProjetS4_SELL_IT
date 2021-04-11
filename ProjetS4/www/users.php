<?php session_start(); 

include_once '../php/discussion.php';
$chat=new Discussion();
?>

<!DOCTYPE html>
<html>
    <head>       
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style_users.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <title>Home</title>   	
    </head>

<body>
	<div class="wrapper">
		<section class="users">
			<header>
				<div class="content">
					<?php 
						$img=$chat->getProfil($_SESSION['unique_id']);
						echo "<img src='../images_articles/".$img['photo_profil']."' alt=''>";
					?>
					<div class="details">
						<span><?php echo $_SESSION['nomUtilisateur']; ?></span>
						<p><?php echo $_SESSION['status']; ?></p>
					</div>
				</div>
				<a href="/ProjetS4/www/displayProduct.php" class="logout">HOME</a>
			</header>
			<div class="search">
				<span class="text">Select an user to start chat</span>
				<input type="text" placeholder="Enter name to search">
				<button><i class="fas fa-search"></i></button>
			</div>
			<div class="users-list">
				<?php 
					$chat->getListeDiscussion($_SESSION['unique_id']);	
				?>

			</div>
		</section>
	</div>
     <script type="text/javascript" src="../js/users.js" > 
        
	</script>	
</body>
</html>