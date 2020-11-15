<?php include 'includes/header.php';

include '../classes/db.php'; 
 
$data = [
    'usr_id' => $_SESSION['loggedID'],
    'crs_id' => $_GET['course'],
]; 
$result = "SELECT * FROM tbl_course WHERE  usr_id = :usr_id and crs_id = :crs_id";
$result = DB::query($result, $data); 

$data['qstnnr_id'] = $_GET['questionnaire'];
 
$questionnaire = "SELECT * FROM tbl_questionnaire WHERE usr_id = :usr_id and crs_id = :crs_id and qstnnr_id =:qstnnr_id";
$questionnaire = DB::query($questionnaire, $data); 

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

        <div class="buttons">
            <a href="managecourse_questionnaire.php?course=<?= $data['crs_id'] ?>" class="btn btn-info btn-sm"><b><</b> Back</a> 
            
           </div>
        
 
      <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++ content  --> 
    
              
<form action="controller/editquestionnaire.controller.php" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><h4>Edit <b><?= $questionnaire[0]['qstnnr_title'] ?></b></h4></h3>
                </div>
                <div class="panel-body"> 
                    <input type="hidden" name="crs_id" value="<?= $data['crs_id']?>"> 
                    <input type="hidden" name="qstnnr_id" value="<?= $data['qstnnr_id']?>"> 
                  
                    <div class="row"> 
                        <div class="col-sm-12">
                            <div class="form-group"> 
                                <label>Title</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="qstnnr_title" 
                                    value="<?= $questionnaire[0]['qstnnr_title'] ?>"
                                />
                            </div>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group"> 
                                <label for="email">Instruction / Description</label> 
                                <textarea 
                                    name="qstnnr_description" 
                                    cols="30" 
                                    rows="3" 
                                    class="form-control"
                                    ><?= $questionnaire[0]['qstnnr_description'] ?></textarea> 
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
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    name="qstnnr_item" 
                                    value="<?= $questionnaire[0]['qstnnr_item']?>"
                                    >
                            </div>  
                        </div> 
                    </div> 
                </div>
                <div class="panel-footer"> 
                        <input type="submit" value="Update" class="btn btn-success pull-right" name="btn_update">
                        <input type="submit" value="Delete" class="btn btn-danger">
                </div>
            </div>
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
        },
        methods: {  
           
        }
    });
</script>

<?php include 'includes/footer.php'; ?> 
<?php unset($_SESSION['temp']) ?>