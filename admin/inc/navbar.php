<?php
  if(isset($_GET['logout_id']) && $_GET['logout_id'] == 1 ){
    //var_dump($_GET['logout_id']);
    Session::destroy();
  }
?>

<div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand text-success text-lg" href="index.php">Welcome <?php echo Session::get('username'); ?> </a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">

             <?php if(Session::get('status')==0){ ?> <!-- Owner Permission Condition -->
              <li class="nav-item">
                <a class="nav-link" href="user_add.php">
                  <i class="material-icons"></i> Add User
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="owner_add.php">
                  <i class="material-icons"></i> Add Owner
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="room_add.php">
                  <i class="material-icons"></i> Add Room
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="home_add.php">
                  <i class="material-icons"></i> Add Home
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="varatia_add.php">
                  <i class="material-icons"></i> Add Varatia
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="material-icons"></i> Add Motor
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="material-icons">notifications</i> Notifications
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="?logout_id=<?php echo true; ?>">
                  <i class="material-icons"></i> Logout
                </a>
              </li>
            <?php    }else{ ?>  <!-- Varatia Permission Condition -->

              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="material-icons">notifications</i> Notifications
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="?logout_id=<?php echo true; ?>">
                  <i class="material-icons"></i> Logout
                </a>
              </li>
            <?php    }?>
              <!-- your navbar here -->
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
