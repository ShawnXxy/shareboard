<?php

    include "config.php";

    session_start();

?>

<!-- Blog Sidebar Widgets Column -->
    <div class="col-md-4">

        <!-- Blog Search Well -->
        <div class="well">
            <h4>Blog Search</h4>
            <form action="search.php" method="post">
                <div class="input-group">
                    <input type="text" name="search" class="form-control">
                    <span class="input-group-btn">
                        <button name="submit" class="btn btn-default" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div><!-- /.input-group -->
            </form>
        </div>

        <!-- Login form -->
        <?php
            if (!isset($_SESSION['username'])) {
            ?>
                <div class="well" id="login-form">
                    <h4>User Login</h4>
                    <form action="includes/login.php" method="post">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div><!-- /.input-group -->
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">

                        </div><!-- /.input-group -->
                        <span class="input-group-btn">
                            <button class="btn btn-primary" name="login" type="submit">Sign In</button>
                            <!-- <a href="registration.php" class="btn btn-primary" name="register">Sign Up</a> -->
                        </span>
                    </form>
                </div>
            <?php
            }
        ?>

        <!-- Side Widget Well -->
        <?php include 'includes/widget.php'; ?>
    </div>
