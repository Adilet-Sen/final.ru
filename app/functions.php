<?php

use Delight\Auth\Auth;
use JasonGrimes\Paginator;

function redirect($path)
{
    header("Location: $path");
    exit;
}
function back()
{
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
function abort($type)
{
    global $container;
    switch ($type) {
        case 404:
            $view = $container->get(\League\Plates\Engine::class);
            echo $view->render('404');
            exit;
            break;
        case 405:
            $view = $container->get(\League\Plates\Engine::class);
            echo  $view->render('404');
            break;
    }
}

function slugify($text, string $divider = '-')
{
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}
function paginate($count, $page, $perPage, $url)
{
    $totalItems = $count;
    $itemsPerPage = $perPage;
    $currentPage = $page;
    $urlPattern = $url;

    $paginator =  new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    return $paginator;

}

function auth()
{
    global $container;
    return $container->get(Auth::class);
}


function paginator($paginator)
{
    include 'views/partials/pagination.php';
}