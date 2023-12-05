<?php
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';

//------------------------SAVE--------------------------------------------------

// if(isset($_POST['save'])){

//   $firstName=$_POST['firstName'];
//   $lastName=$_POST['lastName'];
//   $otherName=$_POST['otherName'];

//   $admissionNumber=$_POST['admissionNumber'];
//   $classId=$_POST['classId'];
//   $classArmId=$_POST['classArmId'];
//   $dateCreated = date("Y-m-d");

//     $query=mysqli_query($conn,"select * from tblstudents where admissionNumber ='$admissionNumber'");
//     $ret=mysqli_fetch_array($query);

//     if($ret > 0){ 

//         $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>Already Exists!</div>";
//     }
//     else{

//     $query=mysqli_query($conn,"insert into tblstudents(firstName,lastName,otherName,admissionNumber,password,classId,classArmId,dateCreated) 
//     value('$firstName','$lastName','$otherName','$admissionNumber','12345','$classId','$classArmId','$dateCreated')");

//     if ($query) {

//         $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Added Successfully!</div>";

//     }
//     else
//     {
//          $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
//     }
//   }
// }

if (isset($_POST['save'])) {

  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $otherName = $_POST['otherName'];
  $sex = $_POST['sex'];
  $admissionNumber = $_POST['admissionNumber'];
  $classId = $_POST['classId'];
  $classArmId = $_POST['classArmId'];
  $dateCreated = date("Y-m-d");

  $query = mysqli_query($conn, "select * from tblstudents where admissionNumber ='$admissionNumber'");
  $ret = mysqli_fetch_array($query);

  if ($ret > 0) {

    $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>Already Exists!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
  } else {

    $query = mysqli_query($conn, "insert into tblstudents(firstName,lastName,otherName,sex,admissionNumber,password,classId,classArmId,dateCreated) 
    value('$firstName','$lastName','$otherName','$sex','$admissionNumber','12345','$classId','$classArmId','$dateCreated')");

    $statusMsg = ($query) ? "<div class='alert alert-success'  style='margin-right:700px;'>Added Successfully!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>" : "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
  }
}

//---------------------------------------EDIT-------------------------------------------------------------






//--------------------EDIT------------------------------------------------------------

//  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit")
// 	{
//         $Id= $_GET['Id'];

//         $query=mysqli_query($conn,"select * from tblstudents where Id ='$Id'");
//         $row=mysqli_fetch_array($query);

//         //------------UPDATE-----------------------------

//         if(isset($_POST['update'])){

//              $firstName=$_POST['firstName'];
//   $lastName=$_POST['lastName'];
//   $otherName=$_POST['otherName'];

//   $admissionNumber=$_POST['admissionNumber'];
//   $classId=$_POST['classId'];
//   $classArmId=$_POST['classArmId'];
//   $dateCreated = date("Y-m-d");

//  $query=mysqli_query($conn,"update tblstudents set firstName='$firstName', lastName='$lastName',
//     otherName='$otherName', admissionNumber='$admissionNumber',password='12345', classId='$classId',classArmId='$classArmId'
//     where Id='$Id'");
//             if ($query) {

//                 echo "<script type = \"text/javascript\">
//                 window.location = (\"createStudents.php\")
//                 </script>"; 
//             }
//             else
//             {
//                 $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
//             }
//         }
//     }


if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit") {
  $Id = $_GET['Id'];

  $query = mysqli_query($conn, "select * from tblstudents where Id ='$Id'");
  $row = mysqli_fetch_array($query);

  //------------UPDATE-----------------------------

  if (isset($_POST['update'])) {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $otherName = $_POST['otherName'];
    $sex = $_POST['sex'];
    $admissionNumber = $_POST['admissionNumber'];
    $classId = $_POST['classId'];
    $classArmId = $_POST['classArmId'];
    $dateCreated = date("Y-m-d");

    $query1 = mysqli_query($conn, "select * from tblstudents where admissionNumber ='$admissionNumber'");
    $ret = mysqli_fetch_array($query1);
  
    if ($ret > 0) {

      $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>Already Exists!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    }
   else{

    $query = mysqli_query($conn, "update tblstudents set firstName='$firstName', lastName='$lastName',
    otherName='$otherName', sex='$sex',admissionNumber='$admissionNumber',password='12345', classId='$classId',classArmId='$classArmId'
    where Id='$Id'");

      echo "<script type = \"text/javascript\">
                window.location = (\"createStudents.php\")
                </script>";
    }
  }
}

//--------------------------------DELETE------------------------------------------------------------------

if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete") {
  $Id = $_GET['Id'];
  $classArmId = $_GET['classArmId'];

  $query = mysqli_query($conn, "DELETE FROM tblstudents WHERE Id='$Id'");

  if ($query == TRUE) {

    echo "<script type = \"text/javascript\">
            window.location = (\"createStudents.php\")
            </script>";
  } else {

    $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
  }

}


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
  <?php include 'includes/title.php'; ?>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <script src="https://kit.fontawesome.com/44fa69dea4.js" crossorigin="anonymous"></script>
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="css/styler.css" rel="stylesheet" type="text/css">




  <script>
    function classArmDropdown(str) {
      if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
      } else {
        if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "ajaxClassArms2.php?cid=" + str, true);
        xmlhttp.send();
      }
    }
  </script>
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include "Includes/sidebar.php"; ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php include "Includes/topbar.php"; ?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Students</h1>
            <!-- <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Create Students</li>
            </ol> -->
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <?php echo $statusMsg; ?>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-secondary">Add Students</h6>
                  
                </div>
                <div class="card-body">
                  <form method="post">
                    <div class="form-group row mb-3">
                      <div class="col-xl-3">
                          <label class="form-control-label">LRN<span
                            class="text-danger ml-2">*</span></label>
                        <input type="number" class="form-control" required name="admissionNumber"
                          value="<?php echo $row['admissionNumber']; ?>" id="exampleInputFirstName">
                      </div>
                    </div>
                    <div class="form-group row mb-3">
                      <div class="col-xl-5">
                      <label class="form-control-label">First Name<span class="text-danger ml-2">*</span></label>
                        <input type="text" required class="form-control" name="firstName" value="<?php echo $row['firstName']; ?>"
                          id="exampleInputFirstName">
                      </div>
                    </div>
                    <div class="form-group row mb-3">
                      <div class="col-xl-5">
                        <label class="form-control-label">Middle Name</label>
                        <input type="text" class="form-control" name="otherName" value="<?php echo $row['otherName']; ?>"
                          id="exampleInputFirstName">
                      </div>
                    </div>
                      <div class="form-group row mb-3">
                      <div class="col-xl-5">
                      <label class="form-control-label">Surname<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" name="lastName" required value="<?php echo $row['lastName']; ?>"
                          id="exampleInputFirstName">
                      </div>
                    </div>
                    <div class="form-group row mb-3">
                      <div class="col-xl-3">
                        <label class="form-control-label">Grade Level<span class="text-danger ml-2">*</span></label>
                        <?php
                        $qry = "SELECT * FROM tblclass ORDER BY className ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;
                        if ($num > 0) {
                          echo ' <select required name="classId" onchange="classArmDropdown(this.value)" class="form-control mb-3">';
                          echo '<option value="">--Select Class--</option>';
                          while ($rows = $result->fetch_assoc()) {
                            echo '<option value="' . $rows['Id'] . '" >' . $rows['className'] . '</option>';
                          }
                          echo '</select>';
                        }
                        ?>
                      </div>
                    </div>
                    <div class="form-group row mb-3">
                      <div class="col-xl-3">
                        <label class="form-control-label">Section<span class="text-danger ml-2">*</span></label>
                        <?php
                        echo "<div id='txtHint'></div>";
                        ?>
                      </div>
                    </div>

                      <div class="col-xl-6">
                      <label class="form-control-label">Sex<span class="text-danger ml-2">*</span></label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="sex" id="male" value="M" checked>
                                Male </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="sex" id="female" value="F"> Female
                              </label>
                            </div>
                          </div>
                      <br>

                    </div>
                    <?php
                    if (isset($Id)) {
                      ?>
                      <button type="submit" name="update" class="btn btn-info">Update</button>
                      <a href="createStudents.php" id="cancel" name="cancel" class="btn btn-warning">Back</a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <?php
                    } else {
                      ?>
                      <button type="submit" name="save" class="btn btn-primary">Save</button>
                      <?php
                    }
                    ?>
                  </form>
                </div>
              </div>

              <!-- Input Group -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-secondary">List</h6>
                    </div>
                    <div class="table-responsive p-3">
                      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-dark">
                          <tr>
                            <th>#</th>
                            <th>LRN</th>
                            <th>First Name</th>
                            <th>Surname</th>
                            <th>Middle Name</th>
                            <th>Sex</th>
                            <th>Grade Level</th>
                            <th>Section</th>
                            <th>Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>

                        <tbody>

                          <?php
                          $query = "SELECT tblstudents.Id,tblclass.className,tblclassarms.classArmName,tblclassarms.Id AS classArmId,tblstudents.firstName,
                      tblstudents.lastName,tblstudents.otherName,tblstudents.sex,tblstudents.admissionNumber,tblstudents.dateCreated
                      FROM tblstudents
                      INNER JOIN tblclass ON tblclass.Id = tblstudents.classId
                      INNER JOIN tblclassarms ON tblclassarms.Id = tblstudents.classArmId";
                          $rs = $conn->query($query);
                          $num = $rs->num_rows;
                          $sn = 0;
                          $status = "";
                          if ($num > 0) {
                            while ($rows = $rs->fetch_assoc()) {
                              $sn = $sn + 1;
                              echo "
                              <tr>
                                <td>" . $sn . "</td>
                                <td>" . $rows['admissionNumber'] . "</td>
                                <td>" . $rows['firstName'] . "</td>
                                <td>" . $rows['lastName'] . "</td>
                                <td>" . $rows['otherName'] . "</td>
                                <td>" . $rows['sex'] . "</td>
                                <td>" . $rows['className'] . "</td>
                                <td>" . $rows['classArmName'] . "</td>
                                 <td>" . $rows['dateCreated'] . "</td>
                                <td><a href='?action=edit&Id=" . $rows['Id'] . "'>Edit</a> &nbsp;
                                <a onclick='javascript:confirmationDelete($(this));return false;' href='?action=delete&Id=" . $rows['Id'] . "'>Delete</a>
                                </td>
                              </tr>";
                            }
                          } else {
                            echo
                              "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                          }

                          ?>
                        </tbody>
                      </table>
                    </div>
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

          </div>
          <!---Container Fluid-->
        </div>
      </div>
    </div>

    <script type="text/javascript">
      function confirmationDelete(anchor) {
        var conf = confirm('Are you sure want to delete this record?');
        if (conf)
          window.location = anchor.attr("href");
      }
    </script>                     

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