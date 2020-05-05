<?php
namespace Blog;
require  './vendor/autoload.php';

use Blog\App\Routeur;
use Blog\App\MyConfiguration;


ini_set('display_errors','on');
ini_set('memory_limit','-1');
ini_set('max_execution_time','1800');
error_reporting(E_ALL);

//include_once('./config/config.php');
MyConfiguration::start();
//MyConfiguration::autoload('Routeur');



isset($_GET['r']) ? $url = $_GET['r'] : $url = 'home';

$namespaceRouteur  =  "App\\Routeur";

$routeur = new  Routeur($url);
//$routeur= new $namespaceRouteur($url);
$routeur->renderController();
