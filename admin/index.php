<?php session_start(); ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../assets/css/turner.css"> 
        <link rel="stylesheet" href="../assets/css/tomas.css">
        <script src="../assets/js/vue.js"></script>
        <script src="../assets/js/axios.js"></script>
         
        <title>Admin Dashboard</title> 
    </head>
    <body>
        <div id="index">
            <div class="container">
                <button class="btn btn-primary btn-sm" @click="toggleshowModal()">Add new Faculty</button>
                <button class="btn btn-primary btn-sm" @click="logout()">Log Out</button>
                <div style="height: 1000px;">
                  
                </div>
            </div>
            <!-- /.container  --> 

<!-- =======================================  -->
          <!-- modal -->
          <template v-if="showModal">  
            <div class="popup" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" @click="toggleshowModal()"><span>&times;</span></button>
                  <h4 class="modal-title">Add New Faculty</h4>
                </div>
                <div class="modal-body"> 

                <template v-if="success">
                  <div class="alert alert-success" role="alert">
                    {{ message }}
                  </div>
                </template>

                <template v-if="success == false">
                  <div class="alert alert-danger" role="alert">
                    Something went wrong. Please try again later.
                  </div>
                </template> 

                  <form autocomplete="off">
                  <div class="row"> 
                      <div class="col-sm-6">
                        <div class="form-group"> 
                          <label for="email">First Name</label>
                          <input type="email" class="form-control" v-model="firstname">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group"> 
                          <label for="email">Middle Name</label>
                          <input type="email" class="form-control" v-model="middlename">
                        </div>
                      </div> 
                  </div>

                    <div class="row"> 
                        <div class="col-sm-6">
                          <div class="form-group"> 
                            <label for="email">Last Name</label>
                            <input type="email" class="form-control" v-model="lastname">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group"> 
                            <label for="email">User Type</label>
                            <select class="form-control" v-model="type">
                              <option>Faculty</option>
                              <option>Student</option>
                            </select> 
                          </div>
                        </div> 
                    </div>

                    <div class="row"> 
                        <div class="col-sm-6">
                          <div class="form-group"> 
                            <label for="email">Email</label>
                            <input type="email" class="form-control" v-model="email">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group"> 
                            <label for="email">Password</label>
                            <input type="password" class="form-control" v-model="password">
                          </div>
                        </div> 
                    </div>
                    
                  </form> 
                </div> 
                <!-- /. modal body  -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-sm" @click="toggleshowModal()">Close</button>
                  <button type="button" class="btn btn-primary btn-sm" @click="saveFaculty()">Save</button>
                </div>
                <!-- /footer  -->
                </div>
              </div>
            </div>
          </template>
          <!-- /modal  --> 
        </div>
        <!-- /#index  -->

        <script>
            var app = new Vue({
                el: "#index",
                data: { 
                    showModal: false,
                    firstname: '',
                    middlename: '',
                    lastname: '',
                    type: 'Faculty',
                    email: '',
                    password: '', 
                    success: null,
                    message: ''
                },
                methods:{
                  toggleshowModal: function (){
                    this.showModal = !this.showModal;
                  },
                  saveFaculty: function (){ 
                    axios.post("controller/index.controller.php", {
                      action:     'saveFaculty',
                      firstname:  this.firstname,
                      middlename: this.middlename,
                      lastname:   this.lastname,
                      type:       this.type,
                      email:      this.email,
                      password:   this.password
                    }).then(function(response){
                      if(response.data.success){
                        app.firstname  = '',
                        app.middlename = '',
                        app.lastname   = '',
                        app.type       = '',
                        app.email      = '',
                        app.password   = '',
                        app.success    = true,
                        app.message    = "New Faculty Inserted. "
                      }else{ 
                        app.success    = false
                      } 
                    }); 
                   }
                }
            });

        </script>
    </body>
</html>