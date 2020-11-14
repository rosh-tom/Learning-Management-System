<?php 

include 'db.php';

$tablename = "tbl_answer";

$result = "create table ". $tablename ." (
    ans_id int(11) unsigned auto_increment primary key,
    answer varchar(100) not null,
    correct varchar(10) not null,
    usr_id int(11) not null,
    crs_id int(11) not null,
    qstn_id int(11) not null, 
    qstnnr_id int(11), 
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
)";

$result = DB::query($result); 
echo print_r($result); 

?>