
<?php 
error_reporting(0);
// session_start();
include '../Includes/dbcon.php';
include '../Includes/session2.php';


date_default_timezone_set('Asia/Manila');
$dateToday = date('Y-m-d');

$query1 = "SELECT * FROM tblparent WHERE id = ".$_SESSION['id']."";
$rs1 = $conn->query($query1);
$num1 = $rs1->num_rows;
$rowz = $rs1->fetch_assoc();
$fullName = $rowz['fname']." ".$rowz['sname'];

$queryz = "SELECT tblstudents.* FROM tblstudents INNER JOIN tblparent ON tblstudents.admissionNumber = tblparent.stdlrn where tblparent.id =".$_SESSION['id']."";
$rs2 = $conn->query($queryz);
$num3 = $rs2->num_rows;
$rowx = $rs2->fetch_assoc();
$fullName1 = $rowx['firstName']." ".$rowx['lastName'];

$query2 = "SELECT tblattendance.* FROM tblattendance INNER JOIN tblparent ON tblattendance.admissionNo = tblparent.stdlrn where tblparent.id =".$_SESSION['id']."";
$rs2 = $conn->query($query2);
$num2 = $rs2->num_rows;
$rowz2 = $rs2->fetch_assoc();
$daten = $rowz2['dateTimeTaken'];
$timen = $rowz2['timeTaken'];
$stat = $rowz2['status'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/settings.png" rel="icon">
  <title>Attendance</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <script src="https://kit.fontawesome.com/44fa69dea4.js" crossorigin="anonymous"></script>
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">


  

</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
      <?php include "Includes/sidebar.php";?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
       <?php include "Includes/topbar.php";?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-1">
          <h1 class="h3 mb-0 text-gray-800"> Welcome <?php echo $fullName;?>!</h1>
          </div>
          <h5 class="text-gray-600"> <?php echo "Today is:" . ' ' . date("l") . ', ' . date("m-d-Y"); ?> </h5>
          <?php
           if ($stat == "1") {
            ?>
          <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-0">
            <h4 class="text-gray-800"><?php echo $fullName1;?> is at school. </h4>
          </div>
          <div class="d-sm-flex align-items-center justify-content-between mt-2 mb-2">
            <h4 class="text-gray-800"> Last Attendance Taken: <?php echo $daten;?> at <?php echo $timen;?> </h4>
            </div>
          <?php
          } else if($stat == "0") {
            ?>  
                        
          <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-0">
            <h4 class="text-gray-800"><?php echo $fullName1;?> is absent today! </h4>
          </div>
          <?php
          } else if($daten != $dateToday) {
            ?>  
                        
          <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-0">
            <h4 class="text-gray-800"> Attendance not yet taken today! </h4>
          </div>
          <?php
          } else {
          ?>
            <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-0">
            <h4 class="text-gray-800"> Attendance not yet taken! </h4>
            </div>
            <?php
          }
          ?>
          


        </div>
      </div>
    </div>
  </div>
          <!--Row-->

          <!-- Documentation Link -->
          <!-- <div class="row">
            <div class="col-lg-12 text-center">
              <p>For more documentations you can visit<a href="https://getbootstrap.com/docs/4.3/components/forms/"
                  target="_blank">
                  bootstrap forms documentations.</a> and <a
                  href="https://getbootstrap.com/docs/4.3/components/input-group/" target="_blank">bootstrap input
                  groups documentations</a></p>
            </div>
          </div> -->

        <!-- </div> -->
        <!---Container Fluid-->
      <!-- </div>
    </div>
  </div> -->



  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
   <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
</body>

</html>