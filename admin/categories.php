<?php
    include "functions.php";
?>

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
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                    
                    <div class="col-xs-6">
                        <form action="" method="post">
                            <!-- Insert category -->
                            <?php insert_cat(); ?>
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title" required>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success" type="submit" name="submit" value="Add">
                            </div>                          
                        </form>

                        <form action="" method="post">
                            <!-- EDIT category -->
                            <?php edit_cat(); ?>
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
                                <!-- loading category data from db -->
                                <?php load_cat(); ?>
                                <!-- DELETE category -->
                                <?php delete_cat(); ?>
                            </tbody>
                        </table> 
                    </div>
                    
                    <!-- <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
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