<?php
class Order extends Model {
    protected $table = 'orders';
    
    public function createOrder($user_id, $total, $payment_method) {
        $sql = "INSERT INTO orders (user_id, total_amount, payment_method, order_status) 
                VALUES (?, ?, ?, 'Confirmed')";
        $this->query($sql, [$user_id, $total, $payment_method]);
        return $this->db->lastInsertId();
    }
    
    public function addOrderItems($order_id, $cart_items) {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                VALUES (?, ?, ?, ?)";
        
        foreach($cart_items as $item) {
            $discountedPrice = $item['price'] - ($item['price'] * $item['discount_percentage'] / 100);
            $this->query($sql, [
                $order_id,
                $item['product_id'],
                $item['quantity'],
                $discountedPrice
            ]);
        }
    }
    
    public function getUserOrders($user_id) {
        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
        return $this->query($sql, [$user_id])->fetchAll();
    }
    
    public function getOrderById($order_id) {
        $sql = "SELECT * FROM orders WHERE order_id = ?";
        return $this->query($sql, [$order_id])->fetch();
    }
    
    public function getOrderItems($order_id) {
        $sql = "SELECT oi.*, p.product_name, p.brand 
                FROM order_items oi 
                JOIN products p ON oi.product_id = p.product_id 
                WHERE oi.order_id = ?";
        return $this->query($sql, [$order_id])->fetchAll();
    }
    
    public function getAllOrders() {
        $sql = "SELECT o.*, u.username, u.full_name 
                FROM orders o 
                JOIN users u ON o.user_id = u.user_id 
                ORDER BY o.order_date DESC";
        return $this->query($sql)->fetchAll();
    }
    
    public function updateOrderStatus($order_id, $status) {
        $sql = "UPDATE orders SET order_status = ? WHERE order_id = ?";
        return $this->query($sql, [$status, $order_id]);
    }
}
?>
