<?php include 'includes/header.php'; ?>
        <title>Create Account to SDSSU CANTILAN LMS</title> 
    </head>
    <body>
        <div id="index">
            <div class="container">
<?php include 'includes/navigation.php'; ?>

            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++ content  --> 
            <form class="form-signin" autocomplete="off" method="post" action="actions/signup.php"> 
                <h3 class="form-signin-heading">Enter Account Information</h3>  
                <input 
                type="text" 
                name="firstname" 
                class="form-control" 
                placeholder="First Name" 
                required 
                autofocus 
                value=""
                />        
                <input 
                type="text" 
                name="lastname" 
                class="form-control" 
                placeholder="Last Name" 
                required 
                autofocus
                value=""
                />
                <input 
                type="email" 
                name="email" 
                class="form-control" 
                placeholder="Email address" 
                required 
                autofocus 
                value=""
                />
                <input 
                type="password" 
                name="password" 
                class="form-control" 
                placeholder="Password" 
                required 
                autofocus 
                />
                <input 
                type="password" 
                name="password_c" 
                class="form-control last" 
                placeholder="Confirm Password" 
                required 
                autofocus 
                /> 

                <button class="btn btn-lg btn-success btn-block last" type="submit" name="btn_signup">Sign Up</button> 
                <br>
                <hr class="divider">
                <a href="login.php" class="deco-none text-center"><h4>Already Have an Account?</h4></a>
            </form> 
            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++ /content  -->
            </div>
            <!-- /.container  -->   
        </div>
        <!-- /#index  --> 
<br><br>
<?php include 'includes/footer.php'; ?>
<?php unset($_SESSION['temp']) ?>