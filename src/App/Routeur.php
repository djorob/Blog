<?php
namespace Blog\App;

require './vendor/autoload.php';

use Blog\Controller\Home;
use Blog\Controller\Account;
use Blog\Controller\Article;


//use Blog\controller\updateBlogPost;


/**
 * Class Routeur
 *
 * create routes and find controller
 */
    class Routeur
    {
        private $url;
        private $routes = [
        //premiére partie c'est la route  la deuxieme partie c'est le controlleur et la troisiéme partie c'est la méthode qui se situe dans se co,trolleur 
            "home" => ["controller" => 'Home', "method" => 'showHome'],
            "blog" => ["controller" => 'Article', "method" => 'listBlogPost'],
            "login" => ["controller" => 'Account', "method" => 'login'],

            "insert" => ["controller" => 'Article', "method" => 'addblog'],
            "insertPost" => ["controller" => 'Article', "method" => 'addblogPost'],
            "deleteUser" => ["controller" => 'Account', "method" => 'deleteUserDb'], // à la fin on met la méthode qui est dans le controlleur
            "deleteComment" => ["controller" => 'Home', "method" => 'deleteComment'],
            "loginUser" => ["controller" => 'Account', "method" => 'loginUser'],
            "blogid" => ["controller" => 'Article', "method" => 'getBlog'],
            "ajouterCommentaire" => ["controller" => 'Article', "method" => 'ajouterCommentaire'],
            "register" => ["controller" => 'Account', "method" => 'registerUser'],
            "registerUserPost" => ["controller" => 'Account', "method" => 'registerUserPost'],
            "registerAdmin" => ["controller" => 'Account', "method" => 'registerAdmin'],
            "registerAdminPost" => ["controller" => 'Account', "method" => 'registerAdminPost'],
            "logout" => ["controller" => 'Account', "method" => 'logout'],
            "ValiderCommentaires" => ["controller" => 'Article', "method" => 'validationCommentaires'],
            "valide" => ["controller" => 'Article', "method" => 'commentaireValide'],
            "update" => ["controller" => 'Article', "method" => 'updateBlogPosts'],
            "Invalide" => ["controller" => 'Article', "method" => 'InvalidComment'],
            "updatePost" => ["controller" => 'Article', "method" => 'updateToDb'],
            "listUser" => ["controller" => 'Account', "method" => 'getAllUser']
        ];


    public function __construct($url)
    {
        $this->url = $url;

        $route  = $this->getRoute();
        $params = $this->getParams();

        $request = new Request();
        $request->setRoute($route);
        $request->setParams($params);

        $this->request = $request;
    }

    public function getRoute()
    {
        $elements = explode('/', $this->url);
        return $elements[0];
    }

    public function getParams()
    {
        $params = array();

        // extract GET params
        $elements = explode('/', $this->url);
        
        // unset($elements[0]);
        for($i = 1; $i<count($elements); $i++)
        {
            $params[$elements[$i]] = $elements[$i+1];
            $i++;
        }

        // extract POST params
        if($_POST)
        {
            foreach($_POST as $key => $val)
            {
                $params[$key] = $val;
            }
        }

        return $params;
    }

    public function renderController()
    {
        $request = $this->request;

        if(key_exists($request->getRoute(), $this->routes))
        {
            $controller = $this->routes[$request->getRoute()]['controller'];
            $method     = $this->routes[$request->getRoute()]['method'];

            //$currentController = new $controller(); //A revoir depuis l'ajout des namespaces !
            //$namespaceController = "\Blog\controller\\ . $controller";

            $namespaceController  =  "Blog\Controller\\" . $controller;
            $currentController = new $namespaceController();
            $currentController->$method($request);
        } else {
            $currentController = new ErrorPage();
            $currentController->show404();
        }
    }
}