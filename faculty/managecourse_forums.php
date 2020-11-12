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
                <li><a href="managecourse.php?course=<?= $crs_id ?>">Home</a></li> 
                    <li><a href="managecourse.php?course=<?= $crs_id ?>"> Questionnaire </a></li>
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


            
</div>
<!-- / #index  -->
            </div>
            <!-- /.container  -->    
<script>
    var app = new Vue({
        el: "#index",
        data: {
             showJumbo: false, 
        },
        methods: {
            toggleShowJumbo: function(){
                this.showJumbo = !this.showJumbo;
            }
        }
    });
</script>

<?php include 'includes/footer.php'; ?> 