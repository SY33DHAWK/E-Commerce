<?php
class Cart extends Model {
    protected $table = 'cart';
    
    public function addToCart($user_id, $product_id, $quantity = 1) {
        // Check if product already in cart
        $existing = $this->getCartItem($user_id, $product_id);
        
        if($existing) {
            $sql = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?";
            return $this->query($sql, [$quantity, $user_id, $product_id]);
        } else {
            $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
            return $this->query($sql, [$user_id, $product_id, $quantity]);
        }
    }
    
    public function getCartItem($user_id, $product_id) {
        $sql = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
        return $this->query($sql, [$user_id, $product_id])->fetch();
    }
    
    public function getCartItems($user_id) {
        $sql = "SELECT c.*, p.* FROM cart c 
                JOIN products p ON c.product_id = p.product_id 
                WHERE c.user_id = ?";
        return $this->query($sql, [$user_id])->fetchAll();
    }
    
    public function getCartTotal($user_id) {
        $sql = "SELECT SUM(p.price * c.quantity * (100 - p.discount_percentage) / 100) as total 
                FROM cart c 
                JOIN products p ON c.product_id = p.product_id 
                WHERE c.user_id = ?";
        $result = $this->query($sql, [$user_id])->fetch();
        return $result['total'] ?? 0;
    }
    
    public function updateQuantity($user_id, $product_id, $quantity) {
        $sql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
        return $this->query($sql, [$quantity, $user_id, $product_id]);
    }
    
    public function removeFromCart($user_id, $product_id) {
        $sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
        return $this->query($sql, [$user_id, $product_id]);
    }
    
    public function clearCart($user_id) {
        $sql = "DELETE FROM cart WHERE user_id = ?";
        return $this->query($sql, [$user_id]);
    }
    
    public function getCartCount($user_id) {
        $sql = "SELECT COUNT(*) as count FROM cart WHERE user_id = ?";
        $result = $this->query($sql, [$user_id])->fetch();
        return $result['count'] ?? 0;
    }
}
?>
