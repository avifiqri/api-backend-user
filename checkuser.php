<?php
    require_once "db_funtions.php";
    $db = new DB_Funtions();


    $response =array();
    if(isset($_POST['phone'])) {

        $phone = $_POST['phone'];
        if($db->checkExsistUser($phone)) {

            $response["exists"] = TRUE;
            echo json_encode($response);

        } else {
            
            $response["exists"] = FALSE;
            echo json_encode($response);

        }


    }else {

        $response["error_message"] = "Require parameter (phone) is missing ";
        echo json_encode($response);

    }





?>