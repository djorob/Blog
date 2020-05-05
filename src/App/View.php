<?php

namespace Blog\App;


/**
 * Class View
 * organize the view
 */


class View
{
    private $layout;
    private $template;
    private $App = 0;

    /**
     * set the template.
     * @param null $template
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    public function setParam($param)
    {
        $this->param = $param;
    }

    /**
     * render the template
     * @param array $params
     */
    public function render($params = array())
    {
        extract($params);
        $template = $this->template;
        include('./view/template/app.php');
        //include('src/view/template/app.php');

        //echo $twig->render('template.html.twig',$params);
        
        echo $twig->render($template. '.html.twig',$params);
    }

    /**
     * redirect to the route
     * @param $route
     */
    public function redirect($route)
    {
        //include('./view/template/app.php');
        //echo $twig->redirect($route);
        
        header("Location: ".HOST.$route);
        exit;
    }

}