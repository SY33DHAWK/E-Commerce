<?php
class App {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];
    
    public function __construct() {
        // Ensure ROOT is defined
        if(!defined('ROOT')) {
            define('ROOT', dirname(__DIR__) . '/');
        }
        
        $url = $this->parseUrl();
        
        // Check if controller exists
        if(isset($url[0]) && !empty($url[0])) {
            // Validate controller name (alphanumeric only)
            if(preg_match('/^[a-zA-Z0-9]+$/', $url[0])) {
                $controllerName = ucfirst($url[0]) . 'Controller';
                $controllerPath = ROOT . 'controllers/' . $controllerName . '.php';
                
                // Use realpath to prevent path traversal attacks
                $realPath = realpath($controllerPath);
                $baseDir = realpath(ROOT . 'controllers/');
                
                if($realPath && $baseDir && strpos($realPath, $baseDir) === 0 && file_exists($realPath)) {
                    $this->controller = $controllerName;
                    unset($url[0]);
                }
            }
        }
        
        // Require the controller
        $controllerFile = ROOT . 'controllers/' . $this->controller . '.php';
        if(!file_exists($controllerFile)) {
            throw new Exception("Controller file not found: " . $this->controller);
        }
        
        require_once $controllerFile;
        
        if(!class_exists($this->controller)) {
            throw new Exception("Controller class not found: " . $this->controller);
        }
        
        $this->controller = new $this->controller;
        
        // Check if method exists
        if(isset($url[1]) && !empty($url[1])) {
            // Validate method name (alphanumeric and underscore only)
            if(preg_match('/^[a-zA-Z0-9_]+$/', $url[1])) {
                if(method_exists($this->controller, $url[1]) && is_callable([$this->controller, $url[1]])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }
            }
        }
        
        // Get params
        $this->params = $url ? array_values($url) : [];
        
        // Call controller method with params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    
    public function parseUrl() {
        if(isset($_GET['url']) && !empty($_GET['url'])) {
            // Use htmlspecialchars instead of deprecated FILTER_SANITIZE_URL
            $url = htmlspecialchars($_GET['url'], ENT_QUOTES, 'UTF-8');
            return explode('/', trim($url, '/'));
        }
        return [];
    }
}
?>
