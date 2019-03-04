<?php
    if (isset($_GET['post_id'])) {
        $cur_post_id = $_GET['post_id'];
    }

    $sql = "SELECT * FROM $table_posts WHERE post_id = $cur_post_id;";
    $query = mysqli_query($con, $sql);
    if (!$query) {
        die('Query Failed ! ' . mysqli_error($con));
    }

    while ($row = mysqli_fetch_assoc($query)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_cat_id = $row['post_cat_id'];
        $post_img = $row['post_img'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        // $post_date = $row['post_date'];
    }

    if (isset($_POST['edit_post'])) {
        $post_author = mysqli_real_escape_string($con, $_POST['post_author']);
        $post_title = mysqli_real_escape_string($con, $_POST['post_title']);
        $post_cat_id = $_POST['post_cat_id'];

        $post_img = $_FILES['post_img']['name'];
        $post_img_temp = $_FILES['post_img']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = mysqli_real_escape_string($con, $_POST['post_content']);
        $post_type = $_POST['post_type'];

        move_uploaded_file($post_img_temp, "../images/$post_img");
        if (empty($post_img)) {
            $sql = "SELECT * FROM $table_posts WHERE post_id = $cur_post_id;";
            $query = mysqli_query($con, $sql);
            while($row = mysqli_fetch_array($query)) {
                $post_img = $row['post_img'];
            }
        }

        $cur_author = $_SESSION['username'];
        $sql_update_post = "UPDATE $table_posts SET
            post_cat_id = '$post_cat_id',
            post_title = '$post_title',
            post_author = '$cur_author',
            post_content = '$post_content',
            post_type = $post_type,
            post_tags = '$post_tags',
            post_img = '$post_img'
            WHERE post_id = $cur_post_id;
            ";
        $query_update_post = mysqli_query($con, $sql_update_post);
        if (!$query_update_post) {
            die('Query Failed ! ' . mysqli_error($con));
        } else {
            echo "<p class='bg-success'>Updated successfully! <a href='../post.php?post_id=$post_id' target='_blank'>View</a></p>";
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
                $sql = "SELECT cat_id, cat_title FROM $table_cat;";
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($query)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='$cat_id'>$cat_title</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $_SESSION['username']; ?>" disabled="true">
    </div>

    <div class="form-group">
        <label for="post_img">Post Image</label>
        <img class="img-responsive" src="../images/<?php echo $post_img; ?>" alt="" width="100" height="100">
        <input type="file" name="post_img">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="" name="post_content" id="editor" cols="30" rows="50" style="display:flex; flex-flow:column nowrap; overflow:auto;"><?php echo $post_content; ?></textarea>
        <script type="text/javascript">
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                });
        </script>

        <!-- CKeditor5 Document style -->
        <!-- <div class="" id="toolbar-container"></div>
        <div class="" id="editor" style="height:500px; display:flex; flex-flow:column nowrap; overflow:auto;">
            <input name="post_content"></textarea>
        </div>
        <script>
            DecoupledEditor
                .create( document.querySelector( '#editor' ) )
                .then( editor => {
                    const toolbarContainer = document.querySelector( '#toolbar-container' );

                    toolbarContainer.appendChild( editor.ui.view.toolbar.element );
                } )
                .catch( error => {
                    console.error( error );
                } );
        </script> -->
    </div>

    <div class="form-group">
        <label for="post_type">Draft</label>
        <select name="post_type" id="">
            <option value="0">Private</option>
            <option value="1">Public</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" name="edit_post" value="Confirm">
    </div>
</form>
