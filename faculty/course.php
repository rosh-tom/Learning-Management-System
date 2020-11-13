<?php include 'includes/header.php';

include '../classes/db.php'; 

$results = "SELECT * FROM tbl_course where usr_id = :usr_id ORDER BY created_at DESC";
$results = DB::query($results, array(':usr_id' => $_SESSION['loggedID'])); 
  
 ?>
        <title>Courses - SDSSU CANTILAN LMS</title> 
    </head>
    <body> 
            <div class="container">
<?php include 'includes/navigation.php'; ?>

<div id="index"> 
            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++ content  --> 
            <a href="index.php" class="btn btn-info btn-sm"><b><</b> Back</a>
            <h1>Courses <button class="btn btn-primary" @click="toggleShowAddNewCourse()"> Add + </button></h1>

            <?php if(isset($_SESSION['temp'])){ ?>
                <div class="alert <?= ($_SESSION['temp']['type'] == 'success') ? 'alert-success': 'alert-danger'?>" role="alert">
                    <?= $_SESSION['temp']['message'] ?>
                </div>
            <?php } ?>
            <hr class="hr-style">
<?php foreach($results as $result){  ?> 
            <center>
                <div class="col-sm-6">
                    <div class="panel panel-info">  
                        <div class="panel-body">
                            <h2><?= $result['crs_descriptitle'] ?></h2> 
                            <p  class="paragrah"><?= ": ". $result['crs_number'] ." :" ?></p> 
                            <p  class="paragrah"><?= ": ".$result['crs_section'] ." : "?></p> 
                            <p  class="paragrah"><?= ": ".$result['crs_time']. " ". $result['crs_days']." : "?></p> 
                        </div>
                        <div class="panel-heading">
                            <a href="managecourse.php?course=<?= $result['crs_id'] ?>" class="btn btn-default"> Manage </a> 
                        </div>       
                     </div>
                </div>    
            </center> 
                <!-- /col-sm-6  -->
<?php  }  ?>
            <!-- ============================================================ Add Modal  -->
            

            <form action="controller/course.controller.php" method="post">
            <template v-if="showAddNewCourse">  
            <div class="popup" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" @click="toggleShowAddNewCourse()"><span>&times;</span></button>
                  <h4 class="modal-title">Add New Course</h4>
                </div>
                <div class="modal-body">  
                  <div class="row"> 
                      <div class="col-sm-6">
                        <div class="form-group"> 
                          <label>Course Number</label>
                          <input type="text" class="form-control" name="crs_number">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group"> 
                          <label>Course Section</label>
                          <input type="text" class="form-control" name="crs_section">
                        </div>
                      </div> 
                  </div>

                    <div class="row"> 
                        <div class="col-sm-12">
                          <div class="form-group"> 
                            <label>Descriptive Title</label>
                            <input type="text" class="form-control" name="crs_descriptitle">
                          </div>
                        </div> 
                    </div>

                    <div class="row"> 
                        <div class="col-sm-6">
                          <div class="form-group"> 
                            <label>Time</label>
                            <input type="text" class="form-control" name="crs_time">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group"> 
                            <label>Days</label>
                            <input type="text" class="form-control" name="crs_days">
                          </div>
                        </div> 
                    </div> 
                </div> 
                <!-- /. modal body  -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" @click="toggleShowAddNewCourse()">Close</button>
                    <input type="submit" class="btn btn-primary btn-sm" name="btn_saveCourse" value="Save">
                    </div> 
                
                <!-- /footer  -->
                </div>
              </div>
            </div>
          </template>
          <!-- /end add modal  -->
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
            showAddNewCourse: false, 
        },
        methods: {
            toggleShowAddNewCourse: function(){
                this.showAddNewCourse = !this.showAddNewCourse;
            }
        }
    });
</script>

<?php include 'includes/footer.php'; ?>
<?php unset($_SESSION['temp']) ?>