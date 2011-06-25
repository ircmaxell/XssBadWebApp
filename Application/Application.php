<?php

namespace XssBadWebApp\Application;

use \XssBadWebApp\Utilities\Request;
use \XssBadWebApp\Utilities\Session;
use \XssBadWebApp\Models\User as UserModel;

class Application {
    
    protected $request = null;
    protected $session = null;
    
    public function __construct() {
        $this->request = new Request($_GET, $_POST, $_SERVER);
        $this->session = new Session();
    }
    
    public function setup() {
        if (!$this->session->has('user')) {
            $this->session->set('user', new UserModel());
        }
    }
    
    public function run() {
        $controller = $this->findController();
        $view = $controller->dispatch();
        $view->render();
    }
    
    protected function findController() {
        $controller = $this->request->get('controller', 'GuestBook');
        $className = '\XssBadWebApp\Controllers\\' . $controller;
        if (class_exists($className)) {
            return new $className($this->request, $this->session);
        }
        return new \XssBadWebApp\Controllers\GuestBook($this->request, $this->session);
    }
    
}