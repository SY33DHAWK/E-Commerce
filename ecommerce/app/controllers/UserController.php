<?php
class UserController extends Controller {
    
    public function login() {
        // Redirect if already logged in
        if(isset($_SESSION['user_id'])) {
            $this->redirect('home');
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $userModel = $this->model('User');
            $user = $userModel->login($username, $password);
            
            if($user) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                
                $this->redirect('home');
            } else {
                $data = [
                    'title' => 'Login',
                    'error' => 'Invalid username or password',
                    'cartCount' => 0
                ];
                $this->view('user/login', $data);
            }
        } else {
            $data = [
                'title' => 'Login',
                'cartCount' => 0
            ];
            $this->view('user/login', $data);
        }
    }
    
    public function register() {
        // Redirect if already logged in
        if(isset($_SESSION['user_id'])) {
            $this->redirect('home');
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userData = [
                'username' => trim($_POST['username'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'password' => $_POST['password'] ?? '',
                'full_name' => trim($_POST['full_name'] ?? ''),
                'phone' => trim($_POST['phone'] ?? '')
            ];
            
            // Validate
            $errors = [];
            
            if(empty($userData['full_name'])) {
                $errors[] = 'Full name is required';
            }
            
            if(empty($userData['username'])) {
                $errors[] = 'Username is required';
            } elseif(!Validator::isValidUsername($userData['username'])) {
                $errors[] = 'Username must be 3-20 characters (alphanumeric and underscore only)';
            }
            
            if(empty($userData['email'])) {
                $errors[] = 'Email is required';
            } elseif(!Validator::isValidEmail($userData['email'])) {
                $errors[] = 'Email format is invalid';
            }
            
            if(empty($userData['phone'])) {
                $errors[] = 'Phone number is required';
            } elseif(!Validator::isValidPhone($userData['phone'])) {
                $errors[] = 'Phone number must be 11 digits';
            }
            
            if(empty($userData['password'])) {
                $errors[] = 'Password is required';
            } elseif(!Validator::isValidPassword($userData['password'])) {
                $errors[] = 'Password must be at least 6 characters';
            }
            
            if(empty($errors)) {
                $userModel = $this->model('User');
                $result = $userModel->register($userData);
                
                if($result) {
                    $data = [
                        'title' => 'Login',
                        'success' => 'Registration successful! Please login.',
                        'cartCount' => 0
                    ];
                    $this->view('user/login', $data);
                } else {
                    $errors[] = 'Username or email already exists';
                }
            }
            
            if(!empty($errors)) {
                $data = [
                    'title' => 'Register',
                    'errors' => $errors,
                    'cartCount' => 0
                ];
                $this->view('user/register', $data);
            }
        } else {
            $data = [
                'title' => 'Register',
                'cartCount' => 0
            ];
            $this->view('user/register', $data);
        }
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('home');
    }
    
    public function profile() {
        if(!isset($_SESSION['user_id'])) {
            $this->redirect('user/login');
        }
        
        $userModel = $this->model('User');
        $orderModel = $this->model('Order');
        $cartModel = $this->model('Cart');
        
        $user = $userModel->getUserById($_SESSION['user_id']);
        $orders = $orderModel->getUserOrders($_SESSION['user_id']);
        $cartCount = $cartModel->getCartCount($_SESSION['user_id']);
        
        $data = [
            'title' => 'My Profile',
            'user' => $user,
            'orders' => $orders,
            'cartCount' => $cartCount
        ];
        
        $this->view('user/profile', $data);
    }
}
?>
