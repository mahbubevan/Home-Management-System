<?php include 'inc/header.php';
    Permission::owner();
?>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/navbar.php';?>

<?php
    if(empty($_GET['home_id']) || $_GET['home_id']===NULL){
        echo '<script> window.location = "home_view.php"; </script>';
    }else{
        $home_id = $_GET['home_id'];
        $query = " SELECT home.*,user.username 
                    FROM `user`
                    INNER JOIN `home`
                    ON
                    user.id = home.user_id
                    WHERE home.id='$home_id'
                ";

        $result = $db->select($query);
        if($result){
            while($user = $result->fetch_assoc()){
                //var_dump($user);
                $username = $user['username'];
                $details = $user['details'];
                $address = $user['address'];
                $created_at = $user['created_at'];
                $updated_at = $user['updated_at'];
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
                  <h4 class="card-title">Edit Home</h4>
                  <p class="card-category">Address And Details Can Be Edited!!! </p>
                </div>
                <div class="card-body">
                  <form action="" method="POST">
                    <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username</label>
                          <input type="username" disabled name="username" class="form-control" value="<?php echo $username; ?>">
                        </div>
                      </div>
                    </div>
               
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="bmd-label-floating">Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="bmd-label-floating">Details</label>
                            <input type="text" name="details" class="form-control" value="<?php echo $details; ?>">
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
                <a href="home_view.php" class="btn btn-lg btn-info btn-block">
                    Back
                </a>
            </div>
            
            <div class="col-md-4"> 
                
            </div>
            <div class="col-md-4"></div>
        </div>
          
        </div>
      </div>

<?php include 'inc/footer.php';?>