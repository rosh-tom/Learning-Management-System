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


