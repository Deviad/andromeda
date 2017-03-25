<?php

namespace App\Router;
//include dirname(__DIR__) . '/Controller/Controller.php';

use App\Controller\Controller;


class Router
{

    public function getRequest() {


        if (false !== strpos($_SERVER['REQUEST_URI'], 'loaddata')) {

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $controller = new Controller();
                $controller->loadData();
            }

            else {
                throw new \Exception('Wrong request method');
            }

        }  else if (false !== strpos($_SERVER['REQUEST_URI'], 'register')) {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $request = $_POST;
                $controller = new Controller();
                $controller->register($request);

            }

            else {
                throw new \Exception('Wrong request method');
            }

        } else if (true !== strpos($_SERVER['REQUEST_URI'], '/index.php')) {

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $controller = new Controller();
            $controller->index();

            }

            else {
                throw new \Exception('Wrong request method');
            }

        }


    }


}