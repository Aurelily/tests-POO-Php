<?php
session_start();

use App\Controller\AuthenticationController;

require_once 'vendor/autoload.php';

var_dump($_SESSION);

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    

    // Créer une instance du contrôleur d'authentification
    $authController = new AuthenticationController();

    // Appeler la méthode register avec les données du formulaire
    $authController->register($fullname, $email, $password);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <header>
        <?php include_once ('includeNav.php'); ?>
    </header>

    <h1>S'inscrire</h1>
    <form action="" method="post">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Register">
    </form>

    <a href="login.php">Si vous avez déjà un compte cliquez-ici pour vous connecter</a>
</body>
</html>