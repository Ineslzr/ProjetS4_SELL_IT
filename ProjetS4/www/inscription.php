<!DOCTYPE html>
<html>
    <head>
        <title>Inscription</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    </head>
    <body>
        <?php require("nav_accueil.html"); ?>

        <div class="container">
                <div class="row">
                    <form action="./inscription.php" method="post" enctype="multipart/form-data" class="col-lg-8 me-auto mx-auto" style="margin-top: 50px; background-color: #252a37; padding: 50px; text-align: center; color: white; border-radius: 30px;" >
                        <h2>Inscrivez-vous !</h2>
                        <br>
                        <div class="col-lg-8 me-auto mx-auto">
                            <div class="form-group">
                                <label>Nom d'utilisateur</label>
                                <input type="text" name="nomUtilisateur" class="form-control" placeholder="Pseudo">
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Adresse Mail</label>
                                <input type="email" name="email" class="form-control" placeholder="E-mail">
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Mot de passe</label>
                                <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Photo de profil</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <button type="submit" name="submit" class="btn btn-black" style="background-color: #f4d529;color: #252a37; border: solid;">Sign in</button>
                            <br>
                        </div>
                    </form>
                </div>
            </div>

            <?php 
                include_once '../php/inscription_connexion_deconnexion.php';
                $action=new Inscription_connexion_deconnexion();

                if(isset($_POST['submit'])){
                    $name=$_POST['nomUtilisateur'];
                    $image=$_FILES['image']['name'];
                    $idUser=(int)1;
                    $action->uploadPP($image,$idUser);
                    $pass_hash=password_hash($_POST['password'],PASSWORD_DEFAULT);
                    $email=$_POST['email'];

                    $action->inscription($name,$image,$pass_hash,$email);

                }
            ?>
    </body>
</html>