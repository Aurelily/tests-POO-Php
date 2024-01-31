<?php

namespace App\Model;

use App\Model\Abstract\AbstractProduct;
use App\Model\Electronic;
use App\Model\Clothing;

class Category extends AbstractProduct
{

    private ?int $id;

    private ?string $name;

    private ?string $description;

    private ?\DateTime $createdAt;

    private ?\DateTime $updatedAt;

    public function __construct(?int $id = null, ?string $name = null, ?string $description = null, ?\DateTime $createdAt = null, ?\DateTime $updatedAt = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Category
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Category
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Category
    {
        $this->description = $description;
        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): Category
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): Category
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getProducts(): array
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');

        $result = [];

        $statement = $pdo->prepare('SELECT * FROM product INNER JOIN clothing ON product.id = clothing.product_id WHERE product.category_id = :category_id');

        $statement->bindValue(':category_id', $this->id, \PDO::PARAM_INT);

        $statement->execute();

        $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $statement = $pdo->prepare('SELECT * FROM product INNER JOIN electronic ON product.id = electronic.product_id WHERE product.category_id = :category_id');

        $statement->bindValue(':category_id', $this->id, \PDO::PARAM_INT);

        $statement->execute();

        $results = array_merge($statement->fetchAll(\PDO::FETCH_ASSOC), $results);

        $products = [];

        foreach ($results as $result) {
            if (isset($result['size'])) {
                $products[] = new Clothing(
                    $result['id'],
                    $result['name'],
                    json_decode($result['photos']),
                    $result['price'],
                    $result['description'],
                    $result['quantity'],
                    $result['category_id'],
                    new \DateTime($result['created_at']),
                    $result['updated_at'] ? (new \DateTime($result['updated_at'])) : null,
                    $result['size'],
                    $result['color'],
                    $result['type'],
                );
            } else {
                $products[] = new Electronic(
                    $result['id'],
                    $result['name'],
                    json_decode($result['photos']),
                    $result['price'],
                    $result['description'],
                    $result['quantity'],
                    $result['category_id'],
                    new \DateTime($result['created_at']),
                    $result['updated_at'] ? (new \DateTime($result['updated_at'])) : null,
                    $result['brand'],
                    $result['waranty_fee'],
                );
            }
        }

        return $products;
    }

}