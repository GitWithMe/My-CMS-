<?php include "includes/header.php"; ?>
    <div id="wrapper">

      <?php include "includes/navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Welcome to Admin(Posts)
                         <small>Author</small>
                       </h1>

                       <?php 

                     if(isset($_GET['source'])){
                        $source = $_GET['source'];
                     }
                     else{
                        $source = '';
                     }
                     switch ($source) {
                         case 'add_posts':
                             include "includes/add_posts.php";
                             break;
                         case 'update_post':
                             include "includes/update_post.php";
                             break;    
                         
                         default:
                            include 'view_posts.php';
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

    </div>
    <!-- /#wrapper -->

  <?php include "includes/footer.php"; ?>