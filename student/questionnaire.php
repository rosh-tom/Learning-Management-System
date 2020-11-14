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
            <h2>Questionnaire</h2>
        </div>
    </div>

<?php 
    $fclty_id = "SELECT usr_id FROM tbl_course WHERE crs_id=:crs_id";
    $fclty_id = DB::query($fclty_id, array(':crs_id'=>$_GET['course']))[0]['usr_id'];

    $questionnaires = "SELECT * FROM tbl_questionnaire WHERE usr_id=:fclty_id and crs_id=:crs_id ORDER BY created_at DESC";
    $questionnairesData = [
        'fclty_id'  => $fclty_id,
        'crs_id'    => $_GET['course']
    ];
    $questionnaires = DB::query($questionnaires, $questionnairesData);
 
    foreach($questionnaires as $questionnaire){ 
?>
 
    <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default"> 
                    <div class="panel-heading">  
                        <p style="margin-bottom: -5px; "> <span class="qstnnr_title"><?= $questionnaire['qstnnr_title']?></p> 
                    </div> 

                    <div class="panel-body"> 
                        <p> - <?= $questionnaire['qstnnr_description']?></p>
                        <p> - <?= $questionnaire['qstnnr_type']?></p> 
                    </div>

                    <div class="panel-footer"> 
                        <a href="take.php?course=<?= $_GET['course']?>&&questionnaire=<?= $questionnaire['qstnnr_id'] ?>" class="btn btn-primary">Take</a>
                        <span style="margin-left: 20px;">Progress: 0/<?= $questionnaire['qstnnr_item'] ?> items</span>
                        <span style="float: right; margin-top: 5px;"><?= $questionnaire['created_at'] ?></span>
                    </div>  
                </div>  
            </div>
        </div>

<?php     } ?>
   

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ / CONTENT  -->
 
<!-- =================================================================================================================== /Modals  -->
</div>
<!-- /#index  --> 

            </div>
            <!-- /.container  -->   

<script> 

</script>



<?php include 'includes/footer.php'; ?>