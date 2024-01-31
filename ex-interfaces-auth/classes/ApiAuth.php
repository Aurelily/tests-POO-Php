<?php

// Classe ApiAuth implémentant AuthInterface
class ApiAuth implements AuthInterface {
    public function login(string $username, string $password): bool {
        // Logique de connexion pour l'API
        // ...

        return true; // ou false selon le succès de la connexion
    }

    public function logout(): void {
        // Logique de déconnexion pour l'API
        // ...
    }

    public function register(array $userData): bool {
        // Logique d'enregistrement pour l'API
        // ...

        return true; // ou false selon le succès de l'enregistrement
    }
}