<?php

    /**********************
     *
     *  Getting Online users
     *
     /********************* */

     function online_num() {

        if (isset($_GET['onlineusers'])) {

            global $con;
            global $table_usersOnline;

            if (!$con) {
                session_start();
                include("../includes/config.php");

                $session = session_id();
                $time = time();
                $time_out_in_sec = 300;
                // Counting how long user been online
                $time_out = $time - $time_out_in_sec;

                $sql = "SELECT * FROM $table_usersOnline WHERE session = '$session';";
                $query = mysqli_query($con, $sql);
                $count = mysqli_num_rows($query);
                if ($count == NULL) { // user is not online and a new user is logged in
                    mysqli_query($con, "INSERT INTO $table_usersOnline(session, time) VALUES('$session', '$time');");
                } else { // the user is already online
                    mysqli_query($con, "UPDATE $table_usersOnline SET time = '$time' WHERE session = '$session';");
                }

                $online = mysqli_query($con, "SELECT * FROM $table_usersOnline WHERE time > '$time_out';");
                echo $online_num = mysqli_num_rows($online);
            }
        }

    }
    online_num();

    /***************
     *
     *  Categories
     *
     *******************/
    function load_cat() {
        global $con;
        global $table_cat;

        $sql = "SELECT * FROM $table_cat;";
        $query = mysqli_query($con, $sql);

        while($row = mysqli_fetch_assoc($query)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<tr>";
            echo "<td>$cat_id</td>";
            echo "<td>$cat_title</td>";
            echo "
                <td>
                    <a class='btn btn-primary' href='categories.php?edit=$cat_id'>Edit</a>
                    <a class='btn btn-danger' href='categories.php?delete=$cat_id'>Delete</a>
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
                $sql = "INSERT INTO $table_cat(cat_title) VALUES('$cat_title');";
                $query = mysqli_query($con, $sql);
                if (!$query) {
                    die('Query Failed!' . mysqli_error($con));
                } else {
                    echo "<p class='bg-success'>New category added!</p>";
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
                $sql = "UPDATE $table_cat SET
                    cat_title = '$edit_cat_title'
                    WHERE cat_id = $cat_id;
                    ";
                $query = mysqli_query($con, $sql);
                if (!$query) {
                    die("Query Failed!" . mysqli_error($con));
                } else {
                    echo "<p class='bg-success'>Category updated successfully!</p>";
                }
            }
        } // End of isset($_GET['edit']
    }

    function delete_cat() {
        global $con;
        global $table_cat;
        if (isset($_GET['delete'])) {
            $delete_cat_id = $_GET['delete'];
            $sql = "DELETE FROM $table_cat WHERE cat_id = $delete_cat_id;";
            $query = mysqli_query($con, $sql);
            if (!$query) {
                die("Query Failed!" . mysqli_error($con));
            } else {
                header("Location: categories.php");
            }
        }
    }

    /******************
     *
     * Post
     *
     ********************/

    function load_posts() {
        global $con;
        global $table_posts;
        global $table_cat;

        $sql = "SELECT * FROM $table_posts ORDER BY post_date DESC;";
        $query = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($query)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_cat_id = $row['post_cat_id'];
            $post_img = $row['post_img'];
            $post_type = $row['post_type'];
            $post_tags = $row['post_tags'];
            // $post_views_count = $row['post_views_count'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];

            echo "<tr>";
            echo "<td>$post_id</td>";
            echo "<td>$post_author</td>";
            echo "<td><a href='../post.php?post_id=$post_id'>$post_title</a></td>";

            // Combine cat_id to display category
            $sql_get_cat = "SELECT * FROM $table_cat WHERE cat_id = $post_cat_id;";
            $query_get_cat = mysqli_query($con, $sql_get_cat);
            while ($row = mysqli_fetch_assoc($query_get_cat)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<td>$cat_title</td>";
            }

            echo "<td><img class='img-responsive' src='../images/$post_img' alt='post-image' width='100' height='100'></td>";
            echo "<td>$post_type</td>";
            echo "<td>$post_tags</td>";
            // echo "<td>{$post_views_count}</td>";
            echo "<td>$post_comment_count</td>";
            echo "<td>$post_date</td>";
            echo "
                <td>
                    <a href='posts.php?source=edit_post&post_id=$post_id' class='btn btn-primary'>Edit</a>
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
            $post_title = mysqli_real_escape_string($con, $_POST['post_title']);
            $post_author = mysqli_real_escape_string($con, $_SESSION['username']);
            $post_cat_id = $_POST['post_cat_id'];

            $post_img = $_FILES['post_img']['name'];
            $post_img_temp = $_FILES['post_img']['tmp_name'];
            move_uploaded_file($post_img_temp, "../images/$post_img");

            $post_tags = $_POST['post_tags'];
            $post_content = mysqli_real_escape_string($con, $_POST['post_content']);
            $post_type = $_POST['post_type'];
            $post_date = date('d-m-y');

            $sql = "INSERT INTO $table_posts (
                post_cat_id,
                post_title,
                post_author,
                post_date,
                post_img,
                post_content,
                post_type,
                post_tags
                ) VALUES (
                    $post_cat_id,
                    '$post_title',
                    '$post_author',
                    now(),
                    '$post_img',
                    '$post_content',
                    '$post_type',
                    '$post_tags'
                    );";
            $query = mysqli_query($con, $sql);
            if (!$query) {
                die("Query failed!" . mysqli_error($con));
            } else {
                $post_id = mysqli_insert_id($con);
                echo "<p class='bg-success'>Publish successfully! <a href='../post.php?post_id=$post_id' target='_blank'>View</a></p>";
            }

        }
    }

    function delete_post() {
        global $con;
        global $table_posts;

        if (isset($_GET['delete'])) {
            $delete_post_id = $_GET['delete'];
            $sql = "DELETE FROM $table_posts WHERE post_id = $delete_post_id;";
            $query = mysqli_query($con, $sql);
            if (!$query) {
                die("Query failed ! " . mysqli_error($con));
            } else {
                header("Location: posts.php");
            }
        }
    }

    /**************************
     *
     *  COMMENTS
     *
     * ******************************/
    function load_comments() {
        global $con;
        global $table_posts;
        global $table_cat;
        global $table_comments;

        $sql = "SELECT * FROM $table_comments ORDER BY comment_date DESC;";
        $query = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($query)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_email = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_date = $row['comment_date'];

            echo "<tr>";
            echo "<td>$comment_id</td>";
            echo "<td>$comment_author</td>";
            echo "<td>$comment_content</td>";
            echo "<td>$comment_email</td>";
            // echo "<td>{$comment_status}</td>";

            // Combine cat_id to display blog post title
            $sql_get_title = "SELECT * FROM $table_posts WHERE post_id = $comment_post_id;";
            $query_get_title = mysqli_query($con, $sql_get_title);
            while ($row = mysqli_fetch_assoc($query_get_title)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                echo "<td><a href='../post.php?post_id=$post_id'>$post_title</a></td>";
            }

            echo "<td>$comment_date</td>";
            // echo "<td><a href='posts.php?source=edit_post&post_id={$post_id}' class='btn btn-success'>Approve</a></td>";
            // echo "<td><a href='posts.php?delete={$post_id}' class='btn btn-danger'>Unapprove</a></td>";
            echo "<td><a href='comments.php?delete=$comment_id' class='btn btn-danger'>Delete</a></td>";
            echo "</tr>";
        }
    }

    function delete_comment() {
        global $con;
        global $table_comments;

        if (isset($_GET['delete'])) {
            $delete_comment_id = $_GET['delete'];
            $sql = "DELETE FROM $table_comments WHERE comment_id = $delete_comment_id;";
            $query = mysqli_query($con, $sql);
            if (!$query) {
                die("Query failed ! " . mysqli_error($con));
            } else {
                header("Location: comments.php");
            }
        }
    }

    /******************
     *
     * Users
     *
     ********************/
    function load_users() {
        global $con;
        global $table_users;

        $sql = "SELECT * FROM $table_users ORDER BY user_lastname;";
        $query = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($query)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_lastname = $row['user_lastname'];
            $user_firstname = $row['user_firstname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_img = $row['user_img'];
            $reg_time = $row['reg_time'];

            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td><img class='img-responsive' src='../images/profile/$user_img' alt='test-image' width='100' height='100'></td>";
            echo "<td>$user_firstname</td>";
            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";
            // echo "<td>$user_role</td>";
            echo "<td>$reg_time</td>";
            echo "
                <td>
                    <a href='users.php?source=edit_user&user_id=$user_id' class='btn btn-primary'>Edit</a>
                    <a href='users.php?delete=$user_id' class='btn btn-danger'>Delete</a>
                </td>
                ";
            echo "</tr>";
        }
    }

    function add_user() {
        global $con;
        global $table_users;

        if (isset($_POST['create_user'])) {
            $username = mysqli_real_escape_string($con, $_POST['username']);
            $password = mysqli_real_escape_string($con, $_POST['password']);
            $md5_new = md5($password);
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
                    '$md5_new',
                    '$user_firstname',
                    '$user_lastname',
                    '$user_email',
                    '1',
                    '$user_img',
                    now()
                    );";
            $query = mysqli_query($con, $sql);
            if (!$query) {
                die("Query failed!" . mysqli_error($con));
            } else {
                echo "<p class='bg-success'>A new user is created successfully! <a href='users.php'>View Users</a></p>";
            }

        }
    }

    function delete_user() {
        global $con;
        global $table_users;

        if (isset($_GET['delete'])) {
            $delete_user_id = $_GET['delete'];
            $sql = "DELETE FROM $table_users WHERE user_id = $delete_user_id;";
            $query = mysqli_query($con, $sql);
            if (!$query) {
                die("Query failed ! " . mysqli_error($con));
            } else {
                header("Location: users.php");
            }
        }
    }




?>
