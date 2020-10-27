<?php
// Initialiser la session
session_start();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit();
}

require('config.php');
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$sql = "SELECT filename FROM`files`";
$result = mysqli_query($conn, $sql) ;
if($_FILES["upload_file"]["name"] != '')
{
    $data = explode(".", $_FILES["upload_file"]["name"]);
    $extension = $data[1];
    $allowed_extension = array("jpg", "png", "gif","pdf","doc","mp4","mp3","ppt");
    if(in_array($extension, $allowed_extension))
    {
        $new_file_name = rand() . '.' . $extension;
        $path = $_POST["hidden_folder_name"] . '/' . $new_file_name;
        if(move_uploaded_file($_FILES["upload_file"]["tmp_name"], $path))
        {
            echo 'Téléchargement de fichier';
        }
        else
        {
            echo 'il y a une erreur';
        }
    }
    else
    {
        echo 'fichier non valide';
    }
}
else
{
    echo 'veuillez sélectionner un fichier';
}
?>