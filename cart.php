<?php
require_once 'Database.php';

class Product {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }


    public function addProduct($sku, $name, $description, $price, $stock, $image) {
        $sql = "INSERT INTO items (sku, name, description, price, stock, image) VALUES (?, ?, ?, ?, ?, ?)";
        $this->db->executeQuery($sql, "sssdis", [$sku, $name, $description, $price, $stock, $image]);
    }


    public function getProducts() {
        $sql = "SELECT * FROM items";
        $result = $this->db->executeQuery($sql)->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

  
    public function getProductById($item_id) {
        $sql = "SELECT * FROM items WHERE item_id = ?";
        $result = $this->db->executeQuery($sql, "i", [$item_id])->get_result();
        return $result->fetch_assoc();
    }

 
    public function createOrder($user_id, $address, $state_name, $payment_method, $cart_data) {
       
        $total_without_tax = 0;
        foreach ($cart_data as $item) {
            $total_without_tax += $item['price'] * $item['quantity'];
        }
        $cgst = $total_without_tax * 0.09;
        $sgst = $total_without_tax * 0.09;
        $total_with_tax = $total_without_tax + $cgst + $sgst;

        $sql = "INSERT INTO order_form (user_id, address, state_name, payment_method) VALUES (?, ?, ?, ?)";
        $this->db->executeQuery($sql, "isss", [$user_id, $address, $state_name, $payment_method]);

        $order_form_id = $this->db->conn->insert_id;

      
        $encoded_cart_data = json_encode(value: $cart_data);

       
        $sql = "INSERT INTO order_summary (user_id, order_form_id, quantity, total_price, CGST, SGST, total_with_gst)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $this->db->executeQuery($sql, "iisdddd", [$user_id, $order_form_id, $encoded_cart_data, $total_without_tax, $cgst, $sgst, $total_with_tax]);
    }


    public function getOrderDetails($order_summary_id) {
        $sql = "SELECT * FROM order_summary WHERE order_summary_id = ?";
        $stmt = $this->db->executeQuery($sql, "i", [$order_summary_id])->get_result();
        $order = $stmt->fetch_assoc();
        
    
        $order['quantity'] = json_decode($order['quantity'], true);
        return $order;
    }
    
}
?>
