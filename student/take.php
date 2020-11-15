<?php include 'includes/header.php'; ?>
        <title>Welcome to SDSSU CANTILAN LMS</title> 
    </head>
    <body>
<?php  
    $result_course = "SELECT * FROM tbl_course WHERE crs_id = :crs_id";
    $result_course = DB::query($result_course, array(':crs_id'=>$_GET['course']));  

    $questionnaireInfo = "SELECT * FROM tbl_questionnaire WHERE crs_id=:crs_id and qstnnr_id=:qstnnr_id";
    $questionnaireInfo = DB::query($questionnaireInfo, array(':crs_id'=>$_GET['course'], ':qstnnr_id'=>$_GET['questionnaire']));

?>

            <div class="container">
<?php include 'includes/navigation.php'; ?>
<!-- nav  -->
<div id="nav"> 
             <div class="buttons">
                <a href="questionnaire.php?course=<?= $_GET['course'] ?>" class="btn btn-info btn-sm"><b><</b> Back</a> 
                <button @click="toggleShowJumbo()" class="btn btn-warning btn-sm float-r">
                    <template v-if="showJumbo">
                        <img src="../icons/hide.svg" class="icon_visibility">
                    </template>
                    <template v-if="!showJumbo">
                        <img src="../icons/show.svg" class="icon_visibility">
                    </template> 
                </button>
            </div> 
            
            <template v-if="showJumbo">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="jumbotron" style="padding: 5px;">
                            <h2><?= $result_course[0]['crs_descriptitle'] ?></h2> 
                            <h4><?= $result_course[0]['crs_number']?></h4>
                        </div>
                    </div>  
                </div> 
            </template>  
</div>
 
<script>
    var nav = new Vue({
        el: "#nav",
        data: {  
            showJumbo: true
        },
        methods: {
            toggleShowJumbo: function(){
                this.showJumbo = !this.showJumbo;
            },
        }
    });
</script>
<!-- /#nav  -->

<div id="index">
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ CONTENT  -->
    <div class="row">  
        <div class="col-sm-12">   
            <label for=""><?= $questionnaireInfo[0]['qstnnr_title'] ?></label>
            <p class="paragraph"><b>Instruction: </b> <?= $questionnaireInfo[0]['qstnnr_description'] ?></p>
        </div>
    </div>
<?php 
    $questions = "SELECT * FROM tbl_question WHERE crs_id=:crs_id and qstnnr_id=:qstnnr_id";
    $questionsData = [
        'crs_id'=> $_GET['course'],
        'qstnnr_id'=> $_GET['questionnaire']
    ];
    $questions = DB::query($questions, $questionsData);

    $row = count($questions);
    $itemNumber = 1;
?>
    <div class="row">  
        <div class="col-sm-12 margin-b-20">   
            <h3>Questions</h3>
        </div>
    </div>
 
<?php foreach($questions as $question){ ?>
    <div class="row">  
        <div class="col-sm-12">  
            <div class="well well-sm">
                <p> <?= $itemNumber++ ?>. <?= $question['qstn_question'] ?> </p> 
<?php 
    $recoverAnswer = "SELECT answer FROM tbl_answer where qstn_id=:qstn_id";
    $recoverAnswer = DB::query($recoverAnswer, array(':qstn_id'=>$question['qstn_id'])); 
    if(count($recoverAnswer) > 0){ 
        $countRecoverAnswer = 1;
        $recoverAnswer = $recoverAnswer[0]['answer'];
    }else{
        $countRecoverAnswer = 0; 
    }
?>

                <div style="margin-left: 10px;">
                    <div class="radio">
                        <label>
                            <input 
                                type="radio" 
                                name="<?= $question['qstn_id'] ?>"
                                @click="choose(<?= $question['qstn_id'] ?>, 'a')"
                            <?php if($countRecoverAnswer > 0){ ?>
                                    <?= ($recoverAnswer == 'a')? 'checked':'' ?>
                            <?php } ?>
                                >A. <?= $question['a'] ?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio"
                            name="<?= $question['qstn_id'] ?>"
                            @click="choose(<?= $question['qstn_id'] ?>, 'b')"
                        <?php if($countRecoverAnswer > 0){ ?>
                            <?= ($recoverAnswer == 'b')? 'checked':'' ?>
                        <?php } ?>
                            >B. <?= $question['b'] ?> 
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" 
                            name="<?= $question['qstn_id'] ?>" 
                            @click="choose(<?= $question['qstn_id'] ?>, 'c')"
                        <?php if($countRecoverAnswer > 0){ ?>
                            <?= ($recoverAnswer == 'c')? 'checked':'' ?>
                        <?php } ?>
                            >C. <?= $question['c'] ?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" 
                            name="<?= $question['qstn_id'] ?>" 
                            @click="choose(<?= $question['qstn_id'] ?>, 'd')"
                        <?php if($countRecoverAnswer > 0){ ?>
                            <?= ($recoverAnswer == 'd')? 'checked':'' ?>
                        <?php } ?>
                            >D. <?= $question['d'] ?>
                        </label>
                    </div> 
                </div> 
                <!-- /radio  -->
            </div>
        </div> 
    </div> 
<?php } ?>
   
<div class="row">
    <div class="col-sm-12">
        <div class="well well-sm">
            <button 
                class ="btn btn-primary"
                @click ="submitQuestionnaire()"
                >Submit</button>
        </div>
    </div>
</div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ / CONTENT  -->
 
<!-- =================================================================================================================== /Modals  -->
</div>

<!-- /#index  --> 

            </div>
            <!-- /.container  -->   

<script>
    var index = new Vue({
        el: "#index",
        data: {

        },
        methods: {
            choose: function (id, answer){
                axios.post("controller/take.controller.php", {
                    action: 'choose',
                    qstn_id: id,
                    std_answer: answer,
                    qstnnr_id: <?= $_GET['questionnaire']?>,
                    crs_id: <?= $_GET['course']?>
                });
            },
            submitQuestionnaire: function(){
                axios.post("controller/take.controller.php",{
                    action: 'submitQuestionnaire',
                    crs_id: <?= $_GET['course'] ?>,
                    qstnnr_id: <?= $_GET['questionnaire'] ?>
                }).then(function(response){
                    if(!response.data){ 
                        alert("Please answer all the items");
                    }else{ 
                        window.location.replace("questionnaire.php?course=<?= $_GET['course'] ?>");
                    }
                });
            }
        }
    });

</script> 

<?php include 'includes/footer.php'; ?>