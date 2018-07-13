<table class="table table-bordered table-hover">
                           <thead>
                               <tr>
                                   <th>ID</th>
                                   <th>Username</th>
                                   <th>Password</th>
                                   <th>First Name</th>
                                   <th>Last Name</th>
                                   <th>Role</th>
                                   <th>E-Mail</th>
                                   <th>Image</th>
                                   <th>Delete</th>
                                  
                                  <th>Edit</th>
                               </tr>
                           </thead>
                           <tbody>

                    <?php 

                   $query = "SELECT * FROM users";
                   $getusers = mysqli_query($connection,$query);
                   if(!$getusers){
                    die("Query Failed".mysqli_error($connection));
                   }
                   while($row = mysqli_fetch_assoc($getusers)){
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    $user_password = $row['user_password'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_role = $row['user_role'];
                    $user_email = $row['user_email'];
                    $user_image = $row['user_image'];
                    

                    echo "<tr><td>{$user_id}</td>
                          <td>{$username}</td>
                          <td>{$user_password}</td>";
                    
                    
                    echo "<td>{$user_firstname}</td>";
                  

                    echo  "<td>{$user_lastname}</td>

                           <td>{$user_role}</td>
                           <td>{$user_email}</td>
                           <td><img class='img-responsive' width='50' src='../images/{$user_image}'></td>
                           <td><a href='users.php?delete={$user_id}'>Delete</a></td>
                           <td><a href='users.php?source=update_user&u_id={$user_id}'>Edit</a></td></tr>
                          ";
                        }

             ?>
                    <?php 
                    
                   //DELETE
                      if(isset($_GET['delete'])){
                        $del_user_id = $_GET['delete'];
                    /*************MYSQL query for DELETING that ID from the database******/
                        $query = "DELETE FROM users WHERE user_id = {$del_user_id} ";
                        $del_user = mysqli_query($connection,$query);
                        header("Location: users.php");//Refreshes the categories.php page to take effect

                        if(!$del_user_id){
                          global $connection;
                            die("Query Failed ".mysqli_error($connection));
                        }
                      }
                
                   ?>           
                     
                           </tbody>
                       </table>
                       