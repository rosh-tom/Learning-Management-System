<div id="nav"> 
    <div class="buttons">
                <a href="index.php" class="btn btn-info btn-sm"><b><</b> Back</a> 
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
                            <h2><?= $result_course[0]['crs_descriptitle'] ?></h2> 
                            <h4><?= $result_course[0]['crs_number']?></h4>
                        </div>
                    </div>  
                </div> 
            </template>

            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <!-- <li  class="active">Home </li> -->
                        <li><a href="course.php?course=<?= $_GET['course'] ?>">Home</a></li>
                        <li><a href="questionnaire.php?course=<?= $_GET['course'] ?>">Questionnaire</a></li>
                        <li><a href="questionnaire.php?course=<?= $_GET['course'] ?>">Forums</a></li>
                        <li><a href="questionnaire.php?course=<?= $_GET['course'] ?>">Students</a></li>
                    </ol>
                </div>
            </div> 
    </div>

<script>
    var nav = new Vue({
        el: "#nav",
        data: {  
            showJumbo: true
        },
        methods: {
            toggleShowJumbo: function(){
                this.showJumbo = !this.showJumbo;
            },
        }
    });
</script>