<?php 
    session_start();

    include '../../classes/db.php';
    $received_data = json_decode(file_get_contents("php://input"));

    if($received_data->action == 'setActive'){  
        $data = [
            'qstnnr_id' => $received_data->qstnnr_id,
            'usr_id'    => $_SESSION['loggedID']
        ];
        $activate = "UPDATE tbl_questionnaire SET active = 1 WHERE qstnnr_id = :qstnnr_id and usr_id = :usr_id";
        DB::query($activate, $data);
    }
     
    elseif($received_data->action == 'setInActive'){  
        $data = [
            'qstnnr_id' => $received_data->qstnnr_id,
            'usr_id'    => $_SESSION['loggedID']
        ];
        $activate = "UPDATE tbl_questionnaire SET active = 0 WHERE qstnnr_id = :qstnnr_id and usr_id = :usr_id";
        DB::query($activate, $data);
    }
    elseif($received_data->action == 'fetchsingleQuestionnaire'){
        $data = [
            'qstnnr_id' => $received_data->id 
        ];

        $items = array();

        $fetchQuestionnaire = "SELECT * FROM tbl_questionnaire WHERE qstnnr_id=:qstnnr_id";
        $fetchQuestionnaire = DB::query($fetchQuestionnaire, $data);
        foreach($fetchQuestionnaire as $result){
            $items [] = $result;
        } 
        echo json_encode(var_dump($items));
    }
    
    else{

    }

?>