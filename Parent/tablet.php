
<script>
    function typeDropDown(str) {
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
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxCallTypes.php?tid="+str,true);
        xmlhttp.send();
    }
}
</script>
       
       
       <!-- start -->
          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <!-- Input Group -->
                 <div class="row">
              <div class="col-lg-10">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-secondary">Check Attendance</h6>
                </div>

                <div class="card-body">
                  <form method="post">
                    <div class="form-group row mb-3">
                        <div class="col-xl-3">
                        <label class="form-control-label">Date</label>
                          <select required name="type" onchange="typeDropDown(this.value)" class="form-control mb-3">
                          <option value="">-Select-</option>
                          <option value="1" >All Attendance Dates</option>
                          <option value="2" >Daily</option>
                          <option value="3" >By Range</option>
                        </select>
                        </div>
                    </div>
                      <?php
                        echo"<div id='txtHint'></div>";
                      ?>
                    <button type="submit" name="view" class="btn btn-primary">View</button>
                  </form>
                </div>
              <!-- </div> -->

              <!-- Input Group -->
                 <!-- <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4"> -->
                <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-secondary">List</h6>
                </div> -->
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-dark">
                      <tr>
                        <th>Date</th>
                        <th>Status</th>
                        <th>LRN</th>
                        <th>Surname</th>
                        <th>First Name</th>
                      </tr>
                    </thead>
                   
                    <tbody>

                  <?php

                    if(isset($_POST['view'])){

                      $query3 = "SELECT tblstudents.* FROM tblstudents INNER JOIN tblparent ON tblstudents.admissionNumber = tblparent.stdlrn where tblparent.id =".$_SESSION['id']."";
                      $rs3 = $conn->query($query3);
                      $num3 = $rs3->num_rows;
                      $rows3 = $rs3->fetch_assoc();
                      $admissionNumber = $rows3['admissionNumber'];
                      $type =  $_POST['type'];

                       if($type == "1"){ //All Attendance

                        $query = "SELECT tblattendance.Id,tblattendance.status,tblattendance.dateTimeTaken,
                        tblstudents.firstName,tblstudents.lastName,tblstudents.admissionNumber
                        FROM tblattendance
                        INNER JOIN tblstudents ON tblstudents.admissionNumber = tblattendance.admissionNo
                        where tblattendance.admissionNo = '$admissionNumber'";
                       }
                       if($type == "2"){ //Single Date Attendance

                        $singleDate =  $_POST['singleDate'];

                         $query = "SELECT tblattendance.Id,tblattendance.status,tblattendance.dateTimeTaken,
                        tblstudents.firstName,tblstudents.lastName,tblstudents.admissionNumber
                        FROM tblattendance
                        INNER JOIN tblstudents ON tblstudents.admissionNumber = tblattendance.admissionNo
                        where tblattendance.dateTimeTaken = '$singleDate' and tblattendance.admissionNo = '$admissionNumber'";

                       }
                       if($type == "3"){ //Date Range Attendance

                         $fromDate =  $_POST['fromDate'];
                         $toDate =  $_POST['toDate'];

                         $query = "SELECT tblattendance.Id,tblattendance.status,tblattendance.dateTimeTaken,
                        tblstudents.firstName,tblstudents.lastName,tblstudents.admissionNumber
                        FROM tblattendance
                        INNER JOIN tblstudents ON tblstudents.admissionNumber = tblattendance.admissionNo
                        where tblattendance.dateTimeTaken between '$fromDate' and '$toDate' and tblattendance.admissionNo = '$admissionNumber'";
                        
                       }

                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                              if($rows['status'] == '1'){$status = "Present"; $colour="#00FF00";}else{$status = "Absent";$colour="#FF0000";}
                             $sn = $sn + 1;
                            echo"
                              <tr>
                                <td>".$rows['dateTimeTaken']."</td>
                                <td style='background-color:".$colour."'>".$status."</td>
                                <td>".$rows['admissionNumber']."</td>
                                <td>".$rows['lastName']."</td>
                                <td>".$rows['firstName']."</td>
                              </tr>";
                          }
                      }
                      else
                      {
                           echo   
                           "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                      }
                    }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
          </div>
         <!-- end-->