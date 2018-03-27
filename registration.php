<?php 
    include "includes/db.php"; 
?>
    <!-- header -->
    <?php include 'includes/header.php'; ?>
    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>
     
    <!-- Page Content -->
    <div class="container">  
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                            <h1 class="text-center">Register</h1>
                            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                                <?php
                                    if (isset($_POST['submit'])) {
                                        $username = mysqli_real_escape_string($con, $_POST['username']);
                                        $email = mysqli_real_escape_string($con, $_POST['email']);
                                        $password = mysqli_real_escape_string($con, $_POST['password']);

                                        $md5_new = md5($password);
                                        $hash = password_hash($md5_new, PASSWORD_DEFAULT);


                                    }
                                ?>
                                <div class="form-group">
                                    <label for="username" class="sr-only">username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                                </div>
                        
                                <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Sign Up">
                            </form>
                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>

    <hr>

    <?php include "includes/footer.php";?>
