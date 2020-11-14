<?php 

include 'db.php';

$tablename = "tbl_score";

$result = "create table ". $tablename ." (
    scr_id int(11) unsigned auto_increment primary key,
    score int(11),
    usr_id int(11),
    qstnnr_id int(11),
    crs_id int(11),  
    active varchar(2) default 1, 
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
)";

$result = DB::query($result); 
echo print_r($result); 

?>