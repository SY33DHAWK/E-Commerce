<?php
class Category extends Model {
    protected $table = 'categories';
    
    public function getAllCategories() {
        $sql = "SELECT * FROM categories ORDER BY category_name ASC";
        return $this->query($sql)->fetchAll();
    }
    
    public function getCategoryById($id) {
        $sql = "SELECT * FROM categories WHERE category_id = ?";
        return $this->query($sql, [$id])->fetch();
    }
    
    public function addCategory($name) {
        $sql = "INSERT INTO categories (category_name) VALUES (?)";
        return $this->query($sql, [$name]);
    }
    
    public function updateCategory($id, $name) {
        $sql = "UPDATE categories SET category_name = ? WHERE category_id = ?";
        return $this->query($sql, [$name, $id]);
    }
    
    public function deleteCategory($id) {
        $sql = "DELETE FROM categories WHERE category_id = ?";
        return $this->query($sql, [$id]);
    }
}
?>
