<?php

namespace App\Controller;

use App\Model\User;

class AuthenticationController
{
    // Méthode pour enregistrer un nouvel utilisateur
        public function register( $fullname,$email,$password)
        {
            // Vérifier si un utilisateur avec le même email existe déjà
            $user = new User;
            $existingUser = $user->findOneByEmail($email);

            if ($existingUser) {
                // L'utilisateur existe déjà, vous pouvez gérer cette situation en conséquence
                echo "Un utilisateur avec cet email existe déjà.";
            } else {
                // L'utilisateur n'existe pas, créer un nouvel utilisateur
                $newUser = new User();
                $newUser->setFullname($fullname);
                $newUser->setEmail($email);
                $newUser->setPassword(password_hash($password, PASSWORD_DEFAULT)); 
                $newUser->setRole(['ROLE_USER']); // Définir le rôle par défaut 

                // Enregistrer le nouvel utilisateur en base de données
                $newUser->create();

                echo "L'utilisateur a été enregistré avec succès.";
            }
        }

    // Methode pour se connecter avec un user existant en bdd
        public function login($email, $password)
        {
            // Rechercher l'utilisateur dans la base de données par email
            $user = new User;
            $existingUser = $user->findOneByEmail($email);
            /* var_dump($existingUser); */

            if ($existingUser && password_verify($password, $existingUser->getPassword())) {
                // Connexion réussie

                // Démarrer la session si elle n'est pas déjà démarrée
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                // Stocker l'utilisateur dans la session
                $_SESSION['user'] = $existingUser;
                

                // Redirection vers profile.php
                header('Location: profile.php');
                exit;
            } else {
                // Identifiants invalides
                echo "Mauvais identifiants";
                exit;
            }
        }

        // Méthode pour update les informations d'un utilisateur connecté
        public function update( $fullname,$email,$password)
        {
            // Vérifier si un utilisateur avec le même email existe déjà
            $user = new User;
            $existingUser = $user->findOneByEmail($email);
    
            if ($existingUser && $existingUser->getEmail() != $email) {
                // L'utilisateur existe déjà et ce n'est pas le mail actuelle de l'utilisateur connecté
                echo "Un utilisateur avec cet email existe déjà.";
            } else {
                // L'utilisateur n'existe pas, créer un nouvel utilisateur
                $newUser = new User();
                $newUser->setFullname($fullname);
                $newUser->setEmail($email);
                $newUser->setPassword(password_hash($password, PASSWORD_DEFAULT)); 
    
                // Enregistrer le nouvel utilisateur en base de données
                $newUser->update();
    
                echo "L'utilisateur a été mis à jour avec succès.";

                 // MISE A JOUR DE LA SESSION : On se reconnecte avec la methode login
                $this->login($email, $password);
  
            }
        }

}