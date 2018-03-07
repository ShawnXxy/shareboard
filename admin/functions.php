<?php
    /***************
     *  Categories
     *******************/
    function load_cat() {
        global $con;
        global $table_cat;

        $sql = "SELECT * FROM {$table_cat};";
        $query = mysqli_query($con, $sql);

        while($row = mysqli_fetch_assoc($query)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "
                <td>
                    <a class='btn btn-primary' href='categories.php?edit={$cat_id}'>Edit</a>
                    <a class='btn btn-danger' href='categories.php?delete={$cat_id}'>Delete</a>
                </td>
                ";
        }
    }

    function insert_cat() {
        global $con;
        global $table_cat;
        if (isset($_POST['submit'])) {
            $cat_title = $_POST['cat_title'];
            if (!empty($cat_title)) {
                $sql = "INSERT INTO {$table_cat}(cat_title) VALUES('{$cat_title}');";
                $query = mysqli_query($con, $sql);
                if (!$query) {
                    die('Query Failed!' . mysqli_error($con));
                }
            } 
        }
    }

    function edit_cat() {
        global $con;
        global $table_cat;
        if (isset($_GET['edit'])) {
            $edit_cat_id = $_GET['edit'];
            $sql = "SELECT * FROM {$table_cat} WHERE cat_id = {$edit_cat_id};";
            $query = mysqli_query($con, $sql);

            while($row = mysqli_fetch_assoc($query)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                ?>
                    <div class="form-group">
                        <label for="cat_title">Edit Category</label>
                        <input type="text" class="form-control" value="<?php if (isset($cat_title)) {echo $cat_title;} ?>" name="cat_title" required>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="edit" value="Update">
                    </div>
                <?php
            }

            if (isset($_POST['edit'])) {
                $edit_cat_title = $_POST['cat_title'];
                $sql = "UPDATE {$table_cat} SET cat_title = '{$edit_cat_title}' WHERE cat_id = {$cat_id};";
                $query = mysqli_query($con, $sql);
                if (!$query) {
                    die("Query Failed!" . mysqli_error($con));
                }
            }
        } // End of isset($_GET['edit']
    }

    function delete_cat() {
        global $con;
        global $table_cat;
        if (isset($_GET['delete'])) {
            $delete_cat_id = $_GET['delete'];
            $sql = "DELETE FROM {$table_cat} WHERE cat_id = {$delete_cat_id};";
            $query = mysqli_query($con, $sql);
            if (!$query) {
                die("Query Failed!" . mysqli_error($con));
            } else {
                header("Location: categories.php");
            }
        }
    }

    /******************
     * Post 
     ********************/
    function load_posts() {
        global $con;
        global $table_posts;

        $sql = "SELECT * FROM {$table_posts};";
        $query = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($query)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_cat_id = $row['post_cat_id'];
            $post_status = $row['post_status'];
            $post_img = $row['post_img'];
            $post_tags = $row['post_tags'];
            $post_views_count = $row['post_views_count'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];

            echo "<tr>";
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";
            echo "<td>{$post_cat_id}</td>";
            echo "<td>{$post_status}</td>";
            echo "<td><img class='img-responsive' src='../images/$post_img' alt='test-image'></td>";
            echo "<td>{$post_tags}</td>";
            echo "<td>{$post_views_count}</td>";
            echo "<td>{$post_comment_count}</td>";
            echo "<td>{$post_date}</td>";
            echo "
                <td>
                    <a href='posts.php?delete=$post_id' class='btn btn-primary'>Edit</a>
                    <a href='posts.php?delete=$post_id' class='btn btn-danger'>Delete</a>
                </td>
                ";
            echo "</tr>";
        }
    }

    function insert_post() {
        global $con;
        global $table_posts;

        if (isset($_POST['publish_post'])) {
            $post_title = $_POST['post_title'];
            $post_author = $_POST['post_author'];
            $post_cat_id = $_POST['post_cat_id'];
            $post_status = $_POST['post_status'];
    
            $post_img = $_FILES['post_img']['name'];
            $post_img_temp = $_FILES['post_img']['tmp_name'];
            move_uploaded_file($post_img_temp, "../images/$post_img");
    
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];
            $post_date = date('d-m-y');
    
            $post_comment_count = 3;
    
            $sql = "INSERT INTO {$table_posts}(post_cat_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_comment_count, post_status) VALUES({$post_cat_id}, '{$post_title}', '{$post_author}', now(), '{$post_img}', '{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}');";
            $query = mysqli_query($con, $sql);
            if (!$query) {
                die("Query failed!" . mysqli_error($con));
            } else {
                // echo "<p>Publish successfully!</p>";
            }
            
        }
    }

    function delete_post() {
        global $con;
        global $table_posts;

        if (isset($_GET['delete'])) {
            $delete_post_id = $_GET['delete'];
            $sql = "DELETE FROM {$table_posts} WHERE post_id = {$delete_post_id};";
            $query = mysqli_query($con, $sql);
            if (!$query) {
                die("Query failed ! " . mysqli_error($con));
            } else {
                header("Location: posts.php");
            }
        }
    }

?>