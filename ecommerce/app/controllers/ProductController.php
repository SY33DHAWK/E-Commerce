<?php
class ProductController extends Controller {
    
    public function index() {
        $productModel = $this->model('Product');
        
        // Get cart count
        $cartCount = 0;
        if(isset($_SESSION['user_id'])) {
            $cartModel = $this->model('Cart');
            $cartCount = $cartModel->getCartCount($_SESSION['user_id']);
        }
        
        // Get products based on filters
        if(isset($_GET['brand'])) {
            $products = $productModel->getProductsByBrand($_GET['brand']);
            $pageTitle = $_GET['brand'] . ' Products';
        } elseif(isset($_GET['category'])) {
            $products = $productModel->getProductsByCategory($_GET['category']);
            $pageTitle = 'Category Products';
        } elseif(isset($_GET['search'])) {
            $products = $productModel->searchProducts($_GET['search']);
            $pageTitle = 'Search Results for: ' . htmlspecialchars($_GET['search']);
        } else {
            $products = $productModel->getAllProducts();
            $pageTitle = 'All Products';
        }
        
        $data = [
            'title' => $pageTitle,
            'products' => $products,
            'productModel' => $productModel,
            'cartCount' => $cartCount
        ];
        
        $this->view('products/index', $data);
    }
    
    public function detail($id) {
        // Validate ID format
        if(!$id || !Validator::isValidId($id)) {
            $this->redirect('product/index');
        }
        
        $productModel = $this->model('Product');
        $product = $productModel->getProductById($id);
        
        if(!$product) {
            $this->redirect('product/index');
        }
        
        // Get cart count
        $cartCount = 0;
        if(isset($_SESSION['user_id'])) {
            $cartModel = $this->model('Cart');
            $cartCount = $cartModel->getCartCount($_SESSION['user_id']);
        }
        
        $data = [
            'title' => htmlspecialchars($product['product_name']),
            'product' => $product,
            'productModel' => $productModel,
            'cartCount' => $cartCount
        ];
        
        $this->view('products/detail', $data);
    }
}
?>
