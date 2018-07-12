<?php 
  /******************Query for Getting the Data from the posts table*************/
if(isset($_GET['p_id'])){
  $update_post_id = $_GET['p_id'];
}
                   $query = "SELECT * FROM posts WHERE post_id = $update_post_id";
                   $updatepost = mysqli_query($connection,$query);
                   if(!$updatepost){
                    die("Query Failed".mysqli_error($connection));
                   }
                   while($row = mysqli_fetch_assoc($updatepost)){
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_cat_id = $row['post_cat_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comments_count = $row['post_comments_count'];
                    $post_date = $row['post_date'];
                    $post_content = $row['post_content']; 
                 }     

?>
<?php
 /***********************Update the Data in the posts table*********************/
 if(isset($_POST['update_post'])) { //Name of the button
           $post_title = $_POST['title']; 
           $post_author = $_POST['author']; 
           $post_cat_id = $_POST['post_category'];//Same Name as the select button
           $post_status = $_POST['post_status'];
           $post_image = $_FILES['image']['name'];
           $post_image_temp = $_FILES['image']['tmp_name'];//We need this to store the chosen image somewhere temprorary
           $post_tags = $_POST['post_tags'];
           $post_content = $_POST['post_content'];
           $post_date = date('d-m-y');
           $post_comments_count = 4;
           move_uploaded_file($post_image_temp, "../images/$post_image"); //Function used to move files from one folder to another
           if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $update_post_id";
            $update_image = mysql_query($connection,$query);
           }

      $query = "UPDATE posts SET post_title = '{$post_title}', post_author = '{$post_author}', post_cat_id = '{$post_cat_id}', post_status = '{$post_status}', post_image = '{$post_image}', post_tags = '{$post_tags}', post_content = '{$post_content}', post_date = now(), post_comments_count = '{$post_comments_count}' WHERE post_id = $update_post_id";   
      
      $updated_post = mysqli_query($connection,$query);

      if(!$updated_post){
        die("Query Failed ".mysqli_error($connection));
      }   
 }

?>




<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Post Title</label>
    <input value="<?php echo $post_title;  ?>" type="text" class="form-control" name="title">

  </div>
  <div class="form-group">
    <label for="title">Post Category Title</label>
    <select name="post_category" id="" >
      
       <?php

      $query = "SELECT * FROM categories";
      $select_cat_id = mysqli_query($connection,$query);
        if(!$select_cat_id){
          global $connection;
          die("Query Failed ".mysqli_error($connection));
        }

      while($row = mysqli_fetch_assoc($select_cat_id)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<option value='{$cat_id}'>{$cat_title}</option>";

              }

       ?>
    </select>
    
  </div>
  <div class="form-group">
    <label for="title">Post Author</label>
    <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
  </div>
  <div class="form-group">
    <label for="post_status">Post Status</label>
    <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
  </div>
  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
  </div>
 <div class="form-group">
    <label for="exampleInputFile">Post Images</label>
    <input type="file" name="image" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
   <img width="100" src="../images/<?php echo $post_image; ?>">
   </div>
 <div class="form-group">
    <label for="post_comments_count">Post Comments Count</label>
    <input value="<?php echo $post_comments_count; ?>" type="text" class="form-control" name="post_comments_count">
  </div>
 <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea  class="form-control" name="post_content" id="" cols="30" rows="10" ><?php echo $post_content; ?>
    </textarea>
  </div>
  
  <div class="form-group">
  	<input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
  </div>         

</form>