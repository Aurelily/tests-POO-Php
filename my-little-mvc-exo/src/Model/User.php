<?php
namespace App\Model;

class User
{

    private ?int $id;
    private ?string $fullname;
    private ?string $email;
    private ?string $password;
    private ?array $role;

    public function __construct(
        ?int $id = null,
        ?string $fullname = null,
        ?string $email = null,
        ?string $password = null,
        ?array $role = null,

    )
    {
        $this->id = $id;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        
    }

    // Méthode pour trouver un utilisateur par email
    public function findOneByEmail($email)
    {
    $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
    $sql = "SELECT * FROM user WHERE email = :email";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $user = $statement->fetch(\PDO::FETCH_ASSOC);
    if ($user) {
        return new static(
            $user['id'],
            $user['fullname'],
            $user['email'],
            $user['password'],
            json_decode($user['role'])
        );
    }

    return false;
    }
    
    public function findOneById(int $id): static|false
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $sql = "SELECT * FROM user WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $user = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($user) {
            return new static(
                $user['id'],
                $user['fullname'],
                $user['email'],
                $user['password'],
                json_decode($user['role'])
            );
        }

        return false;
    }

    public function findAll(): array
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $sql = "SELECT * FROM user";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $users = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $results = [];
        foreach ($users as $user) {
            $results[] = new static(
                $user['id'],
                $user['fullname'],
                $user['email'],
                $user['password'],
                json_decode($user['role'])
            );
        }

        return $results;
    }

    public function create(): static
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $sql = "INSERT INTO user (fullname, email, password, role) VALUES (:fullname, :email, :password, :role)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':fullname', $this->fullname);
        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':password', $this->password);
        $statement->bindValue(':role', $this->role[0]);
        $statement->execute();
        $this->id = $pdo->lastInsertId();
        return $this;
    }

    public function update(): static
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
        $sql = "UPDATE user SET fullname = :fullname, email = :email, password = :password";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':fullname', $this->fullname);
        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':password', $this->password);
        $statement->execute();
        return $this;
    }



    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of fullname
     */ 
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set the value of fullname
     *
     * @return  self
     */ 
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}