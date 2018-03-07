<?php

    function query_cat() {
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
            echo "<td class='btn btn-success'><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
            echo "<td class='btn btn-danger'><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
            echo "</tr>";
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

?>