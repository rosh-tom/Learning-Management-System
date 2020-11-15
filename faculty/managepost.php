<?php include 'includes/header.php';

include '../classes/db.php';  
$data = [
    'pst_id' => $_GET['post'],
    'crs_id'=> $_GET['course'],
    'usr_id' => $_SESSION['loggedID']
];

$result_course = "SELECT * FROM tbl_course WHERE crs_id = :crs_id AND usr_id = :usr_id";
$result_course = DB::query($result_course, array(':crs_id'=>$data['crs_id'], ':usr_id'=>$data['usr_id'])); 

$result_post = "SELECT * FROM tbl_post WHERE pst_id = :pst_id";
$result_post = DB::query($result_post, array(':pst_id'=>$data['pst_id']));

 ?>
        <title>Manage Post - SDSSU CANTILAN LMS</title> 
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
            <a href="managecourse.php?course=<?=$data['crs_id']?>" class="btn btn-info btn-sm"><b><</b> Back</a> 
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


<?php echo print_r($result_post) ?>
 
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
                    <input type="hidden" name="crs_id" value="<?= $crs_id ?>">
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


