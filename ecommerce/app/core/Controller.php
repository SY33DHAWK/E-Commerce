<?php
class Controller {
    
    // Load model
    public function model($model) {
        require_once ROOT . 'models/' . $model . '.php';
        return new $model();
    }
    
    // Load view
    public function view($view, $data = []) {
        extract($data);
        
        // Start output buffering
        ob_start();
        
        require_once ROOT . 'views/' . $view . '.php';
        
        $content = ob_get_clean();
        
        // Load layout with content
        require_once ROOT . 'views/layout/header.php';
        echo $content;
        require_once ROOT . 'views/layout/footer.php';
    }
    
    // Redirect helper
    public function redirect($url) {
        header('Location: ' . BASE_URL . $url);
        exit;
    }
    
    // JSON response
    public function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
?>
