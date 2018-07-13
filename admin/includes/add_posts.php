<?php 
       if(isset($_POST['create_post'])){ //name of the button
     /***Super Global will have names of the input tags in the forms*****/      
           $post_title = $_POST['title']; 
           $post_author = $_POST['author']; 
           $post_cat_id = $_POST['post_category'];
           $post_status = $_POST['post_status'];
           $post_image = $_FILES['image']['name'];
           $post_image_temp = $_FILES['image']['tmp_name'];//We need this to store the chosen image somewhere temprorary
           $post_tags = $_POST['post_tags'];
           $post_content = $_POST['post_content'];
           $post_date = date('d-m-y');
           

           move_uploaded_file($post_image_temp, "../images/$post_image"); //Function used to move files from one folder to another

           $query = "INSERT INTO posts (post_cat_id, post_title,post_author,post_date,post_image,post_content,post_tags,post_status) VALUES('{$post_cat_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')"; //now() is the functions for date
           $add_admin_post = mysqli_query($connection,$query);

           if(!$add_admin_post){
           	global $connection;
           	die("Query Failed ". mysqli_error($connection));
           }

       } 
?>




<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
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
    <input type="text" class="form-control" name="author">
  </div>
  <div class="form-group">
    <label for="post_status">Post Status</label>
    <input type="text" class="form-control" name="post_status">
  </div>
  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags">
  </div>
 <div class="form-group">
    <label for="exampleInputFile">Post Images</label>
    <input type="file" class="form-control-file" name="image">
   </div>
  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" id="" cols="30" rows="10" ></textarea>
  </div>
  
  <div class="form-group">
  	<input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
  </div>         

</form>