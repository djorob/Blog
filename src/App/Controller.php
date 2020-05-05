<?php

namespace Blog\App;

class Controller
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function render($template,$param = array() )
    {
        $myView = $this->view;
        $myView->setTemplate($template); // $template est un view que je veux affichers
        $myView->render($param);
    }
}

