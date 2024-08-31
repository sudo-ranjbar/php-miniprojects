<?php

include "bootstrap/init.php";
use App\Core\Routing\Router;







$router = new Router();
try {
    $router->runRouter();
} catch (Exception $e) {
    echo $e->getMessage();
}






