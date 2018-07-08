
               <!-- Form to Edit the Category -->
               <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Update Category</label>

                                 <?php 
                   /***************Editing the title and update them into the Database*****/             
                            if(isset($_GET['edit'])){
                                $edit_cat_id = $_GET['edit'];

                                $query = "SELECT * FROM categories WHERE cat_id = {$edit_cat_id}";
                                $edit_query = mysqli_query($connection,$query);

                                if(!$edit_query){
                                    die("Query Failed".mysqli_error($connection));
                                }
                                while($row = mysqli_fetch_assoc($edit_query)){
                                     $cat_title = $row['cat_title'];
                                     $cat_id = $row['cat_id'];
                                     ?>
                               <input type="text" class="form-control" name="cat_title" value="<?php 
                                if(isset($cat_title)){
                                    echo $cat_title;
                                }
                                
                               ?>">

                          <?php  }} ?>

                          <?php 
                               if(isset($_POST['update_cat'])){
                                $update_title = $_POST['cat_title'];

                                $query = "UPDATE categories SET cat_title = '{$update_title}' WHERE cat_id = {$cat_id}";
                                $update_cat_title = mysqli_query($connection,$query);
                                   if(!$update_cat_title){
                                    die("Query Failed".mysqli_error($connection));
                                   }

                               }

                          ?>

                                </div>
                                <div class="form-group">
                                    <input type="submit" name="update_cat" class="btn btn-primary" value="Update Category">
                                </div>
                                
                            </form>