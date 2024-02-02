<?php

use App\Controller\AuthenticationController;

require_once 'vendor/autoload.php';

session_start();

/* var_dump($_SESSION); */


// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    

    // Créer une instance du contrôleur d'authentification
    $authController = new AuthenticationController();

    // Appeler la méthode register avec les données du formulaire
    $authController->login($email, $password);
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <header>
        <?php include ('includeNav.php'); ?>
    </header>
    <?php if(isset($_SESSION['message'])): ?>
        <p><?= $_SESSION['message'] ?></p>
    <?php endif ?>

    <h1>Se connecter</h1>
    <form action="" method="post">
    
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>