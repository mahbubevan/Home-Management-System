<?php
    include 'inc/header.php';
    Permission::owner();
    include 'inc/sidebar.php';
    include 'inc/navbar.php';
?>

<?php
  $user_id = Session::get('id');
  $get_owner_query = "SELECT * FROM `owner` WHERE `user_id` = '$user_id'";
  $result = $db->select($get_owner_query);
  if($result){
    while($owner = $result->fetch_assoc()){
      $owner_id = $owner['user_id'];
      $owner_name = $owner['owner_name'];
    }
  }else{
    $owner_id = '0';
    $owner_name = 'YOU ARE NOT AN OWNER';
  }

?>

<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
          //var_dump($_POST);
          $owner_id = $_POST['owner_id'];
          $varatia_id = $_POST['varatia_id'];
          $month = $_POST['month'];
          $payment = $_POST['payment'];
          if(isset($_POST['payment_type'])){
            $payment_type = $_POST['payment_type'];
          }else{
            $payment_type = 3;
          }
          $year = $_POST['year'];
          $status = $_POST['status'];
          $random_transaction_id = $_POST['random_transaction_id'];
          $varatia_fare = $_POST['varatia_fare'];
          $due = $varatia_fare - $payment;
          //var_dump($due);

        $query = "INSERT INTO 
        `transaction`(`owner_id`, `room_id`, `month`, `year`, `payment`, `status`, `due`, `payment_type`, `random_transaction_id`) 
        VALUES ('$owner_id','$varatia_id','$month','$year','$payment','$status','$due','$payment_type','$random_transaction_id')";

        $insert_transaction = $db->insert($query);
        if($insert_transaction){
          $success_msg = "<span class='text-success'>Transaction Created !!!</span>";
        }else{
          $error_msg = "<span class='text-danger'>Transaction Couldn't Created !!!</span>";
        }

    }

?>

<div class="content">
    <div class="container">
    <?php
      if(isset($success_msg)){
        echo $success_msg;
      }

      if(isset($error_msg)){
        echo $error_msg;
      }
    ?>
    <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-success">
                  <h2 class="card-title">Make Payment</h2>
                  <p class="card-category text-white" style="font-size:20px;font-weight:bold">Confirmation will send to varatia</p>
                </div>
                <div class="card-body">
                  <form action="" method="POST">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Home Owner</label>
                          <select name="owner_id" id="" class="form-control">
                            <option value="<?php echo $owner_id;?>">
                              <?php echo $owner_name;?>
                            </option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Varatia</label>
                            <select name="varatia_id" id="varatia_id" class="form-control" onchange="genereate_ID(); getFare();">
                            <?php
                            $query = "SELECT owner.*,varatia.*,room.*
                                  FROM(room INNER JOIN owner ON room.user_id = owner.user_id
                                      INNER JOIN varatia ON room.varatia_id = varatia.varatia_id
                                      )
                                  WHERE room.user_id = $user_id
                            ";
                            $result2 = $db->select($query);
                            if($result2){
                              while($varatia = $result2->fetch_assoc()){?>
                              <option value="<?php echo $varatia['varatia_id'];?>">
                                <?php echo $varatia['varatia_name'];?>
                              </option>
                              <?php }
                            }
                          ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Current Month</label>
                          <input type="text" name="month" class="form-control" readonly value="<?php echo date("F"); ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Payment</label>
                          <input type="number" name="payment" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Status</label>
                          <select name="status" id="payment_status" class="form-control" onchange="changeType()">
                                <option value="3">-------------</option>
                                <option value="0">FULL-PAYMENT</option>
                                <option value="1">Half-PAYMENT</option>
                                <option value="2">NON-PAYMENT</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Payement Type</label>
                          <select name="payment_type" id="payment_type" class="form-control">
                              <option value="">-----------------</option>
                              <option value="0">Cash</option>
                              <option value="1">Bkash</option>
                              <option value="2">Check</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Current Year</label>
                          <input type="text" name="year" id="" class="form-control" value="<?php echo date("Y"); ?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Payment ID</label>
                          <input type="text" id="payment_id" name="random_transaction_id"  class="form-control" readonly>
                          <input type="button" value="Generate TraxID" class="btn btn-sm btn-info"
                            onclick="genereate_ID()"
                          >
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Fare</label>
                          <input type="text" id="varatia_fare" name="varatia_fare"  class="form-control" readonly>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-success pull-right"><span style="font-size:20px;font-weight:bold">Confirm PAYMENT</span></button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="#pablo">
                    <img class="img" src="../assets/img/faces/marc.jpg" />
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category text-gray">CEO / Co-Founder</h6>
                  <h4 class="card-title">Alec Thompson</h4>
                  <p class="card-description">
                    Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
                  </p>
                  <a href="#pablo" class="btn btn-primary btn-round">Follow</a>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>

<script>
function create_UUID(){
    var dt = document.getElementById("varatia_id");
    var str = dt.options[dt.selectedIndex].value;
    var number = parseInt(str);
    var uuid = number +'-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = (number + Math.random()*16)%16 | 0;
        number = Math.floor(number/16);
        return (c=='x' ? r :(r&0x3|0x8)).toString(16);
    });
    return uuid;
}

  function genereate_ID(){
    document.getElementById("payment_id").value = create_UUID();
  }

  function getFare(){
    var select = document.getElementById("varatia_id");
    var str = select.options[select.selectedIndex].value;
    var varatia_id = parseInt(str);
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200) {
              document.getElementById("varatia_fare").value = this.responseText;
            }
    };
    
    xmlhttp.open("GET",'api/get_varatia.php?varatia_id='+varatia_id,true);
    xmlhttp.send();
  }

  function changeType(){
    var select = document.getElementById("payment_status");
    var str = select.options[select.selectedIndex].value;
    var number = parseInt(str);
    console.log(number);
    if(number===2 || number===3){
      document.getElementById("payment_type").disabled = true;
      return;
    }
    document.getElementById("payment_type").disabled = false;
  }
  

</script>

<?php
    include 'inc/footer.php';
?>