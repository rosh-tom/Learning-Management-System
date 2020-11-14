<?php include 'includes/header.php'; ?>
        <title>Welcome to SDSSU CANTILAN LMS</title> 
    </head>
    <body>
<?php  
    $result_course = "SELECT * FROM tbl_course WHERE crs_id = :crs_id";
    $result_course = DB::query($result_course, array(':crs_id'=>$_GET['course']));  

?>

            <div class="container">
<?php include 'includes/navigation.php'; ?>
<div id="index">
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ CONTENT  -->
<?php include 'includes/nav.php'; ?>
 
    <div class="row">  
        <div class="col-sm-12 margin-b-20">   
            <h2>Posts</h2>
        </div>
    </div>

    <!-- row for posts  --> 
    <div class="row"> 
<?php 
         $getFaculty = "SELECT usr_id from tbl_course where crs_id = :crs_id";
         $getFaculty = DB::query($getFaculty, array(':crs_id'=> $_GET['course']))[0]['usr_id'];

        $posts = "SELECT * FROM tbl_post WHERE usr_id=:fclty_id and crs_id=:crs_id ORDER BY created_at DESC";
        $postsData = [
                'fclty_id'  =>$getFaculty,
                'crs_id'    => $_GET['course']
        ];
        $posts = DB::query($posts, $postsData);
        
        foreach($posts as $post){
             
?>
        <div class="col-sm-12">
                <div class="panel panel-default"> 
                    <div class="panel-heading">
                        <small><?= $post['created_at'] ?></small>

                        <br><br>
                        <p><b><?= $post['pst_title'] ?></b></p>
                        <p><?= $post['pst_description'] ?></p>
                    </div>
                    
<?php if($post['pst_type'] == 'video'){ ?>
                <div class="panel-body">
                    <center>
                        <video width="80%"controls>
                                <source src="../<?= $post['pst_location'] ?>" type="video/mp4">
                        </video>
                    </center>
                </div>
<?php } ?>
<?php if($post['pst_type'] == 'application'){ ?>
                <div class="panel-body">
                    <center><h4>Document</h4></center>
                <h3><a href="../<?= $post['pst_location'] ?>"><img src="../icons/document.svg" alt="" width="10%"></a> <?= $post['pst_filename'] ?></h3>
                </div>
<?php } ?>
<?php if($post['pst_type'] == 'image'){ ?>
                <div class="panel-body"> 
                    <center>
                        <img src="../<?= $post['pst_location'] ?>" width="50%" alt=""> 
                    </center>
                </div>
<?php } ?> 
      
                    <div class="panel-footer">
                    <a target="_blank" href="managepost.php?course=6&&post=5" class="btn btn-info btn-sm">View Post</a> 
                </div>   
                </div>
            </div> 
<?php } ?>
    </div>
 
   

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ / CONTENT  -->
 
<!-- =================================================================================================================== /Modals  -->
</div>
<!-- /#index  --> 

            </div>
            <!-- /.container  -->   

<script>
    

</script>



<?php include 'includes/footer.php'; ?>