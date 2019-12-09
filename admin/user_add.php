<?php include 'inc/header.php';
  Permission::owner();
?>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/navbar.php';?>

<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
      //var_dump(empty($_POST['status']));
    $error = "";
    if(empty($_POST['username'])){
        $error .="<span class='text-danger'>Username Required</span><br/>";
    }elseif(empty($_POST['email'])){
        $error .="<span class='text-danger'>Email Required</span><br/>";
    }elseif(empty($_POST['password'])){
        $error .="<span class='text-danger'>Password Required</span><br/>";
    }elseif(empty($_POST['confirm_password'])){
        $error .="<span class='text-danger'>Confirm Password Required</span><br/>";
    }elseif($_POST['status']==NULL){
        $error .="<span class='text-danger'>Privelege Required</span><br/>";
    }else{
        $username = $fm->validation($_POST['username']);
        $email = $fm->validation($_POST['email']);
        $status = $_POST['status'];
        $password = $fm->validation($_POST['password']);
        $confirm_password = $fm->validation($_POST['confirm_password']);

        $username = mysqli_real_escape_string($db->connectDB(),$username);
        $email = mysqli_real_escape_string($db->connectDB(),$email);
        $password = mysqli_real_escape_string($db->connectDB(),$password);
        $confirm_password = mysqli_real_escape_string($db->connectDB(),$confirm_password);

        if($password==$confirm_password){        
        $query = " INSERT INTO 
            `user`(`username`, `password`, `email`, `status`) 
            VALUES ('$username','$password','$email','$status')";

            $insert_row = $db->insert($query);
            if($insert_row){
                $success_msg = "<span class='text-success'>Successfully Added</span>";
            }else{
                $error_msg = "<span class='text-danger'>Couldn't Added</span>";
            }
        }else{
            $error_msg = "<span class='text-danger'>Password & Confrim Password should be same</span>";
        }
    }
  }
?>
      <div class="content">
        <div class="container-fluid">
            <?php
                if(!empty($error)){
                    echo $error;
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
                  <h4 class="card-title">ADD NEW USER</h4>
                  <p class="card-category">Complete your profile</p>
                </div>
                <div class="card-body">
                  <form method="POST" action="" >
                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username</label>
                          <input type="text" class="form-control" name="username">
                        </div>
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="password" class="form-control" name="password">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Confirm Password</label>
                          <input type="password" class="form-control" name="confirm_password">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="email" class="form-control" name="email">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Privileges</label>
                          <select class="form-control" name="status">
                              <option value="">Select User Type</option>
                              <option value="0">Owner</option>
                              <option value="1">Varatia</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    
                    <button type="submit" class="btn btn-info btn-lg pull-right">Add New User</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
           
        </div>

        <div class="row">
            <div class="col-md-4">
                <a href="user_view.php">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title text-center" style="height:100px;font-size:20px;position:relative;top:50px;">View All User</h4>
                        <p class="card-category"></p>
                    </div>
                </div>
                </a>
            </div>
            
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div>
          
        </div>
      </div>

<?php include 'inc/footer.php';?>