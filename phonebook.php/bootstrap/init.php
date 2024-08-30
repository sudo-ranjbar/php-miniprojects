<?php

use App\Core\Request;

const BASE_PATH = __DIR__ . "/../";


include BASE_PATH . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

include BASE_PATH . "/helpers/helpers.php";

$request = new Request;


include BASE_PATH . "/routes/web.php";

