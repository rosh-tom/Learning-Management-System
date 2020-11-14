<?php session_start();

include '../../classes/db.php';

$received_data = json_decode(file_get_contents("php://input"));


if($received_data->action == 'choose'){
     
    $data = [
        'qstn_id'   => $received_data->qstn_id,
        'answer'    => $received_data->std_answer,
        'qstnnr_id' => $received_data->qstnnr_id,
        'crs_id'    => $received_data->crs_id
    ];
    
    $correctAns = "SELECT qstn_answer FROM tbl_question where qstn_id=:qstn_id";
    $correctAns = DB::query($correctAns, array('qstn_id'=>$data['qstn_id']))[0]['qstn_answer'];
    
    if($correctAns == $data['answer']){
        $correct  = '1';
    }else{
        $correct = '0';
    }  

    $checkIfExist = "SELECT * FROM tbl_answer where qstn_id = :qstn_id";
    $checkIfExist = DB::query($checkIfExist, array(':qstn_id'=>$data['qstn_id']));

    if(count($checkIfExist) > 0){
        $updateAnswer = "UPDATE tbl_answer SET answer=:answer, correct=:correct WHERE qstn_id = :qstn_id";
        $updateAnswerData = [
            'answer'    => $data['answer'],
            'correct'   => $correct,
            'qstn_id'   => $data['qstn_id']
        ];
        DB::query($updateAnswer, $updateAnswerData);
    }else{ 
    
        $saveAnswer = "INSERT INTO tbl_answer (answer, correct, usr_id, crs_id, qstn_id, qstnnr_id) VALUES(
            :answer, :correct, :usr_id, :crs_id, :qstn_id, :qstnnr_id
        )";
    
        $saveAnswerData = [
            'answer'    => $data['answer'], 
            'correct'   => $correct,
            'usr_id'    => $_SESSION['loggedID'],
            'crs_id'    => $data['crs_id'],
            'qstn_id'   => $data['qstn_id'],
            'qstnnr_id' => $data['qstnnr_id']
        ]; 
        DB::query($saveAnswer, $saveAnswerData);  
    }
  
}
elseif($received_data->action == 'submitQuestionnaire'){
  
    $data = [
        'usr_id'    => $_SESSION['loggedID'], 
        'qstnnr_id'  => $received_data->qstnnr_id,
        'crs_id'  => $received_data->crs_id 
    ];

    $score = "SELECT * FROM tbl_answer WHERE correct = 1 and usr_id=:usr_id and qstnnr_id = :qstnnr_id";
    $scoreData = [
        'usr_id'    => $data['usr_id'],
        'qstnnr_id' => $data['qstnnr_id']
    ];
    $score = DB::query($score, $scoreData); 
    $score = count($score);
     

    $checkItems = "SELECT qstn_id FROM tbl_question WHERE qstnnr_id=:qstnnr_id";
    $checkItems = DB::query($checkItems, array(':qstnnr_id'=>$data['qstnnr_id']));

    $checkAnswer = "SELECT ans_id FROM tbl_answer WHERE usr_id=:usr_id and qstnnr_id=:qstnnr_id";
    $checkAnswer = DB::query($checkAnswer, array(':usr_id'=>$data['usr_id'], 'qstnnr_id'=>$data['qstnnr_id']));

    if($checkAnswer < $checkItems){
        $error = true;
    }else{
        $hello = "Not Hello";
        $saveScore = "INSERT INTO tbl_score (score, usr_id, qstnnr_id, crs_id) VALUES(
            :score, :usr_id, :qstnnr_id, :crs_id
        )";
        $saveScoreData = [
            'score'     => $score,
            'usr_id'    => $data['usr_id'], 
            'qstnnr_id' => $data['qstnnr_id'], 
            'crs_id'    => $data['crs_id']
        ];
        DB::query($saveScore, $saveScoreData);
    } 
    echo json_encode($error);
}
 

?>