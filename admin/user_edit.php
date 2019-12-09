<?php include 'inc/header.php';
  Permission::owner();
?>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/navbar.php';?>

<?php
    if(empty($_GET['user_id']) || $_GET['user_id']===NULL){
        echo '<script> window.location = "user_view.php"; </script>';
    }else{
        $user_id = $_GET['user_id'];
        $query = "SELECT * FROM `user` WHERE `id`='$user_id'";

        $result = $db->select($query);
        if($result){
            while($user = $result->fetch_assoc()){
                $username = $user['username'];
                $email  = $user['email'];
                $status = $user['status'];
            }
        }
    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $error = "";
        if(empty($_POST['username'])){
            $error .="<span class='text-danger'>Username Required</span><br/>";
        }elseif(empty($_POST['email'])){
            $error .="<span class='text-danger'>Email Required\n</span><br/>";
        }elseif($_POST['status']==NULL){
            $error .="<span class='text-danger'>Privelege Required\n</span><br/>";
        }else{
            $username = $fm->validation($_POST['username']);
            $email = $fm->validation($_POST['email']);
            $status = $_POST['status'];

            $username = mysqli_real_escape_string($db->connectDB(),$username);
            $email = mysqli_real_escape_string($db->connectDB(),$email);

            $query = " UPDATE `user` 
                        SET
                        `username` = '$username',
                        `email`    = '$email',
                        `status`   = '$status'
                    WHERE `id` = '$user_id'
            ";

            $updated_row = $db->update($query);
            if($updated_row){
                $success_msg = "<span class='text-success'>Successfully Updated</span>";
            }else{
                $error_msg = "<span class='text-danger'>Couldn't Updated</span>";
            }
            
        }
    }
?>
      <div class="content">
        <div class="container-fluid">
            <?php
                if(!empty($error)){
                    echo $error;
                    $error = NULL;
                }

                if(!empty($success_msg)){
                    echo $success_msg;
                }

                if(!empty($error_msg)){
                    echo $error_msg;
                }

            ?>
        <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Edit User</h4>
                  <p class="card-category">Edit user credential</p>
                </div>
                <div class="card-body">
                  <form action="" method="POST">
                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                        </div>
                      </div>

                    </div>
                    <!-- <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="password" class="form-control">
                        </div>
                      </div>
                    </div> -->
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Privileges</label>
                          <select class="form-control" name="status">
                              <option value="<?php echo $status;?>">
                                <?php  
                                    if($status==0){
                                        echo 'Owner';
                                    }else{ 
                                        echo 'Varatia';
                                    }
                                ?>
                              </option>
                              <option value="0">Owner</option>
                              <option value="1">Varatia</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success btn-lg pull-right">Update</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
           
        </div>

        <div class="row">
            <div class="col-md-4">
                <a href="user_view.php" class="btn btn-lg btn-info btn-block">
                    View All User
                </a>
            </div>
            
            <div class="col-md-4"> 
                <a href="" class="btn btn-lg btn-info btn-block">Update Password Here</a>
            </div>
            <div class="col-md-4"></div>
        </div>
          
        </div>
      </div>

<?php include 'inc/footer.php';?>