<?php 

include 'classes/db.php';

$database = "lms";

$result = DB::query("create database :database", array(':database'=>$database));
if($result){
    echo "Database successfully created.";
}else{
    print_r($result);
}

?>