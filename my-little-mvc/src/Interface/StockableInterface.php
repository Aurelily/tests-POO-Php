<?php

namespace App\Interface;

interface StockableInterface
{

    public function addStock(int $quantity): static;

    public function removeStock(int $quantity): static;

}