<?php  session_start();
include '../../classes/db.php';

if(isset($_POST['btn_saveCourse'])){
    $data = [
        'crs_number'  => $_POST['crs_number'],
        'crs_section'  => $_POST['crs_section'],
        'crs_descriptitle'  => $_POST['crs_descriptitle'],
        'crs_time'  => $_POST['crs_time'],
        'crs_days'  => $_POST['crs_days'],
        'crs_code'  => uniqid(),
        'usr_id'    => $_SESSION['loggedID']  
    ];
    $result = "INSERT INTO tbl_course(crs_number, crs_section, crs_descriptitle, crs_time, crs_days, crs_code, usr_id) VALUES(
                :crs_number, :crs_section, :crs_descriptitle, :crs_time, :crs_days, :crs_code, :usr_id)";

    $result = DB::query($result, $data); 
    unset($data);
    if($result){
        $data['message'] = 'New Course Added. ';
        $data['type']   =   'success';
        $_SESSION['temp'] = $data;
    }else{
        $data['message'] = 'Failed to Add Data. Please check your input.';
        $data['type']   =   'error';
        $_SESSION['temp'] = $data;
    }
    header("location: ../course.php");
}
?>

 