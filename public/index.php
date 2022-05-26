<?php

use Symfony\Component\Dotenv\Dotenv;
use Bizcloud\MVCTest\Router;
use Bizcloud\MVCTest\ErrorHandler;


define('ROOT_DIRECTORY', join(DIRECTORY_SEPARATOR, [__DIR__, '..', 'src']));
define('NAMESPACE', 'Bizcloud\MVCTest');
require join(DIRECTORY_SEPARATOR, [ROOT_DIRECTORY, '..', 'vendor', 'autoload.php']);

error_reporting(E_ALL);
ini_set('display_errors', 1);


(new Dotenv())->bootEnv(dirname(__DIR__).'/.env');

spl_autoload_register(function ($className) {
    $explode = array_reverse(explode('\\',$className));
    $className = $explode[0];
    $namespace = count($explode)>3 ? '/'.$explode [1].'/' : '/';
    //$namespace = str_replace('\\', '/', __NAMESPACE__) ?: '/';


    $class = ROOT_DIRECTORY .$namespace. $className . '.php';
    var_dump($class);
    if (file_exists($class)) {
        include_once($class);
    }
});

$router = new Router();
$errorHandler = new ErrorHandler();

try {
    $router->run();
} catch (\Exception $exception) {
    $errorHandler->handle($exception);
}
