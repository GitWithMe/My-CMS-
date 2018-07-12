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
                                   <th>Edit</th>
                                  
                                  <th>Delete</th>
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

                           <td>{$user_role}</td>";

             $query = "SELECT * FROM posts WHERE post_id = $comment_post_id"; 
             $response_title = mysqli_query($connection,$query);

             if(!$response_title){
              die("Query Failed ".mysqli_error($connection));
             } 
                      while($row = mysqli_fetch_assoc($response_title)) { 
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];

                       echo "<td><a href='posts.php?p_id=$post_id'>$post_title</a></td>";


                  }

                        echo " <td>{$comment_date}</td>
                          <td><a href='comments.php?approve={$comment_id}'>Approve</a></td>
                          <td><a href='comments.php?unapprove={$comment_id}'>UnApprove</a></td>
                          <td><a href='comments.php?delete={$comment_id}'>Delete</a></td></tr>";
                          
                    

                   }

         
                    ?>



                    <?php 
                    
                   //DELETE
                      if(isset($_GET['delete'])){
                        $del_comment_id = $_GET['delete'];
                    /*************MYSQL query for DELETING that ID from the database******/
                        $query = "DELETE FROM comments WHERE comment_id = {$del_comment_id} ";
                        $del_query = mysqli_query($connection,$query);
                        header("Location: comments.php");//Refreshes the categories.php page to take effect

                        if(!$del_comment_id){
                          global $connection;
                            die("Query Failed".mysqli_error($connection));
                        }
                      }
                
                   ?>           
                     
                           </tbody>
                       </table>
                       