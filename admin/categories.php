
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
                        <form action="">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add">
                            </div>
                        </form>
                    </div>

                    <div class="col-xs-6">
                        <?php
                            $sql = "SELECT * FROM {$table_cat};";
                            $query = mysqli_query($con, $sql);
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($row = mysqli_fetch_assoc($query)) {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                        echo "<tr>";
                                        echo "<td>{$cat_id}</td>";
                                        echo "<td>{$cat_title}</td>";
                                        echo "</tr>";
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