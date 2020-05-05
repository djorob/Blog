<?php

namespace Blog;

use Blog\Controller;


/**
 * Class Home
 *
 * use to show the home page
 */
class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();   
    }
    
    public function showHome($request)
    {
        $this->render('home');
    }

}