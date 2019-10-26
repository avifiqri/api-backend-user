<?php

class DB_Funtions {

    private $conn;

    function __construct() {
        
        require_once "db_connect.php";
        $db = new DB_Connect();
        $this->conn = $db->connect();

    }

    function __destruct(){

        // TODO : implementation __destruct () method


    }

    /*
    *Check user Exist
    *Return true/false
    */

    function checkExsistUser($phone) {

        $stmt = $this->conn->prepare( "SELECT *FROM users WHERE phone=?");
        $stmt->bind_params ("s",$phone);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0) {

            $stmt->close();
            return true;

        } else {

            $stmt->close();
            return false;

        }


    }

    /* Register new ser
    - return User Object if user was created;
    - reutrb error mwssage if have exception
    */
    public function registerNewUser($phone,$name,$birthday,$address) {

        $stmt = $this->conn->prepare("INSERT INTO users($phone, $name, $birthday, $address) VALUES(?,?,?,?)" );
        $stmt->bind_params("ssss",$phone,$name,$birthday,$address);
        $result = $stmt->execute();
        $stmt->close();

        if($result) {

            $stmt = $this->conn->prepare("SELECT * FROM  users WHERE phone = ?");
            $stmt->bind_params("s",phone);
            $stmt->execute();
            $users = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $users;
            
        } else {

            return false;
        
        }


    }
 
}




?>