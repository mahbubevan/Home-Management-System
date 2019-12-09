<?php include 'inc/header.php';
  Permission::owner();
?>

<?php include 'inc/sidebar.php';?>
<?php include 'inc/navbar.php';?>


<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
      //var_dump($_POST['user_id']);
    $error = "";
    if(empty($_POST['user_id'])){
        $error .="<span class='text-danger'>Owner Required</span><br/>";
    }elseif(empty($_POST['address'])){
        $error .="<span class='text-danger'>Address Required</span><br/>";
    }elseif(empty($_POST['details'])){
        $error .="<span class='text-danger'>Details Required</span><br/>";
    }else{
        $user_id = $_POST['user_id'];
        $address = $_POST['address'];
        $details = $_POST['details'];

        $query = "INSERT INTO `home`(`user_id`, `address`, `details`) 
            VALUES ('$user_id','$address','$details')";

        $insert_row = $db->insert($query);
        if($insert_row){
            $success_msg = "<span class='text-success'>Successfully Added</span>";
        }else{
            $error_msg = "<span class='text-danger'>Couldn't Added</span>";
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
                  <h4 class="card-title">ADD NEW HOME</h4>
                  <p class="card-category">Complete your home details</p>
                </div>
                <div class="card-body">
                  <form method="POST" action="" >
                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username</label>
                          <select class="form-control" name="user_id">
                          <?php
                            $query = " SELECT user.username, owner.*
                            FROM `user`
                            INNER JOIN `owner`
                            ON
                            user.id = owner.user_id
                            ";
                            $result = $db->select($query);
                            if($result){
                                while($owner = $result->fetch_assoc()){?>
                                <option value="<?php echo $owner['user_id'];?>"><?php echo $owner['username'];?></option>
                            <?php }}?>
                          </select>
                        </div>
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Address</label>
                          <input type="text" class="form-control" name="address">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Details</label>
                          <input type="text" class="form-control" name="details">
                        </div>
                      </div>
                    </div>
                     
                    </div>
                    
                    <button type="submit" class="btn btn-info btn-lg pull-right">Add Home</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
           
        </div>

        <div class="row">
            <div class="col-md-4">
            </div>
            
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div>
          
        </div>
      </div>

<?php include 'inc/footer.php';?>