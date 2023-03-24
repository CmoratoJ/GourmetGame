<?php

use App\controllers\GourmetGameController;

require __DIR__.'/vendor/autoload.php';

$game = new GourmetGameController();
$game->run();