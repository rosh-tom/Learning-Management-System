<?php 
    session_start();

    include '../../classes/db.php';
    $received_data = json_decode(file_get_contents("php://input"));

    if($received_data->action == 'saveFaculty'){  
        $data = [
            'firstname' => $received_data->firstname,
            'middlename'=> $received_data->middlename,
            'lastname'  => $received_data->lastname,
            'email'     => $received_data->email,
            'pass'      => password_hash($received_data->password, PASSWORD_DEFAULT),
            'profilepic'=> '', 
            'types'      => $received_data->type
        ];  
        $result = "INSERT INTO tbl_user(usr_firstname, usr_middlename, usr_lastname, usr_email, usr_password, usr_profilepic, usr_type) VALUES(
            :firstname, :middlename, :lastname, :email, :pass, :profilepic, :types 
        )";
        $result = DB::query($result, $data);
        unset($data);
        if($result){ 
            $data = [
                'success'   => true, 
            ];
        }else{
            // $hello = $result;
            $data = [
                'success'   => false, 
            ];
        } 
        echo json_encode($data);
    }

?>