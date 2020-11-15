<?php include 'includes/header.php';

include '../classes/db.php'; 
 
$data = [
    'crs_id'=> $_GET['course'], 
    'usr_id'=> $_SESSION['loggedID']
];

$result_course = "SELECT * FROM tbl_course WHERE crs_id = :crs_id and usr_id = :usr_id";
$result_course = DB::query($result_course, $data); 

$results_post = "SELECT * FROM tbl_post WHERE crs_id = :crs_id and usr_id = :usr_id ORDER BY created_at DESC";
$results_post = DB::query($results_post, $data);

 
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
                        <h1><?= $result_course[0]['crs_descriptitle'] ?></h1> 
                        <h4><?= $result_course[0]['crs_number']?></h4>
                    </div>
                </div>  
            </div> 
        </template>

        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li  class="active">Home </li>
                    <li><a href="managecourse_questionnaire.php?course=<?= $data['crs_id'] ?>">Questionnaire</a></li>
                    <li><a href="managecourse_forums.php?course=<?= $data['crs_id'] ?>">Forums</a></li>
                    <li><a href="managecourse_students.php?course=<?= $data['crs_id'] ?>">Students</a></li>
                </ol>
            </div>
        </div>
 
    <div class="row">  
        <div class="col-sm-12 margin-b-20">   
            <h2>Posts <button class="btn btn-primary btn-sm" @click="toggleshowAddPost()"> Add + </button></h2>
        </div>
    </div>
<?php foreach($results_post as $result){ ?>
        <div class="col-sm-12">
            <div class="panel panel-default"> 
                <div class="panel-heading">
                     <small><?= $result['created_at'] ?></small>

                    <br><br>
                    <p><b><?= $result['pst_title'] ?></b></p>
                    <p><?= $result['pst_description'] ?></p>
                </div>
<?php if($result['pst_type'] == 'video'){ ?>
                <div class="panel-body">
                    <center>
                        <video width="80%"controls>
                                <source src="../<?= $result['pst_location'] ?>" type="video/mp4">
                        </video>
                    </center>
                </div>
<?php } ?>
<?php if($result['pst_type'] == 'application'){ ?>
                <div class="panel-body">
                    <center><h4>Document</h4></center>
                <h3><a href="../<?= $result['pst_location'] ?>"><img src="../icons/document.svg" alt="" width="10%"></a><?= $result['pst_filename'] ?></h3>
                </div>
<?php } ?>
<?php if($result['pst_type'] == 'image'){ ?>
                <div class="panel-body"> 
                    <center>
                        <img src="../<?= $result['pst_location'] ?>" width="50%" alt=""> 
                    </center>
                </div>
<?php } ?>

                <div class="panel-footer">
                <a target="_blank" href="managepost.php?course=<?= $data['crs_id'] ?>&&post=<?=$result['pst_id']?>" class="btn btn-info btn-sm">View Post</a> 
              </div>   
            </div>
        </div> 
<?php } ?>

<?php if(count($results_post) == 0){
    echo "empty";
} ?>



 <!-- ================================================= Modal  -->
    <!-- modal --> 
<form autocomplete="off" method="post" action="controller/course.controller.php" enctype="multipart/form-data">  
    <template v-if="showAddPost">  
            <div class="popup" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" @click="toggleshowAddPost()"><span>&times;</span></button>
                  <h4 class="modal-title">Post</h4>
                </div>
                <div class="modal-body">   
                    <input type="hidden" name="crs_id" value="<?= $data['crs_id'] ?>">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group"> 
                                <label>Upload</label>
                                <input type="file" class="form-control" name="uploaded_file" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf, video/*, image/*">
                            </div>
                        </div>
                    </div> 
                  <div class="row"> 
                      <div class="col-sm-12">
                        <div class="form-group"> 
                          <label>Title</label>
                          <input type="text" class="form-control" name="pst_title">
                        </div>
                      </div>

                      <div class="col-sm-12">
                        <div class="form-group"> 
                          <label for="email">Post Description</label> 
                          <textarea name="pst_description" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                      </div> 
                  </div> 
                </div> 
                <!-- /. modal body  -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-sm" @click="toggleshowAddPost()">Close</button>
                  <input type="submit" class="btn btn-primary btn-sm" value="Save" name="btn_savePost">
                </div>
                <!-- /footer  -->
                </div>
              </div>
            </div>
          </template>
          <!-- /modal  -->  
</form> 



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
             showAddPost: false
        },
        methods: {
            toggleShowJumbo: function(){
                this.showJumbo = !this.showJumbo;
            },
            toggleshowAddPost: function(){
                this.showAddPost = !this.showAddPost;
            }
        }
    });
</script>

<?php include 'includes/footer.php'; ?> 


