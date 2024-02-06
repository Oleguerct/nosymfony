<?php
require_once '../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
$response = new Response();

$map = [
    '/hello' =>  'hello',
    '/bye' => 'bye'
];

$path = $request->getPathInfo();
if(isset($map[$path])){
    ob_start();
    extract($request->query->all(), EXTR_SKIP);
    include sprintf(__DIR__.'/../src/pages/%s.php',$map[$path]);
    $response->setContent(ob_get_clean());
}else{
    $response->setStatusCode(404);
    $response->setContent('<h1>Not found</h1>');
}

$response->send();
