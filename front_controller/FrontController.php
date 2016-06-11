<?php
/**
 * Front Controller
 *
 * @desc
 *     This mostly is used for web applications as an entry point.
 *     It is usually the main target object by something like an MVC
 *     which points to index.php to load this and handle the requests.
 *
 *     There is no one-way to do this, but this gives you an idea.
 *
 * @usage
 *     MVC Entry Point
 *     Application Entry Point
 *
 *
 * @example
 *     We will create a fake MVC request handler.
 *
 */
class FrontController
{
    public $router;
    public $params;
    public $response;

    public function __construct() {
        // This wold load all the depdencies or plugins.
        new DepdenencyManager();
    }

    public static function setResponse($response) {
        $this->response = new Response;
    }

    // You could pass in $_REQUEST data
    public function dispatch($request) {

        if ( ! isset($this->response)) {
            throw new \InvalidArgumentException('setResponse must be caled');
        }
        // Params could be used to turn the request into something readble
        $this->params = new Params($request);

        // The router would direct the path, to a controller or a page
        $this->router = new Router($this->params);

        // This would output views, templates, or something.
        $this->response->send();
    }
}

// --------------------------------------------------------
// Fake Class(es) for Example
// --------------------------------------------------------
class DependencyManager {
    public function __construct() {
        // This could do stuff that autoloaders dont include
    }
}

class Params{
    public function __consstruct($request) {
        // Build something like the /path/name and ?query=string variables
        // for this class
    }
}

class Router{
    public function __construct(Params $params) {
        // Read the Params object, and find what is needed
    }
}

class Response{
    public function send() {
        // output a template
    }
}

// --------------------------------------------------------
// Example
// --------------------------------------------------------
$frontctrl  = new FrontController();
$frontctrl->setResponse(new Reponse);
$frontctrl->dispatch($_REQUEST);

print '<pre>' . print_r($frontctrl) . '</pre>';
