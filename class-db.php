<?php
class DB {
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName     = "aweb";
 
    public function __construct(){
        if(!isset($this->db)){
            
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
 
    public function get_user($id) {
        $query = sprintf("SELECT * FROM users WHERE qrcode_id = '$id'");
     
        return $sql->fetch_assoc();
    }
  
    public function insert_user($arr_data = array()) {
        $qrcode_id = $arr_data['qrcode_id'];
        $name = $arr_data['fullname'];
        $email = $arr_data['email'];
        $picture = $arr_data['picture'];
  
        $sql = sprintf("INSERT INTO users(qrcode_id, fullname, email, picture) VALUES('%s', '%s', '%s', '%s')", $qrcode_id, $name, $email, $picture);
        $this->db->query($sql);
    }
}