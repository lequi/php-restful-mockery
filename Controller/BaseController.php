<?php

namespace Controller;

use \Slim\Slim as Slim;
use \Faker\Factory as Factory;

abstract class BaseController
{
    protected $app;
    protected $faker;

    public function __construct(Slim $app)
    {
        $this->faker = Factory::create();
        $this->app = $app;
    }

    protected function renderJson($jsondata)
    {
        $this->app->response->headers->set('Content-Type', 'application/json');
        echo json_encode($jsondata);
    }

    protected function notfound()
    {
        $this->app->notFound(function (){
            echo 'Not found';
        });
    }

    protected function notfound422()
    {
        $this->app->response->setStatus(422);
        $this->renderJson(array('error' => array('error_not_found')));
    }

    protected function notpermission422()
    {
        $this->app->response->setStatus(422);
        $this->renderJson(array('error' => array('error_not_permission')));
    }

    abstract public function run();
}
