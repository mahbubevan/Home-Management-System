<?php include 'inc/header.php';
  Permission::owner();
?>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/navbar.php';?>

<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
      //var_dump($_POST['due']);
    $error = "";
    if(empty($_POST['nid'])){
        $error .="<span class='text-danger'>NID Required</span><br/>";
    }elseif(empty($_POST['fair'])){
        $error .="<span class='text-danger'>Fair Required</span><br/>";
    }elseif($_POST['status']==NULL){
        $error .="<span class='text-danger'>Status Required</span><br/>";
    }else{
        $user_id = $_POST['user_id'];
        $varatia_id = $_POST['varatia_id'];
        $nid = $fm->validation($_POST['nid']);
        $total_person = $_POST['total_person'];
        $fair = $_POST['fair'];
        $status = $_POST['status'];
        $due = $_POST['due'];

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if ($file_size >1048567) {
            $error.= "<span class='error text-lg text-danger'>Image Size should be less then 1MB!
            </span>";
        }else if (in_array($file_ext, $permited) === false) {
            $error.= "<span class='error text-lg text-danger'>You should upload only:-"
            .implode(', ', $permited)."</span>";
        }else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO 
                `room`(`user_id`, `varatia_id`, `img`, `nid`, `total_person`, `fair`, `status`, `due`) 
                VALUES ('$user_id','$varatia_id','$uploaded_image','$nid','$total_person','$fair','$status','$due')";
            
            $insert_row = $db->insert($query);

            if($insert_row){
                $success_msg = "<span class='text-success text-lg'>Successfully Added New Varatia</span>";
            }else{
                $error_msg = "<span class='text-danger text-lg'>Couldn't Added New Varatia</span>";
            }
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
                  <h4 class="card-title">ADD NEW ROOM</h4>
                  <p class="card-category">Room Represents Your Varatia</p>
                </div>
                <div class="card-body">
                  <form method="POST" action="" enctype="multipart/form-data">
                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Home Owner </label>
                          <select class="form-control" name="user_id">
                            <?php
                                $query = " SELECT home.*,user.username 
                                    FROM `home`
                                    INNER JOIN `user`
                                    ON
                                    home.user_id = user.id
                                ";
                                $result = $db->select($query);
                                if($result){
                                    while($user= $result->fetch_assoc()){?>
                                    <option value="<?php echo $user['user_id'] ?>"><?php echo $user['username'] ?></option>                                        
                            <?php  }
                                }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Varatia Name</label>
                          <select class="form-control" name="varatia_id">
                            <?php
                                $query = " SELECT *
                                    FROM `user`
                                   WHERE `status` =1;
                                ";
                                $result = $db->select($query);
                                if($result){
                                    while($user= $result->fetch_assoc()){?>
                                    <option value="<?php echo $user['id'] ?>"><?php echo $user['username'] ?></option>                                        
                            <?php  }
                                }
                            ?>
                          </select>
                        </div>
                      </div>
                      
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">NID</label>
                          <input type="text" class="form-control" name="nid">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Fair</label>
                          <input type="text" class="form-control" name="fair">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Due</label>
                          <input type="text" class="form-control" name="due" value="0" hidden ><span class="text-info">0</span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Status</label>
                          <select name="status" id="" class="form-control">
                                <option value="">(Select Varatia Current Status)</option>
                                <option value="0">Regular</option>
                                <option value="1">Irregular</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Total Person</label>
                          <input type="number" class="form-control" name="total_person" value="1">
                        </div>
                      </div>
                      <div class="col-md-9">
                            <label for="image" class="form-control">Upload Image</label>
                            <input type="file" name="image">
                      </div>
                    </div>
                     
                    </div>
                    
                    <button type="submit" class="btn btn-info btn-lg pull-right">Add Room / Varatia</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
           
        </div>

        <div class="row">
            <div class="col-md-4">
                  <a href="room_view.php" class="btn btn-lg btn-info btn-block">View Added Varatia</a>
            </div>
            
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div>
          
        </div>
      </div>

<?php include 'inc/footer.php';?>