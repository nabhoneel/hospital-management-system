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
    <div class="form-group col-4"><b><font size="+3">Transaction Details</font></b></div>
    <div class="form-group col-4">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#2018">Year: 2018</button>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#2017">Year: 2017</button>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#2016">Year: 2016</button>
    </div>
    <div class="available-doctors col-4"> <?php echo "Today is " . date("Y-m-d") . "<br>"; ?>
    </div>
    </div>
  </div>

  <body>
    <div class="container">
      <div class="table table-striped">
        <table class="table">
        <thead>
          <tr bgcolor="#948B8A">
            <th>#</th>
            <th>Date, Time</th>
            <th>Type</th>
            <th>Balance</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
          <?php $conn = new mysqli("localhost", "root", "", "hospital-system");
                $sql = "SELECT * FROM transactions order by `datetime` desc";
                $result = $conn->query($sql);
                $i = 1;
                if ($result)
                {
                  // output data of each row
                  while($row = mysqli_fetch_array($result))
                  {
                    echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $row['datetime'] . "</td>";
                    $a = $row['credit'];
                    $b = $row['debit'];
                    if ($a == 0) {
                      echo "<td>" . "Debit" . "</td>"; }
                    else {
                      echo "<td>" . "Debit" . "</td>";
                    }
                    echo "<td>" . $row['balance'] . "</td>";
                    echo "<td>" . $row['details'] . "</td>";
                    echo "</tr>";
                    $i = $i + 1;
                  }
                }
                else { echo "No results to show!"; } ?>
        </tbody>
      </table>
      </div>
    </div>

    <div class="modal" id="2018" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Year: 2018</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table table-striped">
              <table class="table">
              <thead>
                <tr bgcolor="#948B8A">
                  <th>#</th>
                  <th>Date, Time</th>
                  <th>Type</th>
                  <th>Balance</th>
                  <th>Details</th>
                </tr>
              </thead>
              <tbody> <?php $year = date('Y');
                  $s1 = "SELECT * FROM transactions  WHERE YEAR(`datetime`)=$year order by `datetime` desc";
                  $r1 = $conn->query($s1);
                  $i = 1;
                  if ($r1)
                  {
                    // output data of each row
                    while($row = mysqli_fetch_array($r1))
                    {
                      echo "<tr>";
                      echo "<td>" . $i . "</td>";
                      echo "<td>" . $row['datetime'] . "</td>";
                      $a = $row['credit'];
                      $b = $row['debit'];
                      if ($a == 0) {
                        echo "<td>" . "Debit" . "</td>"; }
                      else {
                        echo "<td>" . "Debit" . "</td>";
                      }
                      echo "<td>" . $row['balance'] . "</td>";
                      echo "<td>" . $row['details'] . "</td>";
                      echo "</tr>";
                      $i = $i + 1;
                    }
                  }
                  else { echo "No results to show!"; } ?>
                </tbody>
              </table>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" id="2017" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Year: 2017</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table table-striped">
              <table class="table">
              <thead>
                <tr bgcolor="#948B8A">
                  <th>#</th>
                  <th>Date, Time</th>
                  <th>Type</th>
                  <th>Balance</th>
                  <th>Details</th>
                </tr>
              </thead>
              <tbody> <?php $year = date('Y') - 1;
                  $s1 = "SELECT * FROM transactions  WHERE YEAR(`datetime`)=$year order by `datetime` desc";
                  $r1 = $conn->query($s1);
                  $i = 1;
                  if ($r1)
                  {
                    // output data of each row
                    while($row = mysqli_fetch_array($r1))
                    {
                      echo "<tr>";
                      echo "<td>" . $i . "</td>";
                      echo "<td>" . $row['datetime'] . "</td>";
                      $a = $row['credit'];
                      $b = $row['debit'];
                      if ($a == 0) {
                        echo "<td>" . "Debit" . "</td>"; }
                      else {
                        echo "<td>" . "Debit" . "</td>";
                      }
                      echo "<td>" . $row['balance'] . "</td>";
                      echo "<td>" . $row['details'] . "</td>";
                      echo "</tr>";
                      $i = $i + 1;
                    }
                  }
                  else { echo "No results to show!"; } ?>
                </tbody>
              </table>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" id="2016" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Year: 2016</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table table-striped">
              <table class="table">
              <thead>
                <tr bgcolor="#948B8A">
                  <th>#</th>
                  <th>Date, Time</th>
                  <th>Type</th>
                  <th>Balance</th>
                  <th>Details</th>
                </tr>
              </thead>
              <tbody> <?php $year = date('Y') - 2;
                  $s1 = "SELECT * FROM transactions  WHERE YEAR(`datetime`)=$year order by `datetime` desc";
                  $r1 = $conn->query($s1);
                  $i = 1;
                  if ($r1->num_rows>0)
                  {
                    // output data of each row
                    while($row = mysqli_fetch_array($r1))
                    {
                      echo "<tr>";
                      echo "<td>" . $i . "</td>";
                      echo "<td>" . $row['datetime'] . "</td>";
                      $a = $row['credit'];
                      $b = $row['debit'];
                      if ($a == 0) {
                        echo "<td>" . "Debit" . "</td>"; }
                      else {
                        echo "<td>" . "Debit" . "</td>";
                      }
                      echo "<td>" . $row['balance'] . "</td>";
                      echo "<td>" . $row['details'] . "</td>";
                      echo "</tr>";
                      $i = $i + 1;
                    }
                  }
                  else { echo "No results to show!"; } ?>
                </tbody>
              </table>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

  </body>
