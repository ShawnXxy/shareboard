<?php
    include 'config.php';

    session_start();

?>
<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">ShareBoard</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                        $sql = "SELECT * FROM $table_cat;";
                        $query = mysqli_query($con, $sql);

                        while($row = mysqli_fetch_assoc($query)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                        }
                    ?>
                    <?php
                        if (!isset($_SESSION['username'])) {
                    ?>
                            <li><a href="index.php#login-form">Admin</a></li>
                    <?php
                        }
                    ?>
                </ul>


                <ul class="nav navbar-right top-nav">

                    <!-- message dropdown menu -->
                    <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                        <ul class="dropdown-menu message-dropdown">
                            <li class="message-preview">
                                <a href="#">
                                    <div class="media">
                                        <span class="pull-left">
                                            <img class="media-object" src="http://placehold.it/50x50" alt="">
                                        </span>
                                        <div class="media-body">
                                            <h5 class="media-heading">
                                                <strong>John Smith</strong>
                                            </h5>
                                            <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="message-footer">
                                <a href="#">Read All New Messages</a>
                            </li>
                        </ul>
                    </li> -->

                    <!-- notification dropdown menu -->
                    <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                        <ul class="dropdown-menu alert-dropdown">
                            <li>
                                <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">View All</a>
                            </li>
                        </ul>
                    </li> -->

                    <li class="dropdown">
                        <?php
                            if (isset($_SESSION['username'])) {
                        ?>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname']; ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="./admin"><i class="fa fa-fw fa-wrench"></i> Admin</a>
                                    </li>
                                    <li>
                                        <a href="./admin/profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                                    </li>
                                </ul>
                        <?php
                            } else {
                        ?>
                                <ul class="dropdown-menu">
                                    <li><a href="index.php#login-form">Login</a></li>
                                    <li><a href="registration.php" class="btn btn-primary" name="register">Register</a></li>
                                </ul>
                        <?php
                            }
                        ?>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>
