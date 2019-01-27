<?php
error_reporting(!E_DEPRECATED);

use App\routes\Router;

if (!isset($_SESSION)) session_start();
require_once "../vendor/autoload.php";

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_NAME", "hacky");
define("DB_PASS", "");

define("APP_ROOT", realpath(__DIR__ . "/../"));
define("BASE_URL", "http://localhost/Job/PHP-Inter-Class-Project/public/");

$router = new Router();