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
                        Welcome, 
                        <small><?php echo $_SESSION['username']; ?></small> !
                    </h1>
                    <?php
                        if (isset($_GET['source'])) {
                            $source = $_GET['source'];
                        } else {
                            $source = '';
                        }
                        switch($source) {
                            case 'add_user':
                                include 'includes/adduser.php';
                                break;
                            case 'edit_user':
                                include 'includes/edituser.php';
                                break;
                            default:
                                include 'includes/allusers.php';
                                break;
                        }
                    ?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<!-- Footer -->
<?php include "includes/footer.php"; ?>