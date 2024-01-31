<?php

class WebAuth implements AuthInterface {
    public function login(string $username, string $password): bool {
        // Logique de connexion pour le Web
        // ...

        return true; 
    }

    public function logout(): void {
        // Logique de déconnexion pour le Web
        // ...
    }

    public function register(array $userData): bool {
        // Logique d'enregistrement pour le Web
        // ...

        return true;
    }
}
