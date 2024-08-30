<?php


function site_url($route): string
{
    return $_ENV['HOST'] . $route;
}

function redirect($route): void
{
    header("Location: " . site_url($route));
    die();
}

function view($path, $data = []): void
{
    extract($data);

    $path = str_replace('.', '/', $path);
    include BASE_PATH . '/views/' . $path . '.php';
}

function strContains($str, $needle, $caseSensitive = false): bool
{
    if ($caseSensitive) {
        $pos = strpos($str, $needle);
    } else {
        $pos = stripos($str, $needle);
    }
    return $pos !== false;
}

function xss_clean($str)
{
    return filter_var(htmlspecialchars($str), FILTER_SANITIZE_SPECIAL_CHARS);
}

function nice_dump($var): void
{
    echo "<pre style='display: block; text-align: left; direction: ltr; background-color: #fff; border: 1px solid #b75520; border-left-width: 7px; border-radius: 5px; margin: 10px; padding: 10px 10px 0 10px !important; font-size: 17px !important;'>";
    var_dump($var);
    echo "</pre>";
}

function nice_dd($var): void
{
    nice_dump($var);
    die();
}
