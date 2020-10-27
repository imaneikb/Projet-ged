<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style1.css" />
</head>
<body>
<?php

require('config.php');
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// On se place sur le bon formulaire grâce au "name" de la balise "input"
if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])){
    // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($conn, $username);
    // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);
    // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    //requéte SQL + mot de passe crypté
    $query = "INSERT into `user` (username, email, password)
              VALUES ('$username', '$email', '".hash('sha256', $password)."')";
    // Exécuter la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if($res){
        echo "<div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
       </div>";
    }
}else{
    ?>
    <div class="register-box">
        <form action="" method="post">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toogle-btn"><h2>Inscription</h2></button>


            </div>
            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
            <input type="text" name="username" placeholder="Nom d'utilisateur" required />
            </div>
            <div class="textbox">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            <input type="text" name="email" placeholder="Email" required />
            </div>
            <div class="textbox">
                <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" name="password" placeholder="Mot de passe" required />
            </div>
            <div class=""social-icons>
                <img src="fb.png">
                <img src="go.png">

            </div>
            <input type="submit" name="submit" value="S'inscrire" class="btn"  />
            <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>
        </form>
    </div>

<?php } ?>
</body>
</html>