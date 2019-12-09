<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/navbar.php';?>

<?php
  $query = "SELECT COUNT(`id`) FROM `user`";
  $user_count = $db->select($query)->fetch_array();

  $query = "SELECT COUNT(`id`) FROM `owner`";
  $owner_count = $db->select($query)->fetch_array();

  $query = "SELECT COUNT(`id`) FROM `varatia`";
  $varatia_count = $db->select($query)->fetch_array();

  $query = "SELECT COUNT(`id`) FROM `room`";
  $room_count = $db->select($query)->fetch_array();

?>
      <div class="content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-md-4">Transaction</div>
            <div class="col-md-4">Profile</div>
            <div class="col-md-4">SEND Message</div>
          </div>
          <?php
            if(Session::get('status')==0){?>
          <div class="row">
              <div class="col-md-4">All User</div>
              <div class="col-md-4">All Owner</div>
              <div class="col-md-4">All Varatia</div>
          </div>
          <div class="row">
              <div class="col-md-4">Any Service Message</div>
              <div class="col-md-4">Manage User</div>
              <div class="col-md-4">System Details</div>
          </div>
          <div class="container" style="width:80%;margin-top:50px;">
              <div class="row">
                <div class="col">
                  <div class="btn-payment" style="">
                  <a href="transaction_make.php" class="btn btn-success btn-lg btn-block">MAKE PAYMENT</a>
                  </div>
                </div>
              </div>
          </div>
          <?php  }else{ ?>

         <?php } ?>
        </div>
      </div>

<?php include 'inc/footer.php';?>