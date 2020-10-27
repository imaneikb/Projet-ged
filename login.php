<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style1.css" />
</head>

<?php
require('config.php');
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
session_start();

if (isset($_POST['username'])){
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($conn, $username);

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    $query ="SELECT * FROM `user` WHERE username='$username' and password='".hash('sha256', $password)."'";
    $result = mysqli_query($conn,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if($rows==1){
        $_SESSION['username'] = $username;
        header("Location: userspace.php");
    }else{
        $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
    }
}
?>
<div class="register-box">

    <form action="" method="post" >
        <div class="button-box">
            <div id="btn"></div>


            <button type="button" class="toogle-btn"><h2>Connexion</h2></button>

        </div>
        <div class="textbox">

            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="text" name="username" placeholder="Nom d'utilisateur" required />
        </div>
        <div class="textbox">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" name="password" placeholder="Mot de passe" required />
        </div>
        <input type="submit" name="connextion" value="Se connecter" class="btn"  />
        <p class="box-register">Vous êtes nouveau ici? <a href="register.php">Se connecter</a></p>
        <?php if (! empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>

    </form>
</div>


</body>
</html>