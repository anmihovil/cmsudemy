<?php include "includes/admin_header.php"?>

    <div id="wrapper">
        <!-- Navigation -->
<?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">
                            Welcome to <?php echo " ".$_SESSION['user_firstname'];?>
                            <small>Subheading...</small>
                        </h2>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>

        <!-- /#page-wrapper -->
    <?php include "includes/admin_footer.php"?>
