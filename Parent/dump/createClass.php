<?php
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';

//------------------------SAVE--------------------------------------------------

// if(isset($_POST['save'])){

//     $className=$_POST['className'];

//     $query=mysqli_query($conn,"select * from tblclass where className ='$className'");
//     $ret=mysqli_fetch_array($query);

//     if($ret > 0){ 

//         $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>This Class Already Exists!</div>";
//     }
//     else{

//         $query=mysqli_query($conn,"insert into tblclass(className) value('$className')");

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

  $className = $_POST['className'];

  $query = mysqli_query($conn, "select * from tblclass where className ='$className'");
  $ret = mysqli_fetch_array($query);

  if ($ret > 0) {

    $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>Already Exists!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
  } else {

    $query = mysqli_query($conn, "insert into tblclass(className) value('$className')");

    $statusMsg = ($query) ? "<div class='alert alert-success'  style='margin-right:700px;'>Added Successfully!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>" : "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
  }
}

//---------------------------------------EDIT-------------------------------------------------------------






//--------------------EDIT------------------------------------------------------------

//  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit")
// 	{
//         $Id= $_GET['Id'];

//         $query=mysqli_query($conn,"select * from tblclass where Id ='$Id'");
//         $row=mysqli_fetch_array($query);

//         //------------UPDATE-----------------------------

//         if(isset($_POST['update'])){

//             $className=$_POST['className'];
//             $query=mysqli_query($conn,"update tblclass set className='$className' where Id='$Id'");

//             if ($query) {

//                 echo "<script type = \"text/javascript\">
//                 window.location = (\"createClass.php\")
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

  $query = mysqli_query($conn, "select * from tblclass where Id ='$Id'");
  $row = mysqli_fetch_array($query);

  //------------UPDATE-----------------------------

  if (isset($_POST['update'])) {

    $className = $_POST['className'];

    $query = mysqli_query($conn, "select * from tblclass where className ='$className'");
    $ret = mysqli_fetch_array($query);

    if ($ret > 0) {

      $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>Already Exists!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    } else {
      $query = mysqli_query($conn, "update tblclass set className='$className' where Id='$Id'");

      echo "<script type = \"text/javascript\">
                      window.location = (\"createClass.php\")
                      </script>";
    }
  }
}



//--------------------------------DELETE------------------------------------------------------------------

if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete") {
  $Id = $_GET['Id'];

  $query = mysqli_query($conn, "DELETE FROM tblclass WHERE Id='$Id'");

  if ($query == TRUE) {

    echo "<script type = \"text/javascript\">
                window.location = (\"createClass.php\")
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
            <h1 class="h3 mb-0 text-gray-800">Grade Level</h1>
            <!-- <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Create Class</li>
            </ol> -->
          </div>

          <div class="row">

            <div class="col-lg-12">
              <!-- Form Basic -->
              <?php echo $statusMsg; ?>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-secondary">Add Grade Level</h6>

                </div>
                <div class="card-body">
                  <form method="post">
                    <div class="form-group row mb-3">
                      <div class="col-xl-3">
                        <label class="form-control-label">Grade Level<span class="text-danger ml-2">*</span></label>
                        <input type="number" class="form-control" name="className"
                          value="<?php echo $row['className']; ?>" id="exampleInputFirstName" placeholder="Grade Level"
                          required>
                      </div>
                    </div>
                    <?php
                    if (isset($Id)) {
                      ?>
                      <button type="submit" name="update" class="btn btn-info">Update</button>
                      <a href="createClass.php" id="cancel" name="cancel" class="btn btn-warning">Back</a>
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
                            <th>Grade Level</th>
                            <th>Action</th>
                          </tr>
                        </thead>

                        <tbody>

                          <?php
                          $query = "SELECT * FROM tblclass";
                          $rs = $conn->query($query);
                          $num = $rs->num_rows;
                          $sn = 0;
                          if ($num > 0) {
                            while ($rows = $rs->fetch_assoc()) {
                              $sn = $sn + 1;
                              echo "
                              <tr>
                                <td>" . $sn . "</td>
                                <td>" . $rows['className'] . "</td>
                                <td><a href='?action=edit&Id=" . $rows['Id'] . "'>Edit</a>  &nbsp; &nbsp; &nbsp; &nbsp;
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