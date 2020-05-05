<?php
require_once './vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./view/template');// \Twig\Loader\FilesystemLoader('./view/template');
$twig = new Twig_Environment($loader); //\Twig\Environment($loader);

?>

