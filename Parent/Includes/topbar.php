<?php 

  $query = "SELECT * FROM tblparent WHERE id = ".$_SESSION['id']."";
  $rs = $conn->query($query);
  $num = $rs->num_rows;
  $rows = $rs->fetch_assoc();
  $fullName = $rows['fname']." ".$rows['sname'];;

?>

<nav class="navbar navbar-expand navbar-light bg-gradient-secondary topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link  mr-3">
            <i class="fa fa-bars"></i>
          </button>
        <div class="text-white big" style="margin-left:100px;"></div>
          <ul class="navbar-nav ml-auto">
            <!-- <div class="topbar-divider d-none d-sm-block"></div> -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/w-user.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><b><?php echo $fullName;?></b></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>