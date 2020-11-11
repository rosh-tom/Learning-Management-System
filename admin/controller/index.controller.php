<?php 
    session_start();

    include '../../classes/db.php';
    $received_data = json_decode(file_get_contents("php://input"));

    if($received_data->action == 'saveFaculty'){ 
        $data = [
            'message'=> 'hello WOrld'
        ];

        echo json_encode($data);
    }

?>