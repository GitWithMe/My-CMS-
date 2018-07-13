<?php 
  /******************Query for Getting the Data from the posts table*************/
if(isset($_GET['u_id'])){
  $update_user_id = $_GET['u_id'];
}
                   $query = "SELECT * FROM users WHERE user_id = $update_user_id";
                   $updateuser = mysqli_query($connection,$query);
                   if(!$updateuser){
                    die("Query Failed".mysqli_error($connection));
                   }
                   while($row = mysqli_fetch_assoc($updateuser)){
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    $user_password = $row['user_password'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_role = $row['user_role'];
                    $user_email = $row['user_email'];
                    $user_image = $row['user_image'];
                 }     

?>
<?php
 /***********************Update the Data in the posts table*********************/
 if(isset($_POST['update_user'])) { //Name of the button
           $username = $_POST['username']; 
           $user_password = $_POST['user_password']; 
           $user_firstname = $_POST['user_firstname'];
           $user_lastname = $_POST['user_lastname'];
           $user_image = $_FILES['image']['name'];
           $user_image_temp = $_FILES['image']['tmp_name'];//We need this to store the chosen image somewhere temprorary
           $user_role = $_POST['user_role'];
           $user_email = $_POST['user_email'];
           

           move_uploaded_file($user_image_temp, "../images/$user_image"); //Function used to move files from one folder to another
           if(empty($user_image)){
            $query = "SELECT * FROM users WHERE user_id = $update_user_id";
            $update_image = mysql_query($connection,$query);
           }

      $query = "UPDATE users SET username = '{$username}', user_password = '{$user_password}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_image = '{$user_image}', user_role = '{$user_role}', user_email = '{$user_email}' WHERE user_id = $update_user_id";   
      
      $updated_user = mysqli_query($connection,$query);

      if(!$updated_user){
        die("Query Failed ".mysqli_error($connection));
      }   
 }

?>




<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Username</label>
    <input value="<?php echo  $username; ?>" type="text" class="form-control" name="username">
  </div>
 <div class="form-group">
    <label for="title">Password</label>
    <input value="<?php echo $user_password; ?>" type="text" class="form-control" name="user_password">
  </div>
  <div class="form-group">
    <label for="post_status">First Name</label>
    <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
  </div>
  <div class="form-group">
    <label for="post_tags">Last Name</label>
    <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
  </div>
<div class="form-group">
    <label for="post_tags">User Role</label>
    <input value="<?php echo $user_role; ?>" type="text" class="form-control" name="user_role">
  </div>
 <div class="form-group">
    <label for="post_comments_count">User Email</label>
    <input value="<?php echo $user_email; ?>" type="text" class="form-control" name="user_email">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">User Images</label>
    <input type="file" class="form-control-file" name="image">
    <img width="100" src="../images/<?php echo $user_image; ?>">
   </div>
   <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
  </div>         

</form>