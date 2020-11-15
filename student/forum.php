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
<?php include 'includes/nav.php'; ?>

<!-- =================================================================================== content  -->
<div id="content">  
<div class="row">  
        <div class="col-sm-12 margin-b-20">   
            <h2>Forum</h2>
        </div>
</div>

<div class="row"> 
            <div class="panel panel-default"> 

            <div class="panel-footer" style="position: sticky;">  
                        
                        <div class="input-group">
                        <textarea class="form-control" cols="3" rows="1" style="resize: none;" v-model="v_message" v-on:keyup.enter="sendMessage()"></textarea> 
                        <span class="input-group-btn"> 
                        <button class="btn btn-primary" type="button" @click="sendMessage()">Send</button>
                                                       
                        </span>
                        </div><!-- /input-group -->     
                </div>  

                 <div class="panel-body" style="height: 700px; overflow-y:scroll;">  
                        <div v-for="message in messages">
                                <template v-if="message.usr_id == <?= $_SESSION['loggedID'] ?>">
                                    <div class="well well-sm" style="background-color: #428bca; color: white; margin: 10px;"> 
                                        <p style="padding-left: 5px">{{message.msg}}</p> 
                                        <small>{{message.created_at}}</small> 
                                    </div> 
                                </template>  
                                <template v-else> 
                                    <div class="well well-sm">
                                        <p style="margin-bottom: -5px; padding: -2px;">
                                            <img class="myimg"  v-bind:src="'../' + message.usr_profilepic" ><b>{{message.usr_firstname}} {{message.usr_lastname}}</b></p> 
                                            <small>{{message.created_at}}</small></p> 
                                        <p style="padding-left: 5px">{{message.msg}}</p> 
                                    </div> 
                                </template> 
                        </div>
                  </div>  
        </div> 
</div>
            <!-- /.container  -->   
                
</div>
<!-- /content  -->

<script>
    var content = new Vue({
        el: "#content",
        data: {
            v_message: '',
            messages: '' 
        },
        methods: {
            sendMessage: function(){
                axios.post("controller/forums.controller.php", {
                    action: 'sendMessage',
                    message: this.v_message,
                    crs_id: <?= $_GET['course']?>
                }).then(function(response){ 
                    content.clear(); 
                });
            },
            clear: function(){
                this.v_message = '';
            },
            fetchMessage: function(){
                axios.post("controller/forums.controller.php", {
                    action: 'fetchMessage', 
                    crs_id: <?= $_GET['course'] ?>
                }).then(function(response){  
                    content.messages = response.data;
                });
            }
        },
        created: function(){
            this.fetchMessage();
        }
    });


    var timerID = setInterval(content.fetchMessage, 1000);
    content.fetchMessage();
</script> 

<?php include 'includes/footer.php'; ?>