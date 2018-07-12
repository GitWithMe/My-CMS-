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

               /********************Pulling Data from post id into the DOM**********************/
             if(isset($_GET['p_id'])){ //link in line 44 of index.php
              
              $my_post_id = $_GET['p_id'];
             }

                $fetch_posts= "SELECT * FROM posts where post_id = $my_post_id";
                $result = mysqli_query($connection,$fetch_posts);
                
                while($row = mysqli_fetch_assoc($result)){
                   
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
                    <a href="#"><?php echo $post_title ?></a>
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

           <?php 
       if(isset($_POST['create_comment'])){ //name of the button
     /***Super Global will have names of the input tags in the forms*****/      
           $the_post_id = $_GET['p_id'];

           $comment_author = $_POST['comment_author']; 
           $comment_email = $_POST['comment_email'];
           $comment_content = $_POST['comment_content'];
   
           $query = "INSERT INTO comments (comment_post_id, comment_author ,comment_email ,comment_content, comment_status, comment_date) VALUES($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())"; //now() is the functions for date
           $add_comment = mysqli_query($connection,$query);

           if(!$add_comment){
            global $connection;
            die("Query Failed ". mysqli_error($connection));
           }
//So Every time we make a comment, we have to increment the value of the post_comment_count
    $query = "UPDATE posts SET post_comments_count = post_comments_count + 1 WHERE post_id = $the_post_id ";
           $update_comment_count = mysqli_query($connection,$query);
           if(!$update_comment_count){
            die("Query Failed ".mysqli_error($connection));
           }

       } 
?>       <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label for="Name">Name</label>
                           <input type="text" class="form-control" name="comment_author" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                           <input type="email" class="form-control" name="comment_email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <label for="Comment">Comment</label>
                            <textarea class="form-control" name="comment_content" rows="3" placeholder="Your Comment"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

             <?php 
               //my_post_id is taken from line 26 of this file
               $query = "SELECT * FROM comments WHERE comment_post_id = $my_post_id AND comment_status = 'approved' ORDER BY comment_id DESC";
               $select_comment = mysqli_query($connection,$query);

               if(!$select_comment){
                die("Query Failed ".mysqli_error($connection));
               }
                while($row = mysqli_fetch_assoc($select_comment)){
                    
                    $comment_author = $row['comment_author'];
                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date'];
                    ?>

                     <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>

              <?php  } ?>
             
                </div>

           <!-- Blog Sidebar Widgets Column -->
         

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php
          include "includes/footers.php";
        ?>
