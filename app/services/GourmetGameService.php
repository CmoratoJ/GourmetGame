<?php
namespace App\services;

use App\repositories\interfaces\IDishRepository;

class GourmetGameService
{
    private IDishRepository $iDishRepository;

    public function __construct(IDishRepository $iDishRepository)
    {
        $this->iDishRepository = $iDishRepository;
    }

    public function execute(): void
    {
        $this->iDishRepository->create([
            "name" => "Bolo de chocolate",
            "type" => "Doce"
        ]);

        $dishes = $this->iDishRepository->findAllDishes();
        $this->gameRecursive($dishes);
    }

    private function gameRecursive(array $dishes)
    {
        $initialDish = $this->iDishRepository->findInitialType();

        foreach ($dishes as $key => $dish) {
            readline("Pense em um prato que gosta ");
            $res = readline("O prato que você pensou é {$initialDish['type']} ? (S/N) ");

            if ($res === 's') {
                $resPasta = readline("O prato que você pensou é {$initialDish['name']} ? (S/N) ");
                if ($resPasta === 's') {
                    $this->hit($dishes);
                }
                $this->insertNewDish($dish, $key);
            }

            if ($dish['name'] === "Bolo de chocolate") {
                $resCake = readline("O prato que você pensou é {$dish['name']} ? (S/N) ");
                if ($resCake === 'n') {
                    $this->insertNewDish($dish, $key);
                }
            }

            $res = readline("O prato que você pensou é {$dish['type']} ?  (S/N) ");

            if ($res === 's') {
                $res = readline("O prato que você pensou é {$dish['name']} ?  (S/N) ");
                if ($res === 'n') {
                    $this->insertNewDish($dish, $key);
                }
                $this->hit($dishes);
            }

            $resCake = readline("O prato que você pensou é Bolo de Chocolate ?  (S/N)");
            if ($resCake === 'n') {
                $this->insertNewDish($dish, $key);
            }
        }

        $this->hit($dishes);
    }

    private function insertNewDish(array $dish, int $key)
    {
        $newDishName = readline("Qual prato você pensou ? ");
        $newDishType = readline("{$newDishName} é ____ mas {$dish['name']} não. ");

        $this->iDishRepository->removeDishes($key);
        $this->iDishRepository->create([
            "name" => $newDishName,
            "type" => $newDishType
        ]);

        $dishes = $this->iDishRepository->findAllDishes();
        $this->gameRecursive($dishes);
    }

    private function hit(array $dishes)
    {
        readline("Acertei de novo !");
        $this->gameRecursive($dishes);
    }
}