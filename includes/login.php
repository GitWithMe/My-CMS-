<?php include "db.php"; ?>
<?php session_start(); ?>
<?php

if(isset($_POST['login'])){

	 $username = $_POST['username'];
	 $password = $_POST['password'];

	 $query = "SELECT * FROM users WHERE username = '{$username}'";
	 $login_username = mysqli_query($connection,$query);
	 if(!$login_username){
	 	die("Query Failed ".mysqli_error($connection));
	 }
	 while($row = mysqli_fetch_assoc($login_username)){
	 	$db_id = $row['user_id'];
	 	$db_username = $row['username'];
	 	$db_password = $row['user_password'];
	 	$db_user_firstname = $row['user_firstname'];
	 	$db_user_lastname = $row['user_lastname'];
	 	$db_user_role = $row['user_role'];
	 }

	 //If the entered username and password entered in the form do not match with the username and password present in the database then we should be redirected to the index page
	
	if($username === $db_username && $password === $db_password ){

	 	$_SESSION['username'] = $db_username; //Assigning the value
	 	$_SESSION['firstname'] = $db_user_firstname;
	 	$_SESSION['lastname'] = $db_user_lastname;
	 	$_SESSION['user_role'] = $db_user_role;


	 	header("Location: ../admin");
	 }else{
	 	header("Location: ../index.php");
	 }
}

?>