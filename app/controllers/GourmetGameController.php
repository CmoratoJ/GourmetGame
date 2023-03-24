<?php 
namespace App\controllers;

use App\services\factories\MakeGourmetGameService;

class GourmetGameController
{
    public function run(): void
    {
        $makeGourmetGameService = new MakeGourmetGameService();
        $gourmetGameService = $makeGourmetGameService->makeGourmetGameService();
        $gourmetGameService->execute();
    }
}