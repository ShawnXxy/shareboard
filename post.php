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

                    $sql = "SELECT * FROM $table_posts WHERE post_id = $cur_post_id;";
                    $query = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_assoc($query)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_img = $row['post_img'];
                        $post_content = $row['post_content'];
                        // $post_tags = $row['post_tags'];
                        // $post_comment_count = $row['post_comment_count'];
                        // $post_views_count = $row['post_views_count'];
                    ?>
                        <!-- <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1> -->

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
                        <!-- weibo share -->
                        <wb:share-button appkey="959720788" addition="simple" type="icon" ralateUid="1700595130"></wb:share-button>
                        <br>
                        <a class="btn btn-primary" href="index.php">Go back <<< </a>

                        <hr>
                    <?php
                    }
                ?>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <?php
                    if (isset($_POST['create_comment'])) {
                        $cur_post_id = $_GET['post_id'];
                        $comment_author = mysqli_real_escape_string($con, $_POST['comment_author']);
                        $comment_email = mysqli_real_escape_string($con, $_POST['comment_email']);
                        $comment_content = mysqli_real_escape_string($con, $_POST['comment_content']);

                        $sql = "INSERT INTO $table_comments (
                                comment_post_id,
                                comment_author,
                                comment_email,
                                comment_content,
                                comment_date
                            ) VALUES (
                                $cur_post_id,
                                '$comment_author',
                                '$comment_email',
                                '$comment_content',
                                now()
                            );";
                        $query = mysqli_query($con, $sql);
                        if (!$query) {
                            die('Query failed ! ' . mysqli_error());
                        }

                        // Get comment count
                        $sql_get_comment_count = "UPDATE $table_posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $cur_post_id;";
                        mysqli_query($con, $sql_get_comment_count);
                    }
                ?>
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <!-- <label for="comment_author">Name</label> -->
                            <input type="text" class="form-control" name="comment_author" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="comment_email">Email</label> -->
                            <input type="email" class="form-control" name="comment_email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <textarea name="comment_content" class="form-control" rows="3" placeholder="Your Comments ... " required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success" name="create_comment">Submit</button>
                    </form>
                </div>


                <hr>

                <!-- Posted Comments -->
                <?php
                    $sql_cur_post = "SELECT * FROM $table_comments WHERE comment_post_id = $cur_post_id ORDER BY comment_date;";
                    $query_cur_post = mysqli_query($con, $sql_cur_post);
                    if (!$query_cur_post) {
                        die("Query Failed ! " . mysqli_error($con));
                    }

                    while ($row = mysqli_fetch_assoc($query_cur_post)) {
                        $comment_date = $row['comment_date'];
                        $comment_author = $row['comment_author'];
                        $comment_content = $row['comment_content'];
                        ?>
                            <div class="media">
                                <a href="" class="pull-left">
                                    <img src="http://placehold.it/64x64" alt="" class="media-object">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $comment_author; ?>
                                        <small><?php echo $comment_date; ?></small>
                                    </h4>
                                    <?php echo $comment_content; ?>
                                </div>
                            </div>
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

            <hr>
            <!-- Blog Sidebar Widgets Column -->
            <?php
                include 'includes/sidebar.php';
            ?>

        </div><!-- /.row -->

        <hr>

        <?php
            include 'includes/footer.php';
        ?>
