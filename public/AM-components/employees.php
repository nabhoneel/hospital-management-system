<?php add_authorization(); ?>

<style>

.available-doctors {
  color: darkgray;
  font-size: 2em;
}

.row {
  text-align: center;
  margin: 0;
  align-items: center;
}

.allot {
  padding: 1em;
}

.table {
  background-color: #f8f9fa;
  border-radius: 5px;
  text-align: center;
}

.btn2 {background-color: #e7e7e7; color: black;}

.btn2:hover {
    background-color: grey;
}

</style>

<div class="allot">
  <div class="row">
    <div class="form-group col-3"><b><font size="+2">Transaction Status</font></b></div>
    <div class="form-group col-6">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalPaid">Paid</button>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalPending">Pending</button>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalDoctor">Doctor</button>
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNurse">Nurse</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalReceptionist">Receptionist</button>
    </div>
    <div class="available-doctors col-3">Month:
      <?php
      $month = date('F');
      echo $month; ?>
    </div>
  </div>

  </form>
  <div class="form-group col-2"></div>

<br><br>
<body>
  <div class="container">
    <div class="table table-striped">
      <table class="table">
      <thead>
        <tr bgcolor="#948B8A">
          <th>#</th>
          <th>ID</th>
          <th>Name</th>
          <th>Role</th>
          <th>Salary</th>
          <th>Pay status</th>
        </tr>
      </thead>
      <tbody>
        <?php $conn = new mysqli("localhost", "root", "", "hospital-system");
              $sql = "SELECT id, name, role, salary FROM `staff-details` order by id asc";
              $result = $conn->query($sql);
              $i = 1;
              if ($result)
              {
                // output data of each row
                while($row = mysqli_fetch_array($result))
                {
                  echo "<tr>";
                  echo "<td>" . $i . "</td>";
                  echo "<td>" . $row['id'] . "</td>";
                  $temp = $row['id'];
                  echo "<td>" . $row['name'] . "</td>";
                  echo "<td>" . $row['role'] . "</td>";
                  echo "<td>" . $row['salary'] . "</td>";
                  $month = date('m');
                  $year = date('Y');
                  $s = "SELECT * from transactions where details='$temp' and MONTH(`datetime`)=$month and YEAR(`datetime`)=$year";
                  $r = $conn->query($s);
                  if($r->num_rows>0)
                    { echo "<td>" . 'Paid' . "</td>"; }
                  else
                    { echo "<td>" . 'Pending' . "</td>"; }
                  echo "</tr>";
                  $i = $i + 1;
                }
              }
              else { echo "No results to show!"; } ?>
      </tbody>
    </table>
    </div>
  </div>

  <div class="modal" id="modalPaid" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">List of paid transactions</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table">
          <thead>
            <tr bgcolor="#948B8A">
              <th>#</th>
              <th>ID</th>
              <th>Name</th>
              <th>Role</th>
              <th>Salary</th>
            </tr>
          </thead>
          <tbody>
            <?php $conn = new mysqli("localhost", "root", "", "hospital-system");
                  $sql = "SELECT id, name, role, salary FROM `staff-details` order by id asc";
                  $result = $conn->query($sql);
                  $i = 1;
                  if ($result)
                  {
                    // output data of each row
                    while($row = mysqli_fetch_array($result))
                    {
                      $temp = $row['id'];
                      $month = date('m');
                      $year = date('Y');
                      $s = "SELECT * from transactions where details='$temp' and MONTH(`datetime`)=$month and YEAR(`datetime`)=$year";
                      $r = $conn->query($s);
                      if($r->num_rows>0)
                        {
                          echo "<tr>";
                          echo "<td>" . $i . "</td>";
                          echo "<td>" . $row['id'] . "</td>";
                          echo "<td>" . $row['name'] . "</td>";
                          echo "<td>" . $row['role'] . "</td>";
                          echo "<td>" . $row['salary'] . "</td>";
                          echo "</tr>";
                        }
                      $i = $i + 1;
                    }
                  }
                  else { echo "No results to show!"; } ?>
          </tbody>
        </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="modalPending" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">List of pending transactions</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table">
          <thead>
            <tr bgcolor="#948B8A">
              <th>#</th>
              <th>ID</th>
              <th>Name</th>
              <th>Role</th>
              <th>Salary</th>
            </tr>
          </thead>
          <tbody>
            <?php $conn = new mysqli("localhost", "root", "", "hospital-system");
                  $sql = "SELECT id, name, role, salary FROM `staff-details` order by id asc";
                  $result = $conn->query($sql);
                  $i = 1;
                  if ($result)
                  {
                    // output data of each row
                    while($row = mysqli_fetch_array($result))
                    {
                      $temp = $row['id'];
                      $month = date('m');
                      $year = date('Y');
                      $s = "SELECT * from transactions where details='$temp' and MONTH(`datetime`)=$month and YEAR(`datetime`)=$year";
                      $r = $conn->query($s);
                      if($r->num_rows<=0)
                        {
                          echo "<tr>";
                          echo "<td>" . $i . "</td>";
                          echo "<td>" . $row['id'] . "</td>";
                          echo "<td>" . $row['name'] . "</td>";
                          echo "<td>" . $row['role'] . "</td>";
                          echo "<td>" . $row['salary'] . "</td>";
                          echo "</tr>";
                        }
                      $i = $i + 1;
                    }
                  }
                  else { echo "No results to show!"; } ?>
          </tbody>
        </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="modalDoctor" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">List of all doctors</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table">
          <thead>
            <tr bgcolor="#948B8A">
              <th>#</th>
              <th>ID</th>
              <th>Name</th>
              <th>Salary</th>
              <th>Pay status</th>
            </tr>
          </thead>
          <tbody>
            <?php $conn = new mysqli("localhost", "root", "", "hospital-system");
                  $sql = "SELECT id, name, role, salary FROM `staff-details` where role='doctor' order by id asc";
                  $result = $conn->query($sql);
                  $i = 1;
                  if ($result)
                  {
                    // output data of each row
                    while($row = mysqli_fetch_array($result))
                    {
                      $temp = $row['id'];
                      $month = date('m');
                      $year = date('Y');
                      $s = "SELECT * from transactions where details='$temp' and MONTH(`datetime`)=$month and YEAR(`datetime`)=$year";
                      $r = $conn->query($s);
                        echo "<td>" . $i . "</td>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['salary'] . "</td>";
                        if($r->num_rows>0)
                          { echo "<td>" . 'Paid' . "</td>"; }
                        else
                          { echo "<td>" . 'Pending' . "</td>"; }
                        echo "</tr>";
                        $i = $i + 1;
                    }
                  }
                  else { echo "No results to show!"; } ?>
          </tbody>
        </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="modalNurse" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">List of all nurses</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table">
          <thead>
            <tr bgcolor="#948B8A">
              <th>#</th>
              <th>ID</th>
              <th>Name</th>
              <th>Salary</th>
              <th>Pay status</th>
            </tr>
          </thead>
          <tbody>
            <?php $conn = new mysqli("localhost", "root", "", "hospital-system");
                  $sql = "SELECT id, name, role, salary FROM `staff-details` where role='nurse' order by id asc";
                  $result = $conn->query($sql);
                  $i = 1;
                  if ($result)
                  {
                    // output data of each row
                    while($row = mysqli_fetch_array($result))
                    {
                      $temp = $row['id'];
                      $month = date('m');
                      $year = date('Y');
                      $s = "SELECT * from transactions where details='$temp' and MONTH(`datetime`)=$month and YEAR(`datetime`)=$year";
                      $r = $conn->query($s);
                        echo "<td>" . $i . "</td>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['salary'] . "</td>";
                        if($r->num_rows>0)
                          { echo "<td>" . 'Paid' . "</td>"; }
                        else
                          { echo "<td>" . 'Pending' . "</td>"; }
                        echo "</tr>";
                        $i = $i + 1;
                    }
                  }
                  else { echo "No results to show!"; } ?>
          </tbody>
        </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="modalReceptionist" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">List of all receptionists</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table">
          <thead>
            <tr bgcolor="#948B8A">
              <th>#</th>
              <th>ID</th>
              <th>Name</th>
              <th>Salary</th>
              <th>Pay status</th>
            </tr>
          </thead>
          <tbody>
            <?php $conn = new mysqli("localhost", "root", "", "hospital-system");
                  $sql = "SELECT id, name, role, salary FROM `staff-details` where role='receptionist' order by id asc";
                  $result = $conn->query($sql);
                  $i = 1;
                  if ($result)
                  {
                    // output data of each row
                    while($row = mysqli_fetch_array($result))
                    {
                      $temp = $row['id'];
                      $month = date('m');
                      $year = date('Y');
                      $s = "SELECT * from transactions where details='$temp' and MONTH(`datetime`)=$month and YEAR(`datetime`)=$year";
                      $r = $conn->query($s);
                        echo "<td>" . $i . "</td>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['salary'] . "</td>";
                        if($r->num_rows>0)
                          { echo "<td>" . 'Paid' . "</td>"; }
                        else
                          { echo "<td>" . 'Pending' . "</td>"; }
                        echo "</tr>";
                        $i = $i + 1;
                    }
                  }
                  else { echo "No results to show!"; } ?>
          </tbody>
        </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

</body>
