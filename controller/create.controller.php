<?php session_start();

include '../classes/db.php';


if(isset($_POST['btn_signup'])){
    $data = [
        'usr_firstname' => $_POST['usr_firstname'],
        'usr_lastname'  => $_POST['usr_lastname'],
        'usr_email'     => $_POST['usr_email'],
        'usr_password'  => password_hash($_POST['usr_password'], PASSWORD_DEFAULT),
        'usr_type'      => 'student'
    ]; 

    $checkEmail = "SELECT * FROM tbl_user where usr_email = :usr_email";
    $checkEmail = DB::query($checkEmail, array(':usr_email'=>$data['usr_email']));

    if(count($checkEmail) != 0){
        $data['message'] = "Email Already Exist in our Database."; 
        $data['success'] = false; 
        $_SESSION['temp'] = $data; 
        header("location: ../create.php");
    }
    else{ 
        $create = "INSERT INTO tbl_user(usr_firstname, usr_lastname, usr_email, usr_password, usr_type) VALUES(
            :usr_firstname, :usr_lastname, :usr_email, :usr_password, :usr_type
        )"; 
        $create = DB::query($create, $data);
         
        if($create){
            unset($data);
            $data['message'] = "Account Successfully Created. Please Log in"; 
            $data['success'] = true;
            $_SESSION['temp'] = $data;
            header("location: ../login.php");

        }else{
            $data['message'] = "Something Went Wrong. Please Try Again Later. ";
            $data['success'] = false; 
            $_SESSION['temp'] = $data; 
            header("location: ../create.php");
        }
    }  
 
}

?>