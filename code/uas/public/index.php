<?php
session_start();

require_once '../app/config/Database.php';

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'dashboard/index';
$url = explode('/', $url);

if(!isset($_SESSION['user_id']) && $url[0] != 'auth') {
    $controllerName = 'Auth';
    $methodName = 'index';
} else {
    $controllerName = ucfirst($url[0]); 
    $methodName = isset($url[1]) ? $url[1] : 'index';
}

if($controllerName == 'Item') { $controllerName = 'Itemcontroller'; }

$file = '../app/controllers/' . $controllerName . '.php';

if(file_exists($file)) {
    require_once $file;
    $controller = new $controllerName;
  
    if(method_exists($controller, $methodName)) {
        unset($url[0]); unset($url[1]);
        call_user_func_array([$controller, $methodName], $url);
    } else {
        echo "404 - Method Not Found";
    }
} else {
    echo "404 - Controller Not Found";
}
?>
