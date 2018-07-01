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

<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
</script>

<body>
  <br><h1>Pending transactions for the month of:
    <?php
    $m = date('m');
    $y = date('Y');
    $month = date('F');
    echo $month; ?> </h1><br>

    <div class="allot">
      <div class="row">
        <div class="form-group col-4"></div>
        <div class="form-group col-4">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#curBal">Check current balance</button>
        </div>
      </div>
    </div>

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
              <th>Account number</th>
              <th>IFSC code</th>
              <th>Status</th>
              <th>Paid</th>
            </tr>
          </thead>
          <tbody>
            <?php $conn = new mysqli("localhost", "root", "", "hospital-system");
            $sql = "SELECT * from transactions where details not in (SELECT details from transactions where MONTH(`datetime`)=$m and YEAR(`datetime`)=$y) and details not like 'B%'";
            $result = $conn->query($sql);
            $i = 1;
            if ($result)
            {
              // output data of each row
              while($row = mysqli_fetch_array($result))
              {
                echo "<td>" . $i . "</td>";
                echo "<td>" . $row['details'] . "</td>";
                $tid = $row['details'];

                $s = "SELECT name, role, salary from `staff-details` where id=$tid";
                $res = $conn->query($s);
                $r = mysqli_fetch_array($res);
                $varRole = $r['role'];
                $sal = $r['salary'];
                $p = "SELECT `account-number`, ifsc from `salary-sheet` where id=$tid";
                $q = $conn->query($p);
                $a = mysqli_fetch_array($q);
                if($varRole!='admin' && $varRole!='account manager')
                {
                  echo "<td>" . $r['name'] . "</td>";
                  echo "<td>" . $r['role'] . "</td>";
                  echo "<td>" . $r['salary'] . "</td>";
                  echo "<td>" . $a['account-number'] . "</td>";
                  echo "<td>" . $a['ifsc'] . "</td>";
                }
                ?> <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#PayNowModal">Pay Now</button> </td> <?php
                echo "</tr>";
                $i = $i + 1;
              }
            }
            $sql = "SELECT id from `staff-details` where id not in (SELECT details from transactions)";
            $result = $conn->query($sql);
            $i = 1;
            if ($result)
            {
              // output data of each row
              while($row = mysqli_fetch_array($result))
              {
                echo "<td>" . $i . "</td>";
                echo "<td>" . $row['id'] . "</td>";
                $tid = $row['id'];

                $s = "SELECT name, role, salary from `staff-details` where id=$tid";
                $res = $conn->query($s);
                $r = mysqli_fetch_array($res);

                echo "<td>" . $r['name'] . "</td>";
                echo "<td>" . $r['role'] . "</td>";
                echo "<td>" . $r['salary'] . "</td>";
                $sal = $r['salary'];

                $p = "SELECT `account-number`, ifsc from `salary-sheet` where id=$tid";
                $q = $conn->query($p);
                $a = mysqli_fetch_array($q);

                echo "<td>" . $a['account-number'] . "</td>";
                echo "<td>" . $a['ifsc'] . "</td>";

                ?> <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#PayNowModal">Pay Now</button> </td> <?php
                echo "</tr>";
                $i = $i + 1;
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="modal" id="PayNowModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Payment Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Enter ID once more: &nbsp;
            <select class="custom-select" id="paymentID" name="idPay">
              <?php

              $sql = "SELECT id from `staff-details` where id not in (SELECT details from transactions)";
              $result = $conn->query($sql);
              $i = 1;
              if ($result)
              {
                // output data of each row
                while($row = mysqli_fetch_array($result))
                {
                  echo '<option value = "' . $row['id'] . '">' . $row['id'] . '</option>';
                }
              }

              ?>
            </select><br><br>
            <div class="alert alert-info" role="alert" id="payment-status" style="display: none;"></div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-warning" value="Submit" onclick="makePayment()">Confirm</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" id="curBal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Balance update</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Current Balance is
            <?php $conn = new mysqli("localhost", "root", "", "hospital-system");
            $sql = "SELECT balance from `transactions` order by `datetime` DESC limit 1";
            $result = $conn->query($sql);
            $row = mysqli_fetch_array($result);
            echo $row['balance'];
            echo '.' ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

  </body>

  <footer>
    <?php load_default_scripts(); ?>
    <?php set_script('transactions.js'); ?>
  </footer>
