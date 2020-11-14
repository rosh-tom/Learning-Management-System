<?php 

include 'db.php';

$tablename = "tbl_course";

$result = "create table ". $tablename ." (
    crs_id int(11) unsigned auto_increment primary key,
    crs_number varchar(100),
    crs_section varchar(100),
    crs_descriptitle varchar(255) not null,
    crs_time varchar(100),
    crs_days varchar(100),
    crs_accesscode varchar(150),
    usr_id int(11) not null, 
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
)";

$result = DB::query($result); 
echo print_r($result); 

?>