<?php include 'inc/header.php';
  Permission::owner();
?>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/navbar.php';?>

<?php
    if(empty($_GET['room_id']) || $_GET['room_id']==NULL){
        echo "<script> window.location = 'index.php' </script>";
    }else{
        $room_id = $_GET['room_id'];
    }

?>

<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
      //var_dump($_POST['due']);
    $error = "";
    if(empty($_POST['fair'])){
        $error .="<span class='text-danger'>Fare Required</span><br/>";
    }elseif(empty($_POST['total_person'])){
        $error .="<span class='text-danger'>Total Person Required</span><br/>";
    }elseif($_POST['status']==NULL){
        $error .="<span class='text-danger'>Status Required</span><br/>";
    }else{
        $total_person = $_POST['total_person'];
        $fair = $_POST['fair'];
        $status = $_POST['status'];
      
        $query = "UPDATE `room` 
                  SET
                  `total_person` = '$total_person',
                  `fair`         = '$fair',
                  `status`       = '$status'
                WHERE `id` = '$room_id'
              ";
        $update_row = $db->update($query);

        if($update_row){
          $success_msg = "<span class='text-success'>Updated Successfully</span>";
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
                  <h4 class="card-title">EDIT</h4>
                  <p class="card-category">Room Represents Your Varatia</p>
                  <p class="" style="font-size:20px;font-weight:bold">You can edit only (<span class="text-white">[FAIR, Status, Total Person]</span>)</p>
                </div>
                <div class="card-body">
                  <form method="POST" action="" enctype="multipart/form-data">
                    <?php
                        $query = "SELECT room.*,owner.owner_name,varatia.varatia_name 
                        FROM (
                            room INNER JOIN owner ON room.user_id = owner.user_id
                            INNER JOIN varatia ON room.varatia_id = varatia.varatia_id
                        ) WHERE room.id = '$room_id'
                        ";
                        $result = $db->select($query);
                        if($result){
                            while($user= $result->fetch_assoc()){
                    ?>
                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Home Owner </label>
                            <input type="text" class="form-control" disabled name="" value="<?php echo $user['owner_name'];?>">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Varatia Name</label>
                          <input type="text" class="form-control" disabled name="" value="<?php echo $user['varatia_name'];?>">
                        </div>
                      </div>
                      
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">NID</label>
                          <input type="text" class="form-control" name="nid" value="<?php echo $user['nid'];?>" disabled>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Fair</label>
                          <input type="text" class="form-control" name="fair" value="<?php echo $user['fair'];?>">
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
                                <?php
                                    if($user['status']==0){ ?>
                                    <option selected value="0">Regular</option>
                                    <option value="1">Irregular</option>
                                <?php } else {?>
                                    <option value="0">Regular</option>
                                    <option selected value="1">Irregular</option>
                                <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Total Person</label>
                          <input type="number" class="form-control" name="total_person" value="<?php echo $user['total_person'] ?>">
                        </div>
                      </div>
                    </div>
                     
                    </div>
                    
                    
                    
                            <?php }}?>
                    
                    <button type="submit" class="btn btn-info btn-lg pull-right" style="font-size:20px;font-weight:bold;">Update Room / Varatia (STATUS) </button>
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