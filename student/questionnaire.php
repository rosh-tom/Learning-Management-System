<?php include 'includes/header.php'; ?>
        <title>Welcome to SDSSU CANTILAN LMS</title> 
    </head>
    <body>
<?php  
    $result_course = "SELECT * FROM tbl_course WHERE crs_id = :crs_id";
    $result_course = DB::query($result_course, array(':crs_id'=>$_GET['course']));  

?>

            <div class="container">
<?php include 'includes/navigation.php'; ?> 


<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ CONTENT  -->
<?php include 'includes/nav.php'; ?>
 
<div id="questionnaire">


    <div class="row">  
        <div class="col-sm-12 margin-b-20">   
            <h2>Questionnaire</h2>
        </div>
    </div>

<?php  

    $fclty_id = "SELECT usr_id FROM tbl_course WHERE crs_id=:crs_id";
    $fclty_id = DB::query($fclty_id, array(':crs_id'=>$_GET['course']))[0]['usr_id'];

    $questionnaires = "SELECT * FROM tbl_questionnaire WHERE usr_id=:fclty_id and crs_id=:crs_id and active = '1' ORDER BY created_at DESC";
    $questionnairesData = [
        'fclty_id'  => $fclty_id,
        'crs_id'    => $_GET['course']
    ];
    $questionnaires = DB::query($questionnaires, $questionnairesData);
    
    if(count($questionnaires) == 0){
        echo "No Questionnaire Available";
    }else{ 
        foreach($questionnaires as $questionnaire){ 
?> 
    <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default"> 
                    <div class="panel-heading">  
                        <p style="margin-bottom: -5px; "> <span class="qstnnr_title"><?= $questionnaire['qstnnr_title']?></p> 
                    </div> 

                    <div class="panel-body"> 
                        <p> - <?= $questionnaire['qstnnr_description']?></p>
                        <p> - <?= $questionnaire['qstnnr_type']?></p> 
                    </div>
<?php 
    $studentProgress = "SELECT * FROM tbl_answer WHERE qstnnr_id = :qstnnr_id";
    $studentProgress = DB::query($studentProgress, array('qstnnr_id'=>$questionnaire['qstnnr_id']));
    $studentProgress = count($studentProgress);

    $questionItems = "SELECT * FROM tbl_question WHERE qstnnr_id=:qstnnr_id and usr_id=:faculty";
    $questionItems = DB::query($questionItems, array('qstnnr_id'=>$questionnaire['qstnnr_id'], 'faculty'=>$questionnaire['usr_id']));
    $questionItems = count($questionItems);

    $checkIfAnswered = "SELECT * FROM tbl_score WHERE qstnnr_id=:qstnnr_id and usr_id=:usr_id";
    $checkIfAnswered = DB::query($checkIfAnswered, array('qstnnr_id'=>$questionnaire['qstnnr_id'], 'usr_id'=>$_SESSION['loggedID'])); 
    $checkIfAnswered = count($checkIfAnswered);
    
?>
                    <div class="panel-footer"> 
        <?php  if($checkIfAnswered == 0){ ?>
                <?php if($questionItems > 0){ ?>
                            <a href="take.php?course=<?= $_GET['course']?>&&questionnaire=<?= $questionnaire['qstnnr_id'] ?>" class="btn btn-primary">
                                <?= ($studentProgress == $questionItems)? 'View and Submit': 'Take'?>
                            </a>
                <?php } ?>
        <?php }else{ ?>
                            <a class="btn btn-success" @click="showScore(<?= $questionnaire['qstnnr_id'] ?>)">
                                Show Score
                            </a>
        <?php } ?>
                        <span style="margin-left: 20px;">Progress: <?= $studentProgress ?> / <?= $questionItems ?> items</span>
                        <span style="float: right; margin-top: 5px;"><?= $questionnaire['created_at'] ?></span>
                    </div>  
                </div>  
            </div>
        </div>

<?php  }   } ?>
   

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ / CONTENT  -->
 
<!-- =================================================================================================================== /Modals  -->
</div>
<!-- /#index  --> 

            </div>
            <!-- /.container  -->   

<script> 
    var questionnaire = new Vue({
        el: "#questionnaire",
        data: {

        },
        methods: {
            showScore: function(id){
                axios.post("controller/questionnaire.controller.php", {
                    action: 'showScore',
                    qstnnr_id: id
                }).then(function(response){
                    alert(response.data);
                });
            }
        }
    });
</script>



<?php include 'includes/footer.php'; ?>