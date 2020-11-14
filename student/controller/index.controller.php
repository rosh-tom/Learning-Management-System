<?php session_start();

include '../../classes/db.php';

$received_data = json_decode(file_get_contents("php://input"));

if($received_data->action =='addCourse'){
    $data = [
        'accesscode' => $received_data->accesscode
    ];
    
    $findcode = "SELECT * FROM tbl_accesscode where accesscode = :accesscode";
    $findcode = DB::query($findcode, $data);
    unset($data);
    if(count($findcode) == 0){
        $data['message'] = "Invalid Access Code";
        $data['error'] = true; 
    } else{
        $data = [
            'usr_id'=> $_SESSION['loggedID'],
            'crs_id' => $findcode[0]['crs_id'],
            'active' => 1
        ];
        $addCourse = "INSERT INTO tbl_studentcourse (usr_id, crs_id, active) VALUES(
            :usr_id, :crs_id, :active
        )";
        $addCourse = DB::query($addCourse, $data); 
        if($addCourse){
            $data['error'] = false;
            $data['link'] = "course.php?course=".$data['crs_id'];
        }else{
            $data['error'] = true;
            $data['message'] = "Something went Wrong. ";
        }
    }

    echo json_encode($data);
}