<?php 

include 'db.php';

$tablename = "tbl_post";

$result = "create table ". $tablename ." (
    pst_id int(11) unsigned auto_increment primary key,
    pst_title varchar(255),
    pst_description TEXT,
    pst_location varchar(255),
    pst_type varchar(100),
    pst_filename varchar(255),
    usr_id int(11) not null,
    crs_id int(11) not null, 
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
)";

$result = DB::query($result); 
echo print_r($result); 

?>