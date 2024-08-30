<?php

use App\Core\Routing\Router;

include "bootstrap/init.php";



$router = new Router();
try {
    $router->runRouter();
} catch (Exception $e) {
    echo $e->getMessage();
}






