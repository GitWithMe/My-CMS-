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

                       <table class="table table-bordered table-hover">
                           <thead>
                               <tr>
                                   <th>ID</th>
                                   <th>Author</th>
                                   <th>Title</th>
                                   <th>Category</th>
                                   <th>Status</th>
                                   <th>Image</th>
                                   <th>Tags</th>
                                   <th>Comments</th>
                                   <th>Date</th>
                               </tr>
                           </thead>
                           <tbody>

                    <?php 

                   $query = "SELECT * FROM posts";
                   $getpost = mysqli_query($connection,$query);
                   if(!$getpost){
                    die("Query Failed".mysqli_error($connection));
                   }
                   while($row = mysqli_fetch_assoc($getpost)){
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_cat_id = $row['post_cat_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comments_count = $row['post_comments_count'];
                    $post_date = $row['post_date'];

                    echo "<tr><td>{$post_id}</td>
                               <td>{$post_author}</td>
                               <td>{$post_title}</td>
                               <td>{$post_cat_id}</td>
                               <td>{$post_status}</td>
                               <td><img class='img-responsive' src='../images/{$post_image}'></td>
                               <td>{$post_tags}</td>
                               <td>{$post_comments_count}</td>
                               <td>{$post_date}</td></tr>
                    ";

                   }
         
                    ?>
                     

                               
                           </tbody>
                       </table>
                       
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