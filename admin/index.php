<!-- Header -->
<?php include 'includes/header.php'; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome, 
                        <small><?php echo $_SESSION['username']; ?></small> !
                    </h1>
                    <!-- <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol> -->
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                        $sql = "SELECT * FROM $table_posts;";
                                        $query = mysqli_query($con, $sql);
                                        $post_counts = mysqli_num_rows($query);
                                        echo "<div class='huge'>$post_counts</div>";
                                    ?>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                        $sql = "SELECT * FROM $table_comments;";
                                        $query = mysqli_query($con, $sql);
                                        $comments_counts = mysqli_num_rows($query);
                                        echo "<div class='huge'>$comments_counts</div>";
                                    ?>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                        $sql = "SELECT * FROM $table_users;";
                                        $query = mysqli_query($con, $sql);
                                        $users_counts = mysqli_num_rows($query);
                                        echo "<div class='huge'>$users_counts</div>";
                                    ?>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                        $sql = "SELECT * FROM $table_cat;";
                                        $query = mysqli_query($con, $sql);
                                        $cat_counts = mysqli_num_rows($query);
                                        echo "<div class='huge'>$cat_counts</div>";
                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Google Charts -->
            <?php
                $sql = "SELECT * FROM $table_users WHERE user_role = 'Admin';";
                $query = mysqli_query($con, $sql);
                $admin_counts = mysqli_num_rows($query);

                $sql = "SELECT * FROM $table_users WHERE user_role = 'Subscriber';";
                $query = mysqli_query($con, $sql);
                $subscriber_counts = mysqli_num_rows($query);
            ?>
            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Items', 'Count'],
                            <?php
                                $element_title = [
                                    'Active Posts',
                                    'Categories',
                                    'Users',
                                    'Admins',
                                    'Subscribers',
                                    'Comments'
                                ];
                                $element_count = [
                                    $post_counts,
                                    $cat_counts,
                                    $users_counts,
                                    $admin_counts,
                                    $subscriber_counts,
                                    $comments_counts
                                ];

                                for ($i = 0; $i < 6; $i++) {
                                    echo "['$element_title[$i]'" . ", " . "$element_count[$i]],";
                                }
                            ?>
                        ]);

                        var options = {
                            chart: {
                                title: 'ShareBoard CMS',
                                subtitle: 'Admin Dashboard',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: auto; height: 500px;">
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
        
    </div>
    <!-- /#page-wrapper -->

<!-- Footer -->
<?php include "includes/footer.php"; ?>
