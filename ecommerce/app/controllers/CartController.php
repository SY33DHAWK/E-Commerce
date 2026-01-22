<?php
class CartController extends Controller {
    
    public function index() {
        if(!isset($_SESSION['user_id'])) {
            $this->redirect('user/login');
        }
        
        $cartModel = $this->model('Cart');
        $productModel = $this->model('Product');
        
        $cartItems = $cartModel->getCartItems($_SESSION['user_id']);
        $cartTotal = $cartModel->getCartTotal($_SESSION['user_id']);
        $cartCount = $cartModel->getCartCount($_SESSION['user_id']);
        
        $data = [
            'title' => 'Shopping Cart',
            'cartItems' => $cartItems,
            'cartTotal' => $cartTotal,
            'productModel' => $productModel,
            'cartCount' => $cartCount
        ];
        
        $this->view('cart/index', $data);
    }
    
    public function add() {
        if(!isset($_SESSION['user_id'])) {
            $this->json(['success' => false, 'message' => 'Please login first']);
        }
        
        $product_id = $_POST['product_id'] ?? null;
        $quantity = $_POST['quantity'] ?? 1;
        
        // Validate product_id
        if(!$product_id || !Validator::isValidId($product_id)) {
            $this->json(['success' => false, 'message' => 'Invalid product']);
        }
        
        // Validate quantity
        if(!Validator::isValidQuantity($quantity)) {
            $this->json(['success' => false, 'message' => 'Invalid quantity']);
        }
        
        $cartModel = $this->model('Cart');
        $result = $cartModel->addToCart($_SESSION['user_id'], $product_id, $quantity);
        
        $cartCount = $cartModel->getCartCount($_SESSION['user_id']);
        
        $this->json([
            'success' => true,
            'message' => 'Product added to cart',
            'cartCount' => $cartCount
        ]);
    }
    
    public function remove() {
        if(!isset($_SESSION['user_id'])) {
            $this->redirect('user/login');
        }
        
        $product_id = $_POST['product_id'] ?? null;
        
        // Validate product_id
        if($product_id && Validator::isValidId($product_id)) {
            $cartModel = $this->model('Cart');
            $cartModel->removeFromCart($_SESSION['user_id'], $product_id);
        }
        
        $this->redirect('cart');
    }
    
    public function update() {
        if(!isset($_SESSION['user_id'])) {
            $this->redirect('user/login');
        }
        
        $product_id = $_POST['product_id'] ?? null;
        $quantity = $_POST['quantity'] ?? 1;
        
        // Validate inputs
        if($product_id && Validator::isValidId($product_id) && Validator::isValidQuantity($quantity)) {
            $cartModel = $this->model('Cart');
            $cartModel->updateQuantity($_SESSION['user_id'], $product_id, $quantity);
        }
        
        $this->redirect('cart');
    }
}
?>
