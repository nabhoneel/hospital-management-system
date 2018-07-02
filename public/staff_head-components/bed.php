<div class="allot">
  <div class="row">
    <div class="form-group col-4"><b><font size="+3">Status of Rooms</font></b></div>
    <div class="form-group col-4"></div>
    <div class="form-group col-4">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#free">Free</button>
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#booked">Booked</button>
    </div>

  </div>
</div>

<body>

  <?php

  $conn = new mysqli("localhost", "root", "","hospital-system");

  if ($conn->connect_error)
  {
    echo '<font size="4">Connection failed: ' . $conn->connect_error .'</font>';
  }
  else
  {
    $run = $conn->query("SELECT `department`.description, `rooms`.`room-id`, `rooms`.`room-type`, `rooms`.`status`, `price-chart`.`price`, `department`.`department-id` FROM `rooms` LEFT JOIN `department` on `rooms`.`department-id`=`department`.`department-id` JOIN `price-chart` ON `rooms`.`room-type`=`price-chart`.`item-name` order by `description`, `status`");

    if($run->num_rows > 0)
    {
      ?>
      <table class='w3-table-all w3-card-4'>
        <tr class='w3-yellow'>
          <th><font size=4> DEPARTMENT </th>
            <th><font size=4> ROOM NO.</th>
              <th><font size=4> ROOM TYPE</th>
                <th><font size=4> STATUS </th>
                  <th><font size=4> CHARGE </th>
                    <br><br>
                  </tr>


                  <?php
                  while($row = $run->fetch_array())
                  {
                    $department = $row[0];
                    $roomno = $row[1];
                    $room = $row[2];
                    $status = $row[3];
                    $charge= $row[4];

                    echo	"<tr>
                    <td><font size=4>$department</td>
                    <td><font size=4>$roomno</td>
                    <td><font size=4>$room</td>
                    <td><font size=4>$status</td>
                    <td><font size=4>$charge</td>
                    </tr>";
                  }
                }
                else
                {
                  echo '<font size="4">No Rows To Display</font>';
                }


              }
              ?>


            </table>

            <div class="modal" id="free" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">LIST OF FREE ROOMS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="table table-striped">
                      <table class="table">
                        <thead>
                          <tr bgcolor="#948B8A">

                            <th>DEPARTMENT</th>
                            <th>ROOM NO</th>
                            <th>ROOM TYPE</th>

                            <th>CHARGE</th>
                          </tr>
                        </thead>
                        <tbody> <?php
                        $run = $conn->query("SELECT `department`.description, `rooms`.`room-id`, `rooms`.`room-type`, `rooms`.`status`, `price-chart`.`price`, `department`.`department-id` FROM `rooms` LEFT JOIN `department` on `rooms`.`department-id`=`department`.`department-id` JOIN `price-chart` ON `rooms`.`room-type`=`price-chart`.`item-name` order by `description`, `status`");
                        if($run->num_rows > 0)
                        {
                          while($row = $run->fetch_array())
                          {
                            $department = $row[0];
                            $roomno = $row[1];
                            $roomtype = $row[2];
                            $status = $row[3];
                            $charge= $row[4];

                            if($status == 'Free')
                            {
                              echo	"<tr>
                              <td><font size=4>$department</td>
                              <td><font size=4>$roomno</td>

                              <td><font size=4>$roomtype</td>
                              <td><font size=4>$charge</td>
                              </tr>";}
                            }
                          }
                          else
                          {
                            echo '<font size="4">No Rows To Display</font>';
                          } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>  </div>  </div>  </div>

                  <div class="modal" id="booked" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">LIST OF BOOKED ROOMS</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="table table-striped">
                            <table class="table">
                              <thead>
                                <tr bgcolor="#948B8A">

                                  <th>DEPARTMENT</th>
                                  <th>ROOM NO</th>
                                  <th>ROOM TYPE</th>

                                  <th>CHARGE</th>
                                </tr>
                              </thead>
                              <tbody> <?php
                              $run = $conn->query("SELECT `department`.description, `rooms`.`room-id`, `rooms`.`room-type`, `rooms`.`status`, `price-chart`.`price`, `department`.`department-id` FROM `rooms` LEFT JOIN `department` on `rooms`.`department-id`=`department`.`department-id` JOIN `price-chart` ON `rooms`.`room-type`=`price-chart`.`item-name` order by `description`, `status`");
                              if($run->num_rows > 0)
                              {
                                while($row = $run->fetch_array())
                                {
                                  $department = $row[0];
                                  $roomno = $row[1];
                                  $roomtype = $row[2];
                                  $status = $row[3];
                                  $charge= $row[4];

                                  if($status == 'Booked')
                                  {
                                    echo	"<tr>
                                    <td><font size=4>$department</td>
                                    <td><font size=4>$roomno</td>

                                    <td><font size=4>$roomtype</td>
                                    <td><font size=4>$charge</td>
                                    </tr>";}
                                  }
                                }
                                else
                                {
                                  echo '<font size="4">No Rows To Display</font>';
                                } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>  </div>  </div>  </div>

                      </body>

                      <footer>
                        <?php load_default_scripts(); ?>
                      </footer>

                      </html>
