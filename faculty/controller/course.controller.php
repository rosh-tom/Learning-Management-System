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
    $result = "INSERT INTO tbl_course(crs_number, crs_section, crs_descriptitle, crs_time, crs_days, crs_accesscode, usr_id) VALUES(
                :crs_number, :crs_section, :crs_descriptitle, :crs_time, :crs_days, :crs_code, :usr_id)";

    $result = DB::query($result, $data);  
    if($result){
        mkdir("../../uploads/".$data['crs_number']); 
        unset($data);
        $data['message'] = 'New Course Added. ';
        $data['type']   =   'success';
        $_SESSION['temp'] = $data; 
    }else{
        unset($data);
        $data['message'] = 'Failed to Add Data. Please check your input.';
        $data['type']   =   'error';
        $_SESSION['temp'] = $data;
    }
    header("location: ../course.php"); 
}

elseif(isset($_POST['btn_savePost'])){  
    $pst_filename = $_FILES['uploaded_file']['name'];
    $data = [ 
        'pst_title'         => $_POST['pst_title'],
        'pst_description'   => $_POST['pst_description'],
        'pst_location'      => ' ',
        'pst_type'          => ' ', 
        'pst_filename'      => ' ', 
        'usr_id'            => $_SESSION['loggedID'],
        'crs_id'            => $_POST['crs_id']
    ];

    if($pst_filename != ''){  
        $type = $_FILES['uploaded_file']['type'];
        $type = explode('/', $type);
        $data['pst_type'] = $type[0];
        $data['pst_filename'] = $_FILES['uploaded_file']['name'];

        $crs_id = "SELECT crs_number FROM tbl_course WHERE crs_id = :crs_id";
        $crs_id = DB::query($crs_id, array('crs_id'=> $data['crs_id']));

        $foldername = $crs_id[0]['crs_number'];

        $data['pst_location'] = "uploads/".$foldername."/".basename($pst_filename);
        $target = "../../". $data['pst_location'];
        move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $target);  
    }
 
    $result = "INSERT INTO tbl_post(pst_title, pst_description, pst_location, pst_type, pst_filename, usr_id, crs_id) VALUES(
        :pst_title, :pst_description, :pst_location, :pst_type, :pst_filename, :usr_id, :crs_id
    )";

   $result = DB::query($result, $data);
   header("location: ../managecourse.php?course=".$data['crs_id']."");
 
}
elseif(isset($_POST['btn_saveQstnnr'])){
    $data = [
        'qstnnr_title'          => $_POST['qstnnr_title'],
        'qstnnr_description'    => $_POST['qstnnr_description'],
        'qstnnr_type'           => $_POST['qstnnr_type'],
        'qstnnr_item'           => $_POST['qstnnr_item'],
        'usr_id'                => $_SESSION['loggedID'],
        'crs_id'                => $_POST['crs_id']
    ];

    $result = "INSERT INTO tbl_questionnaire (qstnnr_title, qstnnr_description, qstnnr_type, qstnnr_item, usr_id, crs_id) VALUES(
        :qstnnr_title, :qstnnr_description, :qstnnr_type, :qstnnr_item, :usr_id, :crs_id
    )";

    $result = DB::query($result, $data);   
    unset($data); 
    if($result){
        $data['message'] = "New Questionnaire Created. "; 
        $data['success'] = true; 
    }else{
        $data['message'] = "Something went wrong. Please Try again later. ";
        $data['success'] = false;
    } 
    $data['$crs_id'] = $_POST['crs_id'];
    $_SESSION['temp'] = $data;
    header("location: ../managecourse_questionnaire.php?course=".$data['$crs_id']."");
}
?>

 