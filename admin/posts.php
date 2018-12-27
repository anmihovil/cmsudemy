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
                        Post's Table Page
                        <small>Subheading...</small>
                    </h2>

                    <?php
                      if(isset($_GET['source'])){
                        $source = $_GET['source'];
                      }else{
                        $source = '';
                      }

                      switch ($source) {
                        case '100':
                          echo "The Good";
                          break;
                        case '200':
                          echo "The Uggly";
                          break;
                        default:
                          //echo "The Bad";
                          include "includes/view_all_posts.php";
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
<?php include "includes/admin_footer.php"?>
