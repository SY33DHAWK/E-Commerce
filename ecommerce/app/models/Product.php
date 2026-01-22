<?php
class Product extends Model {
    protected $table = 'products';
    
    public function getAllProducts($limit = null) {
        $sql = "SELECT * FROM products ORDER BY created_at DESC";
        if($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        return $this->query($sql)->fetchAll();
    }
    
    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        return $this->query($sql, [$id])->fetch();
    }
    
    public function getProductsByBrand($brand) {
        $sql = "SELECT * FROM products WHERE brand = ? ORDER BY created_at DESC";
        return $this->query($sql, [$brand])->fetchAll();
    }
    
    public function getProductsByCategory($category_id) {
        $sql = "SELECT * FROM products WHERE category_id = ? ORDER BY created_at DESC";
        return $this->query($sql, [$category_id])->fetchAll();
    }
    
    public function searchProducts($keyword) {
        $sql = "SELECT * FROM products WHERE product_name LIKE ? OR brand LIKE ? OR description LIKE ?";
        $keyword = "%{$keyword}%";
        return $this->query($sql, [$keyword, $keyword, $keyword])->fetchAll();
    }
    
    public function getDiscountedPrice($product) {
        return $product['price'] - ($product['price'] * $product['discount_percentage'] / 100);
    }
    
    public function addProduct($data) {
        $sql = "INSERT INTO products (product_name, brand, category_id, price, discount_percentage, description, product_image, stock_status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        return $this->query($sql, [
            $data['product_name'],
            $data['brand'],
            $data['category_id'],
            $data['price'],
            $data['discount_percentage'],
            $data['description'],
            $data['product_image'],
            $data['stock_status']
        ]);
    }
    
    public function updateProduct($id, $data) {
        $sql = "UPDATE products SET product_name=?, brand=?, category_id=?, price=?, discount_percentage=?, description=?, stock_status=? WHERE product_id=?";
        return $this->query($sql, [
            $data['product_name'],
            $data['brand'],
            $data['category_id'],
            $data['price'],
            $data['discount_percentage'],
            $data['description'],
            $data['stock_status'],
            $id
        ]);
    }
    
    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE product_id = ?";
        return $this->query($sql, [$id]);
    }
}
?>
