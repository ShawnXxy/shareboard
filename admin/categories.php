
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
                        Welcome to Admin
                        <small>Author</small>
                    </h1>
                    
                    <div class="col-xs-6">
                        <?php
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
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title" required>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add">
                            </div>
                        </form>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Edit Category</label>
                                <?php
                                    if (isset($_GET['edit'])) {
                                        $edit_cat_id = $_GET['edit'];
                                        $sql = "SELECT * FROM {$table_cat} WHERE cat_id = {$edit_cat_id};";
                                        $query = mysqli_query($con, $sql);

                                        while($row = mysqli_fetch_assoc($query)) {
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                            ?>
                                                <input type="text" class="form-control" value="<?php if (isset($cat_title)) echo $cat_title; ?>" name="cat_title" required>
                                            <?php
                                        }
                                    }
                                ?>
                                <input class="form-control" type="text" name="cat_title" required>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Update">
                            </div>
                        </form>
                    </div>

                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM {$table_cat};";
                                    $query = mysqli_query($con, $sql);

                                    while($row = mysqli_fetch_assoc($query)) {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                        echo "<tr>";
                                        echo "<td>{$cat_id}</td>";
                                        echo "<td>{$cat_title}</td>";
                                        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                                        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                                        echo "</tr>";
                                    }
                                ?>
                                <?php
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
                                ?>
                            </tbody>
                        </table> 
                    </div>
                    
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

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<!-- Footer -->
<?php include "includes/footer.php"; ?>