<?php
    require_once "db_funtions.php";
    $db = new DB_Funtions();


    $response =array();

    if(isset($_POST['phone'])&&
        isset($_POST['name'])&& 
        isset($_POST['birthday'])&&
        isset($_POST['address'])){

        $phone = $_POST['phone'];
        $name = $_POST['name'];
        $birthday = $_POST['birthday'];
        $address = $_POST['address'];
        if($db->checkExsistUser($phone)) 
        {

            $response["error_messsage"] = "User sudah tersedia". $phone;
            echo json_encode($response);    

        } 
        
        else 
        {
           
            $user = $db->registerNewUser($phone, $name, $birthday, $address);
            if($user) 
            {
                $response["phone"]  = $user["phone"];
                $response["name"]  = $user["name"];
                $response["birthday"]  = $user["birthday"];
                $response["address"]  = $user["address"];
                echo json_encode($response);
            }
            else 
            {
                $response["error_message"]  = "ada kesalahan pada pendaftaran";
                echo json_encode($response);
            
            
            }


        }


    }else {

        $response["error_message"] = "Require parameter (phone) is missing ";
        echo json_encode($response);

    }





?>