<?php

require_once 'vendor/autoload.php';
session_start();


use App\Controller\AuthenticationController;


if($_SESSION['user']){
    $userConnected = $_SESSION['user'];
}else{
    $_SESSION['message'] = "Vous n'etes pas connecté";
    header('Location: login.php');
}

// UPDATE :  Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    

    // Créer une instance du contrôleur d'authentification
    $authController = new AuthenticationController();

    // Appeler la méthode register avec les données du formulaire
    $authController->update($fullname, $email, $password);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
    
    <?php if($_SESSION['user']):?>
        <h1>Bienvenue dans votre profil <?= $userConnected->getFullname() ?></h1>
        <p>Fullname : <?= $userConnected->getFullname() ?></p>
        <p>Email : <?= $userConnected->getEmail() ?></p>

    <?php endif ?>

    <h1>Mettre à jour mon profil</h1>
    <form action="" method="post">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Update">
    </form>

    
</body>
</html>