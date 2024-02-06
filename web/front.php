<?php
require_once '../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

const PAGE_PATH = __DIR__.'/../src/pages';

$request = Request::createFromGlobals();
$response = new Response();

$map = [
    '/hello' =>  PAGE_PATH.'/hello.php',
    '/bye' => PAGE_PATH.'/bye.php'
];

$path = $request->getPathInfo();
if(isset($map[$path])){
    require $map[$path];
}else{
    $response->setStatusCode(404);
    $response->setContent('<h1>Not found</h1>');
}

$response->send();
