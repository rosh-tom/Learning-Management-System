<?php 

include 'db.php';

$tablename = "tbl_question";

$result = "create table ". $tablename ." (
    qstn_id int(11) unsigned auto_increment primary key,
    qstn_question text,
    a varchar(100),
    b varchar(100),
    c varchar(100), 
    d varchar(100), 
    qstn_answer varchar(100),
    usr_id int(11) not null,
    crs_id int(11) not null, 
    qstnnr_id int(11) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
)";

$result = DB::query($result); 
echo print_r($result); 

?>