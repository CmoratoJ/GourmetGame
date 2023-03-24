<?php
namespace App\repositories\interfaces;

interface IDishRepository
{
    public function create(array $data): void;
    public function findInitialType(): array;
    public function findAllDishes(): array;
    public function removeDishes(int $key);
}