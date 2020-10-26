<?php

namespace App\Core;

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;

class Router {

    public function start() {
        $router = new RouteCollector();
        $router->get('/', ['App\Controllers\MainController','index']);
        $router->get('/getTasks', ['App\Controllers\MainController','getTasks']);
        $router->get('/logout', ['App\Controllers\MainController','logout']);
        $router->post('/login', ['App\Controllers\MainController','login']);
        $router->post('/addTask', ['App\Controllers\MainController','addTask']);
        $router->post('/editTask/{id}', ['App\Controllers\MainController','editTask']);
        

        $dispatcher = new Dispatcher($router->getData());
        try {
            $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $this->processInput($_SERVER['REQUEST_URI']));
        } catch (HttpRouteNotFoundException $e) {
            http_response_code(404);
        } catch (HttpMethodNotAllowedException $e) {
            http_response_code(404);
        }
        return $response;
    }

    protected function processInput($uri) {
        return urldecode(parse_url($uri, PHP_URL_PATH));
    }

}


?>