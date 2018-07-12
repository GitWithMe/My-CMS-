<table class="table table-bordered table-hover">
                           <thead>
                               <tr>
                                   <th>ID</th>
                                   <th>Post ID</th>
                                   <th>Author</th>
                                   <th>E-mail</th>
                                   <th>Content</th>
                                   <th>Status</th>
                                   <th>In Response To</th>
                                   <th>Date</th>
                                   <th>Approve</th>
                                   <th>UnApprove</th>
                                  <th>Delete</th>
                               </tr>
                           </thead>
                           <tbody>

                    <?php 

                   $query = "SELECT * FROM comments";
                   $getcomments = mysqli_query($connection,$query);
                   if(!$getcomments){
                    die("Query Failed".mysqli_error($connection));
                   }
                   while($row = mysqli_fetch_assoc($getcomments)){
                    $comment_id = $row['comment_id'];
                    $comment_author = $row['comment_author'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_email = $row['comment_email'];
                    $comment_status = $row['comment_status'];
                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date'];
                    
                    

                    echo "<tr><td>{$comment_id}</td>
                          <td>{$comment_post_id}</td>
                          <td>{$comment_author}</td>";
                    
                    
                    echo "<td>{$comment_email}</td>";
                  

                    echo  "<td>{$comment_content}</td>

                           <td>{$comment_status}</td>";

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
                    //UNAPPROVE
                    if(isset($_GET['unapprove'])){
                      $unapprove_comment_id = $_GET['unapprove'];
                    /*************MYSQL query for UNAPPROVING that ID from the database******/
                        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $unapprove_comment_id ";
                        $unapprove_comment = mysqli_query($connection,$query);
                        header("Location: comments.php");
                   }

                   //APPROVE
                    if(isset($_GET['approve'])){
                        $approve_comment_id = $_GET['approve'];

                    /*************MYSQL query for APPROVING that ID from the database******/
                        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $approve_comment_id ";
                        $approve_comment = mysqli_query($connection,$query);
                        header("Location: comments.php");
                   }


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
                       