<?php include 'includes/header.php';

include '../classes/db.php'; 
 
$data = [
    'crs_id'=> $_GET['course'],
    'usr_id' => $_SESSION['loggedID']
];

$result_course = "SELECT * FROM tbl_course WHERE crs_id = :crs_id AND usr_id = :usr_id";
$result_course = DB::query($result_course, $data);  

$data['qstnnr_id'] = $_GET['questionnaire']; 

$result_qstnnr = "SELECT * FROM tbl_questionnaire WHERE qstnnr_id = :qstnnr_id";
$result_qstnnr = DB::query($result_qstnnr, array(':qstnnr_id'=>$data['qstnnr_id']));

 ?>
        <title>Manage Course - SDSSU CANTILAN LMS</title> 
        <style>
            a:hover{
                cursor: pointer;
            }
        </style>
    </head>
    <body> 
            <div class="container">
<?php include 'includes/navigation.php'; ?>

<div id="index">  
        <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++ content  --> 
        <div class="buttons">
            <a href="managecourse_questionnaire.php?course=<?= $data['crs_id'] ?>" class="btn btn-info btn-sm"><b><</b> Back</a> 
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
                        <h1><?= $result_course[0]['crs_descriptitle'] ?></h1> 
                        <h4><?= $result_course[0]['crs_number']?></h4>
                    </div>
                </div>  
            </div> 
        </template>

    <div class="row" style="margin-bottom: -20px; margin-top: -10px">   
        <center>
            <h3><?= $result_qstnnr[0]['qstnnr_title'] ?></h3>
            <p class="mrgn-b-2px"><?= $result_qstnnr[0]['qstnnr_description']?></p>
            <p class="mrgn-b-2px"><?= $result_qstnnr[0]['qstnnr_type']?></p>
            <p class="mrgn-b-2px"><?= $result_qstnnr[0]['qstnnr_item']?> Items</p> 
        </center> 
    </div> 
         
    <div class="row">  
        <div class="col-sm-12 margin-b-20">   
            <h3>Questions <button class="btn btn-primary btn-sm" @click="toggleShowAddQuestion()"> Add + </button> </h3>
        </div>
    </div>   

<template v-for="(question, index) in questions"> 
    <div class="row">  
        <div class="col-sm-12">  
            <div class="well well-sm">
                <p> {{qstn_length-index}}. {{ question.qstn_question }} </p>
                <p style="margin-top: -5px; margin-left: 20px; margin-bottom: 2px;">A. {{question.a}}</p> 
                <p style="margin-top: -5px; margin-left: 20px; margin-bottom: 2px;">B. {{question.b}}</p> 
                <p style="margin-top: -5px; margin-left: 20px; margin-bottom: 2px;">C. {{question.c}}</p> 
                <p style="margin-top: -5px; margin-left: 20px; margin-bottom: 2px;">D. {{question.d}}</p> 

                <button class="hover-primary" @click="viewAnswer(question.qstn_id)">View Answer</button> 
                <button class="hover-success">Edit</button> 
                <button class="hover-danger" @click="deleteQuestion(question.qstn_id, qstn_length-index)">Delete</button>

            </div>
        <div> 
    </div> 
</template>
<!-- /v-for  -->

 <!-- ================================================= Modal  -->
    <!-- modal --> 
<template v-if="showAddQuestion">  
        
    <form autocomplete="off">  
            <div class="popup" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" @click="toggleShowAddQuestion()"><span>&times;</span></button>
                        <h4 class="modal-title">Create Question</h4>
                    </div>

                    <div class="modal-body">   
                        <input type="hidden" name="crs_id" v-model="v_crs_id">  
                        <input type="hidden" name="qstnnr_id" v-model="v_qstnnr_id">    
    
<template v-if="qstn_length != full_qstn_length">
                <div class="row"> 
                      <div class="col-sm-12">
                        <div class="form-group"> 
                          <label># :  {{qstn_length+1}}</label> 
                        </div>
                      </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group"> 
                            <label for="email">Question</label> 
                            <textarea name="pst_description" cols="30" rows="4" class="form-control" v-model="qstn_question"></textarea> 
                        </div> 
                    </div> 
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">   
                            <input type="text" class="form-control" placeholder="A." v-model="a">
                        </div> 
                    </div> 
                </div> 

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">   
                            <input type="text" class="form-control" placeholder="B." v-model="b">
                        </div> 
                    </div> 
                </div> 

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">   
                            <input type="text" class="form-control"  placeholder="C." v-model="c">
                        </div> 
                    </div> 
                </div> 

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">   
                            <input type="text" class="form-control"  placeholder="D." v-model="d">
                        </div> 
                    </div> 
                </div> 

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group"> 
                            <label>Answer</label> 
                            <select name="" class="form-control" v-model="qstn_answer">
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                            </select>
                        </div> 
                    </div> 
                </div> 
</template>  

<template v-if="qstn_length == full_qstn_length"> 
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group"> 
                                <label>You have reached the maximum number of questions.</label>  
                            </div> 
                        </div> 
                    </div>
</template>
 
                </div>
                <!-- /. modal body  -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" @click="toggleShowAddQuestion()">Close</button>
                        <span v-if="qstn_length < full_qstn_length"><button type="button" class="btn btn-primary btn-sm" @click="toggleSaveQuestion()">Save</button></span>
                    </div>
                    <!-- /footer  -->
                </div>
            </div>
        </div>
        </form> 
</template>
          <!-- /modal  -->  

        <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++/content  -->  
            
</div>
<!-- / #index  -->
            </div>
            <!-- /.container  -->    
<script>
    var app = new Vue({
        el: "#index",
        data: {
             showJumbo: true, 
             showAddQuestion: false,
             qstn_question: '',
             a: '',
             b: '',
             c: '',
             d: '',
             qstn_answer: 'a',
             v_crs_id: <?= $data['crs_id'] ?>,
             v_qstnnr_id: <?= $data['qstnnr_id'] ?>,
             questions: '',
             qstn_length: '',
             full_qstn_length: <?= $result_qstnnr[0]['qstnnr_item']?>
        },
        methods: {
            toggleShowJumbo: function(){
                this.showJumbo = !this.showJumbo;
            },
            toggleShowAddQuestion: function(){
                this.showAddQuestion = !this.showAddQuestion;
            },
            toggleSaveQuestion: function(){
                axios.post("controller/question.controller.php", {
                    action: 'saveQuestion',
                    qstn_question: this.qstn_question,
                    a: this.a,
                    b: this.b,
                    c: this.c,
                    d: this.d,
                    crs_id: this.v_crs_id,
                    qstnnr_id: this.v_qstnnr_id,
                    qstn_answer: this.qstn_answer   
                }).then(function(response){
                    if(response.data){
                        alert("New Question Added");
                        app.qstn_question = this.qstn_question,
                        app.a = this.a,
                        app.b = this.b,
                        app.c = this.c,
                        app.d = this.d,
                        app.qstn_answer = 'a'  
                        app.fetchAllQuestion()
                    }else{
                        alert(response.data);
                    }
                });
            },
            fetchAllQuestion: function(){
                axios.post("controller/question.controller.php", {
                    action: 'fetchAllQuestion',
                    crs_id: <?= $data['crs_id'] ?>,
                    qstnnr_id: <?= $data['qstnnr_id'] ?>
                }).then(function(response){
                     app.questions = response.data;
                     app.qstn_length = app.questions.length
                });
            },
            viewAnswer: function(id){
                axios.post("controller/question.controller.php", {
                    action: 'viewAnswer',
                    qstn_id: id
                }).then(function(response){
                    alert("Correct Answer : "+ response.data);
                });
            },
            deleteQuestion: function(id, number){
                if(confirm("Are you sure you want to delete Question Number "+ number +" ?")){
                    axios.post("controller/question.controller.php", {
                        action: 'deleteQuestion',
                        qstn_id: id
                    }).then(function(response){
                        app.fetchAllQuestion();
                    });
                } 
            }
        },
        created: function(){
            this.fetchAllQuestion();
        }
    });
</script>

<?php include 'includes/footer.php'; ?> 


