<?php 

include 'db.php';

$tablename = "tbl_forum";

$result = "create table ". $tablename ." (
    frm_id int(11) unsigned auto_increment primary key,
    msg text not null,
    usr_id int(11),
    crs_id int(11), 
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
)";

$result = DB::query($result); 
echo print_r($result); 

?>