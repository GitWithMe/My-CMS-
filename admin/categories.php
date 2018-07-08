<?php include "includes/header.php"; ?>
    <div id="wrapper">

      <?php include "includes/navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small>Author</small>
                        </h1>


                        <div class="col-xs-6">

                          <?php 
                 /***********************If Submit Button is Pressed*****************/         
                            if(isset($_POST['submit'])){
                                $cat_title = $_POST['cat_title'];

                                if($cat_title == "" || empty($cat_title)){
                                    echo "Please Enter the Field";
                                }else{
                /**************Enter the SUBMITTED data inside the Database***********/                    
                                    $query = "INSERT INTO categories(cat_title) VALUE ('{$cat_title}')";
                                    $insert_title = mysqli_query($connection,$query); 
                                    if(!$insert_title){
                                        die("Query Failed". mysql_error($connection));
                                    }
                                }
                            }

                          ?>


                      <!-- form to Add Category -->

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
                                </div>
                                
                            </form>
<?php
         if (isset($_GET['edit'])){
            $cat_id = $_GET['edit'];
             include "includes/update_cat.php";
         } 

         ?>

                            
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                               <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                              
                                    <?php 
    /******************** Pulling Data from cat_title column into the DOM **********************/
                  $fetch_cat_title="SELECT * FROM categories";
                  $result_categories = mysqli_query($connection,$fetch_cat_title);
                      
                                 while($row = mysqli_fetch_assoc($result_categories)){
                                     $cat_title = $row['cat_title'];
                                     $cat_id = $row['cat_id'];
                                     echo "<tr><td>{$cat_id}</td>
                                            <td>{$cat_title}</td>";
                                       /***Deleting an ID from the table******/     
                                     echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";   
                                      echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td></tr>";       
                                   }
                               
                                ?>

                   <?php 
                   
                      if(isset($_GET['delete'])){
                        $del_cat_id = $_GET['delete'];
                    /*************MYSQL quer for DELETING that ID from the database******/
                        $query = "DELETE FROM categories WHERE cat_id = {$del_cat_id} ";
                        $del_query = mysqli_query($connection,$query);
                        header("Location: categories.php");//Refreshes the categories.php page to take effect

                        if(!$del_query){
                            die("Query Failed".mysqli_error($connection));
                        }
                      }
                
                   ?>             
                                  
                                </tbody>
                                
                            </table>
                        </div>
             </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

  <?php include "includes/footer.php"; ?>