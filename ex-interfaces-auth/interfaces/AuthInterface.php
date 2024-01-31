<?php

interface AuthInterface {

    public function login(string $username, string $password): bool;

    public function logout(): void;

    public function register(array $userData): bool;
}
