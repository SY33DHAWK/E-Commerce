<?php
class PaymentController extends Controller {
    
    public function index() {
        if(!isset($_SESSION['user_id'])) {
            $this->redirect('user/login');
        }
        
        $cartModel = $this->model('Cart');
        $cartTotal = $cartModel->getCartTotal($_SESSION['user_id']);
        $cartCount = $cartModel->getCartCount($_SESSION['user_id']);
        
        // Redirect if cart is empty
        if($cartTotal == 0) {
            $this->redirect('cart');
        }
        
        $data = [
            'title' => 'Payment',
            'cartTotal' => $cartTotal,
            'cartCount' => $cartCount
        ];
        
        $this->view('payment/index', $data);
    }
    
    public function process() {
        if(!isset($_SESSION['user_id'])) {
            $this->json(['success' => false, 'message' => 'Not logged in']);
        }
        
        $payment_method = $_POST['payment_method'] ?? 'COD';
        
        // Validate payment method
        if(!Validator::isValidPaymentMethod($payment_method)) {
            $this->json(['success' => false, 'message' => 'Invalid payment method']);
        }
        
        $cartModel = $this->model('Cart');
        $orderModel = $this->model('Order');
        
        $cartItems = $cartModel->getCartItems($_SESSION['user_id']);
        $cartTotal = $cartModel->getCartTotal($_SESSION['user_id']);
        
        if(empty($cartItems) || $cartTotal == 0) {
            $this->json(['success' => false, 'message' => 'Cart is empty']);
        }
        
        // Create order
        $order_id = $orderModel->createOrder($_SESSION['user_id'], $cartTotal, $payment_method);
        
        // Add order items
        $orderModel->addOrderItems($order_id, $cartItems);
        
        // Clear cart
        $cartModel->clearCart($_SESSION['user_id']);
        
        $this->json([
            'success' => true,
            'order_id' => $order_id,
            'amount' => $cartTotal
        ]);
    }
    
    public function confirmation($order_id = null) {
        if(!isset($_SESSION['user_id']) || !$order_id || !Validator::isValidId($order_id)) {
            $this->redirect('home');
        }
        
        $orderModel = $this->model('Order');
        $order = $orderModel->getOrderById($order_id);
        
        // Verify order belongs to user
        if(!$order || $order['user_id'] != $_SESSION['user_id']) {
            $this->redirect('home');
        }
        
        $orderItems = $orderModel->getOrderItems($order_id);
        $cartCount = 0;
        
        $data = [
            'title' => 'Order Confirmation',
            'order' => $order,
            'orderItems' => $orderItems,
            'cartCount' => $cartCount
        ];
        
        $this->view('payment/confirmation', $data);
    }
}
?>
