<?php  include "includes/db.php"; ?>
 <?php  include "includes/headers.php"; ?>
 <?php
 if(isset($_POST['submit'])){ //name of the submit button
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  if(!empty($username) && !empty($password) && !empty($email)){
    $query = "SELECT randSalt FROM users";
  $encrypt_pass = mysqli_query($connection,$query);
  if(!$encrypt_pass){
    die("Query Failed ". mysqli_error($connection));
  }
  while($row = mysqli_fetch_assoc($encrypt_pass)){
    $salt = $row['randSalt'];
    $password = crypt($password,$salt);

    $query = "INSERT INTO users (username, user_email, user_password, user_role) VALUES('{$username}', '{$email}', '{$password}', 'subscriber')";
    $register_user = mysqli_query($connection,$query);
    if(!$register_user){
        die("Query Failed ".mysqli_error($connection));
    }

  }

  
  }
 }
 ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footers.php";?>
