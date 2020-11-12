<?php include 'includes/header.php' ;?>
        <title>Faculty - SDSSU CANTILAN LMS</title> 
    </head>
    <body> 
            <div class="container">
<?php include 'includes/navigation.php'; ?>

<div id="index"> 
            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++ content  -->

            <center>
                <div class="col-sm-6">
                    <div class="panel panel-default">  
                    <div class="panel-body">
                        <h3><span class="badge">42</span> Handled Courses </h3> 
                    </div>
                    <div class="panel-footer"><center><a href="course.php" class="btn btn-info">View Courses</a></center></div>   
                    </div>
                </div> 
                <div class="col-sm-6">
                    <div class="panel panel-default">  
                    <div class="panel-body">
                        <h3>Messages <span class="badge">42</span></h3> 
                    </div>
                    <div class="panel-footer"><center><button class="btn btn-info">View Messages</button></center></div>   
                    </div>
                </div>  
            </center>
            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++/content  --> 
</div>
<!-- / #index  -->
            </div>
            <!-- /.container  -->    
<script>
    var app = new Vue({
        el: "#index",
        data: {
            message: "Hello World"
        }
    });
</script>

<?php include 'includes/footer.php'; ?>