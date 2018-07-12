<?php
include "includes/headers.php";
include "includes/db.php";
?>

    <!-- Navigation -->
    <?php
include "includes/navigation.php";

?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
               
               <?php
               if(isset($_GET['category'])){
                $fetch_cat = $_GET['category'];
               }
               /******************** Pulling Data from posts table into the DOM **********************/
                $fetch_posts= "SELECT * FROM posts WHERE post_cat_id = $fetch_cat";
                $result = mysqli_query($connection,$fetch_posts);
                
                while($row = mysqli_fetch_assoc($result)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                     ?>
                 
                 <h5><strong>
                    <?php echo $post_tags ?> </strong>
                    <small>Secondary Text</small>
                </h5>

                <!-- First Blog Post -->
                <h2>
                   <!--When a title is clicked on index page, the link takes the user to the post.php page with the ID of that post only -->
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a> 
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

           <?php  }  ?>

                

               
               
                
               </div>

            <!-- Blog Sidebar Widgets Column -->
          <?php
          include "includes/sidebar.php";
        ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php
          include "includes/footers.php";
        ?>
