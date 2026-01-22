<?php
class HomeController extends Controller {
    
    public function index() {
        // Load Product model
        $productModel = $this->model('Product');
        
        // Get latest products
        $products = $productModel->getAllProducts(6);
        
        // Get cart count if user logged in
        $cartCount = 0;
        if(isset($_SESSION['user_id'])) {
            $cartModel = $this->model('Cart');
            $cartCount = $cartModel->getCartCount($_SESSION['user_id']);
        }
        
        // Pass data to view
        $data = [
            'title' => 'Home - ' . APP_NAME,
            'products' => $products,
            'cartCount' => $cartCount,
            'productModel' => $productModel
        ];
        
        $this->view('home/index', $data);
    }
}
?>
