<?php
class User extends Model {
    protected $table = 'users';
    
    public function register($data) {
        $sql = "INSERT INTO users (username, email, password, full_name, phone) 
                VALUES (?, ?, ?, ?, ?)";
        
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        try {
            return $this->query($sql, [
                $data['username'],
                $data['email'],
                $hashedPassword,
                $data['full_name'],
                $data['phone']
            ]);
        } catch(PDOException $e) {
            return false;
        }
    }
    
    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
        $user = $this->query($sql, [$username, $username])->fetch();
        
        if($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
    
    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        return $this->query($sql, [$id])->fetch();
    }
    
    public function emailExists($email) {
        $sql = "SELECT COUNT(*) as count FROM users WHERE email = ?";
        $result = $this->query($sql, [$email])->fetch();
        return $result['count'] > 0;
    }
    
    public function usernameExists($username) {
        $sql = "SELECT COUNT(*) as count FROM users WHERE username = ?";
        $result = $this->query($sql, [$username])->fetch();
        return $result['count'] > 0;
    }
}
?>
