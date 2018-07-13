<?php 
       if(isset($_POST['create_user'])){ //name of the button
     /***Super Global will have names of the input tags in the forms*****/      
           $username = $_POST['username']; 
           $user_password = $_POST['user_password']; 
           $user_firstname = $_POST['user_firstname'];
           $user_lastname = $_POST['user_lastname'];
           $user_image = $_FILES['image']['name'];
           $user_image_temp = $_FILES['image']['tmp_name'];//We need this to store the chosen image somewhere temprorary
           $user_role = $_POST['user_role'];
           $user_email = $_POST['user_email'];
           

           move_uploaded_file($user_image_temp, "../images/$user_image"); //Function used to move files from one folder to another

           $query = "INSERT INTO users (username, user_password,user_firstname,user_lastname,user_image,user_role,user_email) VALUES('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_image}', '{$user_role}', '{$user_email}')"; 
           $add_user = mysqli_query($connection,$query);

           if(!$add_user){
           	global $connection;
           	die("Query Failed ". mysqli_error($connection));
           }

       } 
?>




<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Username</label>
    <input type="text" class="form-control" name="username">
  </div>
 <div class="form-group">
    <label for="title">Password</label>
    <input type="text" class="form-control" name="user_password">
  </div>
  <div class="form-group">
    <label for="post_status">First Name</label>
    <input type="text" class="form-control" name="user_firstname">
  </div>
  <div class="form-group">
    <label for="post_tags">Last Name</label>
    <input type="text" class="form-control" name="user_lastname">
  </div>
<div class="form-group">
    <label for="post_tags">User Role</label>
    <input type="text" class="form-control" name="user_role">
  </div>
 <div class="form-group">
    <label for="post_comments_count">User Email</label>
    <input type="text" class="form-control" name="user_email">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">User Images</label>
    <input type="file" class="form-control-file" name="image">
   </div>
   <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
  </div>         

</form>