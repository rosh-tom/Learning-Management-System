<?php include 'includes/header.php';

include '../classes/db.php'; 
$data = [
    'usr_id' => $_SESSION['loggedID'],
    'crs_id' => $_GET['course']
];
$result = "SELECT * FROM tbl_course WHERE  usr_id = :usr_id and crs_id = :crs_id";
$result = DB::query($result, $data); 

$results_qstnnr = "SELECT * FROM tbl_questionnaire WHERE usr_id = :usr_id and crs_id = :crs_id ORDER BY created_at DESC";
$results_qstnnr = DB::query($results_qstnnr, $data);


 
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
           </div>
        

        <template v-if="showJumbo">
            <div class="row">
                <div class="col-sm-12">
                    <div class="jumbotron">
                        <h1><?= $result[0]['crs_descriptitle'] ?></h1> 
                        <h4><?= $result[0]['crs_number']?></h4>
                    </div>
                </div>  
            </div> 
        </template>

        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li><a href="managecourse.php?course=<?= $data['crs_id'] ?>">Home</a></li> 
                    <li class="active"> Questionnaire </li>
                    <li><a href="managecourse_forums.php?course=<?= $data['crs_id'] ?>">Forums</a></li>
                    <li><a href="managecourse_students.php?course=<?= $data['crs_id'] ?>"> Students </a></li>
                </ol>
            </div>
        </div>
 
        <div class="row">  
            <div class="col-sm-12 margin-b-20">   
                <h2>Questionnaire <button class="btn btn-primary btn-sm" @click="toggleShowAddQstnnr()"> Add + </button></h2>
            </div>
        </div>

<?php if(isset($_SESSION['temp'])){ ?>
        <div class="alert <?= ($_SESSION['temp']['success'])? 'alert-success': 'alert-danger' ?>" role="alert">
                <?= $_SESSION['temp']['message'] ?>
        </div>
<?php } ?>

<?php foreach($results_qstnnr as $result){ ?> 
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default"> 
                    <div class="panel-heading">  
                        <p style="margin-bottom: -5px; "> <span class="qstnnr_title"><?= $result['qstnnr_title'] ?></p>
                        <div class="qstnnr_manage"> 
                            <button class="btn btn-success btn-sm"> Manage </button>
                        </div>
                    </div> 

                    <div class="panel-body"> 
                        <p><?= " - ". $result['qstnnr_description'] ?></p>
                        <p><?= " - ". $result['qstnnr_type'] ?></p>
                        <p><?= "- Item/s : ". $result['qstnnr_item'] ?></p>
                    </div>

                    <div class="panel-footer"> 
                        <a href="questionnaire_question.php?course=<?= $data['crs_id'] ?>&&questionnaire=<?= $result['qstnnr_id'] ?>" class="btn btn-primary"> Questionnaires </a>
                    </div>  
                </div>  
            </div>
        </div>
<?php } ?>
 
        <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++/content  --> 


            
 <!-- ================================================= Modal  -->
    <!-- modal --> 
<form autocomplete="off" method="post" action="controller/course.controller.php">  
    <template v-if="showAddQstnnr">  
            <div class="popup" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" @click="toggleShowAddQstnnr()"><span>&times;</span></button>
                  <h4 class="modal-title">Create Questionnaire</h4>
                </div>
                <div class="modal-body">   
                    <input type="hidden" name="crs_id" value="<?= $data['crs_id'] ?>">
                     
                <div class="row"> 
                    <div class="col-sm-12">
                        <div class="form-group"> 
                            <label>Title</label>
                            <input type="text" class="form-control" name="qstnnr_title">
                        </div>
                    </div>
                </div> 

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group"> 
                            <label for="email">Post Description</label> 
                            <textarea name="qstnnr_description" cols="30" rows="3" class="form-control"></textarea> 
                        </div> 
                    </div> 
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group"> 
                            <label>Type</label> 
                            <select name="qstnnr_type" class="form-control">
                                <option>Multiple Choice</option>
                            </select>
                        </div> 
                    </div>  
                    <div class="col-sm-6">
                        <div class="form-group"> 
                            <label>Items</label> 
                            <input type="number" class="form-control" name="qstnnr_item">
                        </div> 
                    </div> 
                </div>
                
                <!-- /. modal body  -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-sm" @click="toggleShowAddQstnnr()">Close</button>
                  <input type="submit" class="btn btn-primary btn-sm" value="Save" name="btn_saveQstnnr">
                </div>
                <!-- /footer  -->
                </div>
              </div>
            </div>
          </template>
          <!-- /modal  -->  
</form> 

            
</div>
<!-- / #index  -->
            </div>
            <!-- /.container  -->    
<script>
    var app = new Vue({
        el: "#index",
        data: {
             showJumbo: false, 
             showAddQstnnr: false
        },
        methods: {
            toggleShowJumbo: function(){
                this.showJumbo = !this.showJumbo;
            },
            toggleShowAddQstnnr: function(){
                this.showAddQstnnr = !this.showAddQstnnr;
            }
        }
    });
</script>

<?php include 'includes/footer.php'; ?> 
<?php unset($_SESSION['temp']) ?>