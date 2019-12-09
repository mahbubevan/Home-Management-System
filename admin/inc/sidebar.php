<div class="sidebar" data-color="purple" data-background-color="white">
      <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
      <div class="logo">
        <a href="index.php" class="simple-text logo-mini">
        Home
        </a>
        <a href="index.php" class="simple-text logo-normal">
           Management System
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="index.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <!-- your sidebar here -->
          <li class="nav-item">
            <a class="nav-link" href="profile_view.php">
              <i class="material-icons">person</i>
              <p>User Profile</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#0">
              <i class="material-icons">dashboard</i>
              <p>Transaction</p>
            </a>
          </li>
          <?php
            if(Session::get('status')==0){?>
          <li class="nav-item ">
            <a class="nav-link" href="owner_view.php">
              <i class="material-icons">dashboard</i>
              <p>Owner List</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="varatia_view.php">
              <i class="material-icons">dashboard</i>
              <p>Varatia List</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="room_view.php">
              <i class="material-icons">dashboard</i>
              <p>Room List</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="user_view.php">
              <i class="material-icons">dashboard</i>
              <p>User List</p>
            </a>
          </li>
          
          <?php  } else{ ?>

          <?php  }?>
        </ul>
      </div>
    </div>