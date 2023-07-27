<?php

class Controller 
{
    public $model;
    public $view;
    public $utils;
    protected $pageData = array();

    public function __constructor() 
    {
        $this->view = new View();
        $this->model = new Model();
        $this->utils = new Utils();
    }
}