<?php

namespace App\Db;

// J'importe l'objet PDO de php et PDO Execption pour gérer les erreurs
use PDO;
use PDOException;

// NOTE : Cette classe se base sur le design pattern SINGLETON, cad qu'on ne l'instanciera qu'une seule fois

class Db extends PDO
{
    // Instance unique de la classe
    private static $instance;

    // Je mets en CONSTANTE les infos de connexion à la bdd
    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = '';
    private const DBNAME = 'demo_poo';

    // Design SINGLETON : Constructeur private que l'on ne peut pas instancier
    private function __construct()
    {
        // DSN de connexion
        $_dsn = 'mysql:dbname=' . self::DBNAME . ';host=' . self::DBHOST;

        // On appele le constructeur de la classe PDO (en gérant les erreurs de connexion avec un try/catch et PDOException)
        try {
            parent::__construct($_dsn, self::DBUSER, self::DBPASS);

            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
    }

    // Design SINGLETON : Methode static pour générer une instance unique si il n'y en a pas, ou de recup l'actuelle si elle existe
    public static function getInstance():self
    {

        if(self::$instance === null){
            self::$instance = new self(); // J'instancie la classe elle même
            echo 'Connexion OK';
        }
        return self::$instance; 

    }

}