<?php
class Validator {
    private static $errors = [];
    
    /**
     * Validate email format
     */
    public static function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    /**
     * Validate phone number (11 digits for Bangladesh format)
     */
    public static function isValidPhone($phone) {
        return preg_match('/^[0-9]{11}$/', $phone);
    }
    
    /**
     * Validate username (alphanumeric, 3-20 characters)
     */
    public static function isValidUsername($username) {
        return preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username);
    }
    
    /**
     * Validate password (minimum 6 characters)
     */
    public static function isValidPassword($password) {
        return strlen($password) >= 6;
    }
    
    /**
     * Validate numeric ID
     */
    public static function isValidId($id) {
        return is_numeric($id) && $id > 0;
    }
    
    /**
     * Validate quantity (positive integer)
     */
    public static function isValidQuantity($quantity) {
        return is_numeric($quantity) && $quantity > 0 && $quantity <= 999;
    }
    
    /**
     * Validate payment method
     */
    public static function isValidPaymentMethod($method) {
        $validMethods = ['bKash', 'Nagad', 'Card', 'COD'];
        return in_array($method, $validMethods);
    }
    
    /**
     * Add error message
     */
    public static function addError($message) {
        self::$errors[] = $message;
    }
    
    /**
     * Get all errors
     */
    public static function getErrors() {
        return self::$errors;
    }
    
    /**
     * Check if there are errors
     */
    public static function hasErrors() {
        return count(self::$errors) > 0;
    }
    
    /**
     * Clear errors
     */
    public static function clearErrors() {
        self::$errors = [];
    }
}
?>
