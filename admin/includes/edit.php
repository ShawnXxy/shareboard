<?php
    if (isset($_GET['post_id'])) {
        $edit_post_id = $_GET['post_id'];
    }

    $sql = "SELECT * FROM {$table_posts} WHERE post_id = {$edit_post_id};";
    $query = mysqli_query($con, $sql);
    if (!$query) {
        die('Query Failed ! ' . mysqli_error($con));
    }

    while ($row = mysqli_fetch_assoc($query)) {
        $edit_post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_cat_id = $row['post_cat_id'];
        $post_status = $row['post_status'];
        $post_img = $row['post_img'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];

    }

    if (isset($_POST['edit'])) {
        $post_author = mysqli_real_escape_string($con, $_POST['post_author']);
        $post_title = mysqli_real_escape_string($con, $_POST['post_title']);
        $post_cat_id = $_POST['post_cat_id'];
        $post_status = $_POST['post_status'];
        $post_img = $_FILES['post_img']['name'];
        $post_img_temp = $_FILES['post_img']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = mysqli_real_escape_string($con, $_POST['post_content']);

        move_uploaded_file($post_img_temp, "../images/$post_img");
        if (empty($post_img)) {
            $sql = "SELECT * FROM {$table_posts} WHERE post_id = {$edit_post_id};";
            $query = mysqli_query($con, $sql);
            while($row = mysqli_fetch_array($query)) {
                $post_img = $row['post_img'];
            }
        }

        $sql_update_post = "UPDATE {$table_posts} SET 
            post_cat_id = '{$post_cat_id}', 
            post_title = '{$post_title}', 
            post_author = '{$post_author}', 
            post_date = now(), 
            post_content = '{$post_content}', 
            post_tags = '{$post_tags}', 
            post_img = '{$post_img}',
            post_status = '{$post_status}'
            WHERE post_id = {$edit_post_id};
            ";
        $query_update_post = mysqli_query($con, $sql_update_post);
        if (!$query_update_post) {
            die('Query Failed ! ' . mysqli_error($con));
        }
    }

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>" required>
    </div>

    <div class="form-group">
        <label for="post_cat">Category</label>
        <select name="post_cat_id" id="">
            <?php
                $sql = "SELECT * FROM {$table_cat};";
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($query)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>" required>
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
    </div>

    <div class="form-group">
        <label for="post_img">Post Image</label>
        <img class="img-responsive" src="../images/<?php echo $post_img; ?>" alt="" width-"100" height="100">
        <input type="file" name="post_img">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" cols="30" rows="10" ><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" name="edit" value="Confirm">
    </div>
</form>