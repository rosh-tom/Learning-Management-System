<?php include 'includes/header.php';

include '../classes/db.php'; 
$crs_id = $_GET['course'];
$result = "SELECT * FROM tbl_course WHERE crs_id = :crs_id AND usr_id = :usr_id";
$result = DB::query($result, array(':crs_id'=>$crs_id, ':usr_id' => $_SESSION['loggedID'])); 
 
 ?>
        <title>Questionnaire - SDSSU CANTILAN LMS</title> 
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
            <a href="course.php" class="btn btn-info btn-sm"><b><</b> Back</a> 
            <button @click="toggleShowJumbo()" class="btn btn-warning btn-sm float-r">
                <template v-if="showJumbo">
                    <img src="../icons/hide.svg" class="icon_visibility">
                </template>
                <template v-if="!showJumbo">
                    <img src="../icons/show.svg" class="icon_visibility">
                </template> 
            </button>
            <button @click="toggleShowJumbo()" class="btn btn-success btn-sm float-r margin-r-20">Manage
            </button>
        </div>
        

        <template v-if="showJumbo">
            <div class="row">
                <div class="col-sm-12">
                    <div class="jumbotron" style="padding: 5px;">
                        <h1><?= $result[0]['crs_descriptitle'] ?></h1> 
                        <h4><?= $result[0]['crs_number']?></h4>
                    </div>
                </div>  
            </div> 
        </template>

        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                <li><a href="managecourse.php?course=<?= $crs_id ?>">Home</a></li> 
                    <li><a href="managecourse_questionnaire.php?course=<?= $crs_id ?>"> Questionnaire </a></li>
                    <li class="active">Forums</li>
                    <li><a href="managecourse_students.php?course=<?= $crs_id ?>"> Students </a></li>
                </ol>
            </div>
        </div>
 
    <div class="row">  
        <div class="col-sm-12 margin-b-20">   
            <h2>Forums</h2>
        </div>
    </div>
 
 
        <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++/content  --> 
        <div class="row"> 
            <div class="panel panel-default">


            <div class="panel-footer"> 
            <div class="input-group"> 
                <textarea class="form-control" cols="3" rows="1" style="resize: none;" v-model="v_message" v-on:keyup.enter="sendMessage()"></textarea> 
      <span class="input-group-btn">
        <button class="btn btn-primary" type="button" @click="sendMessage()">Send</button>
      </span>
    </div><!-- /input-group -->
            </div>


            
                 <div class="panel-body" style="height: 700px; overflow-y:scroll;">  
                  <div v-for="message in messages"> 
                        <template v-if="message.usr_id == <?= $_SESSION['loggedID'] ?>">
                            <div class="well well-sm" style="background-color: #428bca; color: white; margin: 10px;"> 
                                <p style="padding-left: 5px">{{message.msg}}</p> 
                                <small>{{message.created_at}}</small> 
                            </div> 
                        </template> 

                        <template v-else> 
                            <div class="well well-sm">
                                <p style="margin-bottom: -5px; padding: -2px;">
                                    <img class="myimg" v-bind:src="'../' + message.usr_profilepic" ><b>{{message.usr_firstname}} {{message.usr_lastname}}</b></p> 
                                    <small>{{ message.created_at }}</small></p> 
                                <p style="padding-left: 5px">{{ message.msg }}</p> 
                            </div> 
                        </template> 
                  </div>

                </div>
        
        </div>
        
      <!-- / row  --> 
        <!-- ======================================================================= -->


            
</div>
<!-- / #index  -->
            </div>
            <!-- /.container  -->    
<script>
    var app = new Vue({
        el: "#index",
        data: {
             showJumbo: true, 
             v_message: '',
             messages: ''
        },
        methods: {
            toggleShowJumbo: function(){
                this.showJumbo = !this.showJumbo;
            },
            sendMessage: function(){
                axios.post("controller/forums.controller.php", {
                    action: 'sendMessage',
                    message: this.v_message,
                    crs_id: <?= $crs_id ?>
                }).then(function(response){ 
                    app.clear(); 
                    app.fetchMessage();
                });
            },
            clear: function(){
                this.v_message = '';
            },
            fetchMessage: function(){
                axios.post("controller/forums.controller.php", {
                    action: 'fetchMessage', 
                    crs_id: <?= $crs_id ?>
                }).then(function(response){  
                    app.messages = response.data;
                });
            }
        },
        created: function (){
            this.fetchMessage();
        }
    });

    var timerID = setInterval(app.fetchMessage, 1000);
    app.fetchMessage();
</script>

<?php include 'includes/footer.php'; ?> 