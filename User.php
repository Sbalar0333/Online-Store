<?php
require_once 'Database.php'; // Ensure this file includes the Database connection class

class User {
    public $db; // Declare the db property

    public function __construct() {
      
        $this->db = new Database(); 
    }

    public function register($name, $email, $password, $mobile_number, $gender, $city_name, $pin_code, $user_type, $photo) {
        
        $sql = "INSERT INTO registration (name, email, password, mobile_number, gender, city_name, pin_code, user_type, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->db->executeQuery($sql, "ssss", [$name, $email, $password, $mobile_number, $gender, $city_name, $pin_code, $user_type,$photo]);
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM registration WHERE email = ?";
        $result = $this->db->executeQuery($sql, "s", [$email])->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public function updateProfile($user_id, $name, $email, $mobile,  $gender, $city, $pincode, $userType, $photo) {
        $sql = "UPDATE registration SET name = ?, email=?, mobile_number = ?, gender=?, city_name = ?, pin_code = ?, user_type = ?, photo = ? WHERE user_id = ?";
        $this->db->executeQuery($sql, "ssssssssi", [$name, $email, $mobile, $gender, $city, $pincode, $userType, $photo, $user_id]);
    }

    public function getProfile($user_id) {
        $sql = "SELECT * FROM registration WHERE user_id = ?";
        $result = $this->db->executeQuery($sql, "i", [$user_id])->get_result();
        return $result->fetch_assoc();
    }
}
?>
