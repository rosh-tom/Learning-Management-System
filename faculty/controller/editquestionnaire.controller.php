<?php session_start(); 
  include '../../classes/db.php';
  
if(isset($_POST['btn_update'])){
    $data = [
        'qstnnr_title'          => $_POST['qstnnr_title'],
        'qstnnr_description'    => $_POST['qstnnr_description'],
        'qstnnr_type'           => $_POST['qstnnr_type'],
        'qstnnr_item'           => $_POST['qstnnr_item'],
        'usr_id'                => $_SESSION['loggedID'],
        'crs_id'                => $_POST['crs_id'],
        'qstnnr_id'             => $_POST['qstnnr_id']
    ]; 
    $updateQuestionnaire = "UPDATE tbl_questionnaire SET 
        qstnnr_title=:qstnnr_title , qstnnr_description=:qstnnr_description , qstnnr_type=:qstnnr_type , qstnnr_item=:qstnnr_item Where usr_id=:usr_id and crs_id=:crs_id and qstnnr_id=:qstnnr_id
    "; 
    DB::query($updateQuestionnaire, $data);
    header("location: ../managecourse_questionnaire.php?course=".$data['crs_id']."");
 
}




?>