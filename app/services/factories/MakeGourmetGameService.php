<?php
namespace App\services\factories;

use App\repositories\DishRepository;
use App\services\GourmetGameService;

class MakeGourmetGameService
{
    public function makeGourmetGameService()
    {
        $dishesRepository = new DishRepository();
        $gourmetGameService = new GourmetGameService($dishesRepository);

        return $gourmetGameService;
    }
}
