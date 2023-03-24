<?php
namespace App\repositories;

use App\repositories\interfaces\IDishRepository;

class DishRepository implements IDishRepository
{
    public array $dishes = [];

    public function create(array $data): void
    {
        array_push($this->dishes, $data);
    }

    public function findInitialType(): array
    {
        return ["name" => "Lasanha", "type" => "Massa"];
    }

    public function findAllDishes(): array
    {
        return $this->dishes;
    }

    public function removeDishes(int $key) {
        unset($this->dishes[$key]);
    }
}