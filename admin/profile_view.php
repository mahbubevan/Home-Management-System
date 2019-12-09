<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/navbar.php';?>

<?php

if(Permission::varatia_profile_check()){

    $username = Session::get('username');
    $user_id = Session::get('id');
    $user_authorization = Session::get('status');
   
    if($user_authorization==0){
            $data = "PROFILE MANAGES IS NOT AVAILABLE";
    }else{
        $query = "SELECT user.username,user.email,room.*
        FROM user
        INNER JOIN room
        ON
        user.id = room.varatia_id
        WHERE user.id = $user_id
        ";
        $result = $db->select($query);
        if($result){
            while($user_get_data = $result->fetch_assoc()){
                $db_room_id = $user_get_data['id'];
                $db_varatia_name = $user_get_data['username'];
                $db_varatia_email = $user_get_data['email'];
                $db_owner_id = $user_get_data['user_id'];
                $db_varatia_id = $user_get_data['varatia_id'];
                $db_varatia_img = $user_get_data['img'];
                $db_varatia_nid = $user_get_data['nid'];
                $db_varatia_total_person = $user_get_data['total_person'];
                $db_varatia_fair = $user_get_data['fair'];
                $db_varatia_due = $user_get_data['due'];
                $db_varatia_status = $user_get_data['status'];
                $db_varatia_entry_date = $user_get_data['created_at'];
                $db_varatia_last_payment_date = $user_get_data['updated_at'];
            }
        }
    }

    
        $query2 = "SELECT `username` FROM `user` WHERE `id` = '$db_owner_id'";
        $result2 = $db->select($query2);
        if($result2){
            while($user = $result2->fetch_assoc()){
                $owner_name = $user['username'];
            }
        }


    if($_SERVER['REQUEST_METHOD']=='POST'){
      if(empty($_POST['username']) || empty($_POST['email'])){
        $error = "<span class='text-danger' style='font-size:18px;font-weight:bold'>Required Fileds !!</span>";
      }else{
        if(empty($_POST['image'])){
            $user_name = $_POST['username'];
            $user_email = $_POST['email'];

            $update_query = "UPDATE `user` 
                          SET
                          `username` = '$user_name',
                          `email` = '$user_email'
                        WHERE `id` = '$user_id'
                    ";
              $updated_row = $db->update($update_query);


            if($updated_row){
              $success_msg = "<span class='text-success text-lg'>Successfully Updated</span>";
            }else{
                $error_msg = "<span class='text-danger text-lg'>Couldn't Updated</span>";
            }
        }else{
          if($db_varatia_img){
            $previous_image = $db_varatia_img;
            unlink($previous_image);
          }

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
            $img_query = "UPDATE `room` 
                        SET
                        `img` = '$uploaded_image'
                      WHERE `varatia_id` = '$db_varatia_id'
              ";
            
            $img_update = $db->update($img_query);

          }

          $user_name = $_POST['username'];
          $user_email = $_POST['email'];

          $update_query = "UPDATE `user` 
                          SET
                          `username` = '$user_name',
                          `email` = '$user_email'
                        WHERE `id` = '$user_id'
                    ";

          $update_row = $db->update($update_query);
          if($img_update){
            $success_msg = "<span class='text-success text-lg'>Successfully Updated</span>";
          }else{
            $error_msg = "<span class='text-danger text-lg'>Couldn't Updated</span>";
            }

        }
      }
    }
    
?>

<div class="content">
        <div class="container-fluid">
        <?php
          if(isset($error)){
            echo $error;
          }

          if(isset($error_msg)){
            echo $error_msg;
          }

          if(isset($success_msg)){
            echo $success_msg;
          }
        ?>
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title"><span class="text-white" style="font-size:15px;font-weight:bold">PROFILE</span></h4>
                  <p class="card-category"><span class="text-white" style="font-size:20px;font-weight:bold">Manage Your Profile [NAME,EMAIL]</span></p>
                </div>
                <div class="card-body">
                  <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Home Owner (disabled)</label>
                          <input type="text" class="form-control" disabled value="<?php echo $owner_name;?>" >
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $db_varatia_name ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address</label>
                          <input type="email" name="email" class="form-control" value="<?php echo $db_varatia_email ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="">
                          <input type="file" name="image" id="">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
              <div class="card card-profile">
                <div class="card-body">
                  <p class="card-description">
                    <p style="font-size:15px;font-weight:bold">You'r Due: <span class="text-info" style="font-weight:bold;font-size:20px"><?php echo $db_varatia_due ?></span> </p>
                    <p style="font-size:15px;font-weight:bold">Current Status: <span style="font-weight:bold;font-size:20px"><?php if($db_varatia_status==0){echo '<span class="text-success">Regular</span>';}else{echo '<span class="text-danger">Irregular</span><span style="font-size:12px">( Contact With Your Home Owner)</span>';} ?></span> </p>
                    <p style="font-size:15px;font-weight:bold">Status Updated At: <span class="text-info" style="font-weight:bold;font-size:20px"><?php echo $fm->format_date($db_varatia_last_payment_date) ?></span> </p>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="row">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="#pablo">
                    <img class="img" src="<?php echo $db_varatia_img; ?>" />
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category text-gray"><?php echo $db_varatia_email; ?></h6>
                  <h4 class="card-title"><?php echo $db_varatia_name; ?></h4>
                  <p class="card-description">
                  <p style="font-size:15px;font-weight:bold">You'r NID: <span class="text-info" style="font-weight:bold;font-size:20px"><?php echo $db_varatia_nid;?></span> </p>
                  </p>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="card card-profile">
                <div class="card-body">
                  <p class="card-description">
                    <p style="font-size:15px;font-weight:bold">Your Entry Date: <span class="text-info" style="font-weight:bold;font-size:20px"><?php echo $fm->format_date($db_varatia_entry_date) ?></span> </p>
                  </p>
                </div>
              </div>
              </div>
              <?php }else{?>
                    <div class="content">
                      <div class="container-fluid">
                        <h1 class="text-center text-danger">Currently Root / Admin Is Not Managing Profile</h1>
                      </div>
                    </div>  
                
              <?php }?>
            </div>
          </div>
        </div>
      </div>

<?php include 'inc/footer.php';?>