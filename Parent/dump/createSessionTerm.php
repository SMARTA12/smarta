<?php
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';

//------------------------SAVE--------------------------------------------------

// if(isset($_POST['save'])){

//     $sessionName=$_POST['sessionName'];
//     $termId=$_POST['termId'];
//     $dateCreated = date("Y-m-d");

//     $query=mysqli_query($conn,"select * from tblsessionterm where sessionName ='$sessionName' and termId = '$termId'");
//     $ret=mysqli_fetch_array($query);

//     if($ret > 0){ 

//         $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>This Session and Term Already Exists!</div>";
//     }
//     else{

//         $query=mysqli_query($conn,"insert into tblsessionterm(sessionName,termId,isActive,dateCreated) value('$sessionName','$termId','0','$dateCreated')");

//     if ($query) {

//         $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Created Successfully!</div>";
//     }
//     else
//     {
//          $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
//     }
//   }
// }

if (isset($_POST['save'])) {

  $sessionName = $_POST['sessionName'];
  $termId = $_POST['termId'];
  $dateCreated = date("Y-m-d");

  $query = mysqli_query($conn, "select * from tblsessionterm where sessionName ='$sessionName' and termId = '$termId'");
  $ret = mysqli_fetch_array($query);

  if ($ret > 0) {

    $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>Already Exists!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
  } else {

    $query = mysqli_query($conn, "insert into tblsessionterm(sessionName,termId,isActive,dateCreated) value('$sessionName','$termId','0','$dateCreated')");

    $statusMsg = ($query) ? "<div class='alert alert-success'  style='margin-right:700px;'>Added Successfully!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>" : "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
  }
}

//---------------------------------------EDIT-------------------------------------------------------------






//--------------------EDIT------------------------------------------------------------

//  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit")
// 	{
//         $Id= $_GET['Id'];

//         $query=mysqli_query($conn,"select * from tblsessionterm where Id ='$Id'");
//         $row=mysqli_fetch_array($query);

//         //------------UPDATE-----------------------------

//         if(isset($_POST['update'])){

//              $sessionName=$_POST['sessionName'];
//     $termId=$_POST['termId'];
//     $dateCreated = date("Y-m-d");

//             $query=mysqli_query($conn,"update tblsessionterm set sessionName='$sessionName',termId='$termId',isActive='0' where Id='$Id'");

//             if ($query) {

//                 echo "<script type = \"text/javascript\">
//                 window.location = (\"createSessionTerm.php\")
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

  $query = mysqli_query($conn, "select * from tblsessionterm where Id ='$Id'");
  $row = mysqli_fetch_array($query);

  //------------UPDATE-----------------------------

  if (isset($_POST['update'])) {

    $sessionName = $_POST['sessionName'];
    $termId = $_POST['termId'];
    $dateCreated = date("Y-m-d");

    $query = mysqli_query($conn, "select * from tblsessionterm where sessionName ='$sessionName' and termId = '$termId'");
    $ret = mysqli_fetch_array($query);

    if ($ret > 0) {

      $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>Already Exists!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    } else {

      $query = mysqli_query($conn, "update tblsessionterm set sessionName='$sessionName',termId='$termId',isActive='0' where Id='$Id'");
      echo "<script type = \"text/javascript\">
                window.location = (\"createSessionTerm.php\")
                </script>";
    }
  }
}


//--------------------------------DELETE------------------------------------------------------------------

if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete") {
  $Id = $_GET['Id'];

  $query = mysqli_query($conn, "DELETE FROM tblsessionterm WHERE Id='$Id'");

  if ($query == TRUE) {

    echo "<script type = \"text/javascript\">
                window.location = (\"createSessionTerm.php\")
                </script>";
  } else {

    $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
  }

}


//--------------------------------ACTIVATE------------------------------------------------------------------

if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "activate") {
  $Id = $_GET['Id'];

  $query = mysqli_query($conn, "update tblsessionterm set isActive='0' where isActive='1'");

  if ($query) {

    $que = mysqli_query($conn, "update tblsessionterm set isActive='1' where Id='$Id'");

    if ($que) {

      echo "<script type = \"text/javascript\">
                    window.location = (\"createSessionTerm.php\")
                    </script>";
    } else {
      $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
    }
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
            <h1 class="h3 mb-0 text-gray-800">Strand</h1>
            <!-- <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Create Session and Term</li>
            </ol> -->
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <?php echo $statusMsg; ?>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-secondary">Add Strand and Semester</h6>
              
                </div>
                <div class="card-body">
                  <form method="post">
                    <div class="form-group row mb-3">
                      <div class="col-xl-3">
                        <label class="form-control-label">Strand<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" name="sessionName"
                          value="<?php echo $row['sessionName']; ?>" id="exampleInputFirstName" placeholder="Strand">
                      </div>
                      <div class="col-xl-3">
                        <label class="form-control-label">Semester<span class="text-danger ml-2">*</span></label>
                        <?php
                        $qry = "SELECT * FROM tblterm ORDER BY termName ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;
                        if ($num > 0) {
                          echo ' <select required name="termId" class="form-control mb-3">';
                          echo '<option value="">-Semester-</option>';
                          while ($rows = $result->fetch_assoc()) {
                            echo '<option value="' . $rows['Id'] . '" >' . $rows['termName'] . '</option>';
                          }
                          echo '</select>';
                        }
                        ?>
                      </div>
                    </div>
                    <?php
                    if (isset($Id)) {
                      ?>
                      <button type="submit" name="update" class="btn btn-info">Update</button>
                      <a href="createSessionTerm.php" id="cancel" name="cancel" class="btn btn-warning">Back</a>
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
                      <h6 class="m-0 font-weight-bold text-secondary  ">List</h6>
                    </div>
                    <h6 class="ml-3 mt-o font-weight-bold text-secondary">activate semester through check</h6>
                    <div class="table-responsive p-3">
                      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-dark">
                          <tr>
                            <th>#</th>
                            <th>Strand</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Activate</th>
                            <th>Edit</th>
                            <th>Delete</th>
                          </tr>
                        </thead>

                        <tbody>

                          <?php
                          $query = "SELECT tblsessionterm.Id,tblsessionterm.sessionName,tblsessionterm.isActive,tblsessionterm.dateCreated,
                      tblterm.termName
                      FROM tblsessionterm
                      INNER JOIN tblterm ON tblterm.Id = tblsessionterm.termId";
                          $rs = $conn->query($query);
                          $num = $rs->num_rows;
                          $sn = 0;
                          if ($num > 0) {
                            while ($rows = $rs->fetch_assoc()) {
                              if ($rows['isActive'] == '1') {
                                $status = "Active";
                              } else {
                                $status = "InActive";
                              }
                              $sn = $sn + 1;
                              echo "
                              <tr>
                                <td>" . $sn . "</td>
                                <td>" . $rows['sessionName'] . "</td>
                                <td>" . $rows['termName'] . "</td>
                                <td>" . $status . "</td>
                                <td>" . $rows['dateCreated'] . "</td>
                                 <td><a href='?action=activate&Id=" . $rows['Id'] . "'><i class='fa-solid fa-check'></i></a></td>
                                <td><a href='?action=edit&Id=" . $rows['Id'] . "'>Edit</a></td>
                                <td><a onclick='javascript:confirmationDelete($(this));return false;'  href='?action=delete&Id=" . $rows['Id'] . "'>Delete</a></td>
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
        <!-- Footer -->

        <!-- Footer -->
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