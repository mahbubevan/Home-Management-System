<?php include 'inc/header.php';
  Permission::owner();
?>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/navbar.php';?>

<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
    //   var_dump(empty($_POST['owner_id']));
    //   var_dump($_POST['owner_id']);
    $error = "";
    if(empty($_POST['varatia_id']) || empty($_POST['varatia_name'])){
        $error .="<span class='text-danger'>Varatia Required</span><br/>";
    }else{
        $varatia_id = $_POST['varatia_id'];
        $varatia_name = $_POST['varatia_name'];
        
        $query = "INSERT INTO `varatia`(`varatia_id`,`varatia_name`) VALUES ('$varatia_id','$varatia_name')";
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
                  <h4 class="card-title">ADD NEW Varatia</h4>
                  <p class="card-category">Select User As Varatia</p>
                </div>
                <div class="card-body">
                  <form method="POST" action="" >
                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Varatia ID</label>
                          <select name="varatia_id" id="" class="form-control">
                            <?php 
                                $query = "SELECT * FROM `user` WHERE `status` = 1";
                                $result = $db->select($query);
                                if($result){
                                    while($varatia = $result->fetch_assoc()){?>
                                    <option value="<?php echo $varatia['id'];?>"> <?php echo $varatia['username'];?> </option>
                            <?php } }?>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Varatia Name (KEEP SAME AS VARATIA ID) </label>
                          <select name="varatia_name" id="" class="form-control">
                            <?php 
                                $query = "SELECT * FROM `user` WHERE `status` = 1";
                                $result = $db->select($query);
                                if($result){
                                    while($varatia = $result->fetch_assoc()){?>
                                    <option value="<?php echo $varatia['username'];?>"> <?php echo $varatia['username'];?> </option>
                            <?php } }?>
                          </select>
                        </div>
                      </div>


                </div>
                    
                    <button type="submit" class="btn btn-info btn-lg pull-right">Add As Varatia</button>
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