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
                    $sql = "SELECT * FROM $table_posts ORDER BY post_date DESC;";
                    $query = mysqli_query($con, $sql);
                    
                    while ($row = mysqli_fetch_assoc($query)) {
                        $post_id = $row['post_id'];
                        $post_title = mysqli_real_escape_string($con, $row['post_title']);
                        $post_author = mysqli_real_escape_string($con, $row['post_author']);
                        $post_date = $row['post_date'];
                        $post_img = $row['post_img'];
                        $post_content = substr(mysqli_real_escape_string($con, $row['post_content']), 0, 100);
                        // $post_tags = $row['post_tags'];
                        // $post_comment_count = $row['post_comment_count'];
                        // $post_views_count = $row['post_views_count'];
                    ?>
                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- Blog Post -->
                        <h2>
                            <a href='post.php?post_id=<?php echo $post_id; ?>'><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_img; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                    <?php
                    }
                ?>

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

        
