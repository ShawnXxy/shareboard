<?php
    include 'includes/config.php';
?>
    <!-- header -->
    <?php include 'includes/header.php'; ?>
    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php
                    if (isset($_GET['post_id'])) {
                        $cur_post_id = $_GET['post_id'];
                    }

                    $sql = "SELECT * FROM {$table_posts} WHERE post_id = {$cur_post_id};";
                    $query = mysqli_query($con, $sql);
                    
                    while ($row = mysqli_fetch_assoc($query)) {
                        $post_title = mysqli_real_escape_string($con, $row['post_title']);
                        $post_author = mysqli_real_escape_string($con, $row['post_author']);
                        $post_date = $row['post_date'];
                        $post_img = $row['post_img'];
                        $post_content = mysqli_real_escape_string($con, $row['post_content']);
                        // $post_tags = $row['post_tags'];
                        // $post_comment_count = $row['post_comment_count'];
                        // $post_status = $row['post_status'];
                        // $post_views_count = $row['post_views_count'];
                    ?>
                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_img; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                    <?php
                    }
                ?>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>

                <!-- Pager -->
                <!-- <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php
                include 'includes/sidebar.php';
            ?>

        </div><!-- /.row -->

        <hr>

        <?php
            include 'includes/footer.php';
        ?>

        
