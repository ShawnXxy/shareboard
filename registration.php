<?php 
    include "includes/config.php"; 

?>
    <!-- header -->
    <?php include 'includes/header.php'; ?>
    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>
     
     <br/>
     <hr>
     <br/>
    <!-- Page Content -->
    <div class="container">  
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                            <h1 class="text-center">Register</h1>
                            <form action="" method="post" id="login-form" autocomplete="off" enctype="multipart/form-data">
                                <?php
                                    if (isset($_POST['create_user'])) {
                                        $username = mysqli_real_escape_string($con, $_POST['username']);
                                        $password = mysqli_real_escape_string($con, $_POST['password']);
                                        $md5_reg = md5($password);
                                        // $hash = password_hash($md5_new, PASSWORD_DEFAULT);
                            
                                        $user_firstname = mysqli_real_escape_string($con, $_POST['user_firstname']);
                                        $user_lastname = mysqli_real_escape_string($con, $_POST['user_lastname']);
                                        $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
                                        $user_role = $_POST['user_role'];
                            
                                        $user_img = $_FILES['user_img']['name'];
                                        $user_img_temp = $_FILES['user_img']['tmp_name'];
                                        move_uploaded_file($user_img_temp, "../images/profile/$user_img");
                            
                                        $reg_time = date('d-m-y');
                                
                                        $sql = "INSERT INTO $table_users (
                                            username,
                                            password,
                                            user_firstname,
                                            user_lastname,
                                            user_email,
                                            user_role,
                                            user_img,
                                            reg_time
                                            ) VALUES (
                                                '$username', 
                                                '$md5_reg', 
                                                '$user_firstname', 
                                                '$user_lastname', 
                                                '$user_email',
                                                '$user_role',
                                                '$user_img',
                                                now()
                                                );";
                                        $query = mysqli_query($con, $sql);
                                        if (!$query) {
                                            die("Query failed!" . mysqli_error($con));
                                        } else {
                                            echo "<p class='bg-success'>Registered successfully! <a href='index.php#login-form'>Sign In</a></p>";
                                        }
                                        
                                    }
                                ?>
                                <div class="form-group">
                                    <label for="username">Enter Desired Username *</label>
                                    <input type="text" class="form-control" name="username" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password *</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>

                                <div class="form-group">
                                    <label for="user_firstname">Enter Your Firstname</label>
                                    <input type="text" class="form-control" name="user_firstname">
                                </div>

                                <div class="form-group">
                                    <label for="user_lastname">Enter Your Lastname</label>
                                    <input type="text" class="form-control" name="user_lastname">
                                </div>

                                <div class="form-group">
                                    <label for="user_email">Email</label>
                                    <input type="email" class="form-control" name="user_email" placeholder="somebody@example.com">
                                </div>

                                <div class="form-group">
                                    <label for="user_role">Role</label>
                                    <select name="user_role">
                                        <option value="subscriber">Select Role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Subscriber">Subscriber</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="user_img">Upload Your Profile Picture</label>
                                    <input type="file" name="user_img">
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-custom btn-lg btn-block" id="btn-login" name="create_user" value="Sign Up">
                                </div>
                            </form>
                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>

    <hr>

    <?php include "../includes/footer.php";?>
