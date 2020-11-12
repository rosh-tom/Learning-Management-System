<?php 

include 'db.php';

$tablename = "tbl_user";

$result = "create table ". $tablename ." (
    usr_id int(11) unsigned auto_increment primary key,
    usr_firstname varchar(100) not null,
    usr_middlename varchar(100),
    usr_lastname varchar(100) not null,
    usr_email varchar(150) not null,
    usr_password varchar(255) not null,
    usr_profilepic varchar(255),
    usr_type varchar(50) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
)";

$result = DB::query($result); 
echo print_r($result); 

?>