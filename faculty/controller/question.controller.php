<?php 
    session_start();

    include '../../classes/db.php';
    $received_data = json_decode(file_get_contents("php://input"));

    if($received_data->action == 'saveQuestion'){  
        $data = [
                'qstn_question' => $received_data->qstn_question,
                'a'             => $received_data->a,
                'b'             => $received_data->b,
                'c'             => $received_data->c,
                'd'             => $received_data->d,
                'qstn_answer'   => $received_data->qstn_answer,
                'usr_id'        => $_SESSION['loggedID'],
                'crs_id'        => $received_data->crs_id,
                'qstnnr_id'     => $received_data->qstnnr_id
        ];  

        $result = "INSERT INTO tbl_question(qstn_question, a, b, c, d, qstn_answer, usr_id, crs_id, qstnnr_id) VALUES(
            :qstn_question, :a, :b, :c, :d, :qstn_answer, :usr_id, :crs_id, :qstnnr_id
        )";
        $result = DB::query($result, $data);  

        if($result){
            $succes = true;
        }else{ 
            $succes = false;
        } 

      echo json_encode($succes);
    }
    elseif($received_data->action == 'fetchAllQuestion'){
        $data = [
            'usr_id' => $_SESSION['loggedID'],
            'crs_id' => $received_data->crs_id,
            'qstnnr_id' => $received_data->qstnnr_id
        ];
        $results = "SELECT * FROM tbl_question where usr_id = :usr_id and crs_id = :crs_id and qstnnr_id=:qstnnr_id ORDER BY created_at DESC";
        $results = DB::query($results, $data); 
        echo json_encode($results);
    }

?>