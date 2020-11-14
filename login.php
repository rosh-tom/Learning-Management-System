<?php include 'includes/header.php'; ?>
        <title>Login to SDSSU CANTILAN LMS</title> 
    </head>
    <body>
        <div id="index">
            <div class="container">
<?php include 'includes/navigation.php'; ?>

            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++ content  -->
<form class="form-signin" action="controller/login.controller.php" method="post" autocomplete=" " >
                <h2 class="form-signin-heading">Please sign in</h2>

                <input 
                type="email" 
                class="form-control" 
                placeholder="Email Address" 
                required  
                name = "email"  
                <?= (isset($_SESSION['temp']['email'])) ? "value='". $_SESSION['temp']['email'] ."'" : 'autofocus' ?> 
                />  

                <input 
                type="password"
                class="form-control" 
                placeholder="Password" 
                required 
                name="password" 
                autofocus        
                />

                <div class="checkbox"> 

                </div>
                <button class="btn btn-lg btn-primary btn-block last" type="submit" name="btn_signin">Sign in</button>

                <br>
<?php if(isset($_SESSION['temp']['message'])){ ?>
                <div class="alert <?= ($_SESSION['temp']['success']) ? 'alert-success' : 'alert-danger' ?>">
                    <?= $_SESSION['temp']['message'] ?>
                </div>
<?php } ?>

                <hr class="divider">
                <a href="create.php" class="deco-none text-center"><h4>Student Create Account?</h4></a>
            </form> 
            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++ /content  -->
            </div>
            <!-- /.container  -->   
        </div>
        <!-- /#index  --> 
<br><br>
<?php include 'includes/footer.php'; ?>
