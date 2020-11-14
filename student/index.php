<?php include 'includes/header.php'; ?>
        <title>Welcome to SDSSU CANTILAN LMS</title> 
    </head>
    <body>
<?php 
    $studentsCourses = "SELECT * FROM tbl_course, tbl_studentcourse where tbl_course.crs_id =  tbl_studentcourse.crs_id and tbl_studentcourse.usr_id = :usr_id";
    $studentsCourses = DB::query($studentsCourses, array(':usr_id'=>$_SESSION['loggedID'])); 
    
?>


            <div class="container">
<?php include 'includes/navigation.php'; ?>
<div id="index">
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ CONTENT  -->

<div class="row">  
    <div class="col-sm-12 margin-b-20">   
        <h3>
            Enrolled Courses 
            <button 
                class="btn btn-primary" 
                @click="toggleShowAccess()"
                > + 
            </button>
        </h3>
    </div>
</div> 


    <div class="row">
<?php if(count($studentsCourses)>0){
        foreach($studentsCourses as $studentCourse){ ?> 
        <div class="col-sm-6">
            <div class="panel panel-default">  
            <div class="panel-body">  
                <center> 
                    <?php 
                        $getFaculty = "SELECT usr_id from tbl_course where crs_id = :crs_id";
                        $getFaculty = DB::query($getFaculty, array(':crs_id'=> $studentCourse['crs_id']));

                        $faculty = "SELECT * FROM tbl_user where usr_id = :faculty_id";
                        $faculty = DB::query($faculty, array(':faculty_id' => $getFaculty[0]['usr_id']));
                        echo "<img src='../". $faculty[0]['usr_profilepic'] ."' style='width: 30px'>";
                        echo "<p class='paragraph'>". $faculty[0]['usr_firstname'] . " ". $faculty[0]['usr_lastname'] ."</p>"; 
                    ?>
                    <b><?= $studentCourse['crs_descriptitle'] ?></b> 
                    <p class="paragraph"> <?= $studentCourse['crs_number'] ?></p>
                </center>
            </div> 
                <div class="panel-footer"><center><a href="course.php?course=<?= $studentCourse['crs_id'] ?>" class="btn btn-info">View Courses</a></center></div>   
            </div>
        </div> 
<?php }  }else{?>
    <div>
    <center>
       <h1>You have 0 courses</h1> 
    </center>
</div>
    </div>
    <!-- /row  -->
<?php } ?>
   
   
 
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ / CONTENT  -->

<!-- ======================================================================================== MODALS  -->
<template v-if="showAccess">  
            <div class="popup" tabindex="-1">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">

                <div class="modal-header">
                    <button 
                        type="button" 
                        class="close" 
                        @click="toggleShowAccess()"
                        > <span>&times;</span>
                    </button>
                    <h4 class="modal-title">Join Course</h4>
                </div>
                <!-- /.header  -->

                <div class="modal-body">   
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="">Access Code: </label>
                            <input 
                                type    = "text" 
                                class   = "form-control"
                                v-model = "accesscode"
                            />
                            <template v-if="accessError"> 
                                <p class="text-danger p-error"> {{ accessMessage }} </p>
                            </template>
                        </div>
                    </div>
                </div> 
                <!-- /. modal body  -->

                <div class="modal-footer">
                    <button 
                        type="button" 
                        class="btn btn-default btn-sm" 
                        @click="toggleShowAccess()"
                        >Close
                    </button> 
                    <button
                        type    = "button"
                        class   = "btn btn-primary btn-sm" 
                        @click  = "addCourse()"
                        > Add
                    </button>
                </div>
                <!-- /footer  -->

                </div>
              </div>
            </div> 
          <!-- /modal  -->  
</template> 
<!-- =================================================================================================================== /Modals  -->
</div>
<!-- /#index  --> 

            </div>
            <!-- /.container  -->   

<script>
    var body = new Vue({
        el: "#index",
        data: {
            showAccess: false,
            accesscode: '',
            accessError: false,
            accessMessage: ''
        },
        methods: {
            toggleShowAccess: function (){
                this.showAccess = !this.showAccess;
            },
            addCourse: function(){
                if(this.accesscode == ''){
                    this.accessError = true;
                    this.accessMessage = "Cannot Be Empty"
                }else{
                    axios.post("controller/index.controller.php", {
                        action: 'addCourse',
                        accesscode: this.accesscode
                    }).then(function(response){
                        if(response.data.error){ 
                            alert(response.data.message);
                        }else{
                            window.location.replace(response.data.link);
                        }
                        
                    });
                }
            }
        }
    });

</script>



<?php include 'includes/footer.php'; ?>