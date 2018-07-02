<?php
$db = new Database();
$temp = $db->connect();
?>

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

.rooms {
  margin: auto;
}

.align-center {
  display: flex;
  align-items: center;
  justify-content: center;
}

</style>

<div class="row">
  <div class="col-1"></div>
  <div class="col-7">
    <h3>Nurses Present Now</h3>
    <?php

    $conn = new mysqli("localhost", "root", "","hospital-system");

    if ($conn->connect_error)
    {
      echo '<font size="4">Connection failed: ' . $conn->connect_error .'</font>';
    }
    else
    {
      $run = $conn->query("SELECT `nurse-duty`.`nurse-id`, `staff-details`.`name`, `nurse-duty`.`shift`, `attendance`.`entry-time` FROM `nurse-duty` LEFT JOIN `staff-details` ON `nurse-duty`.`nurse-id`=`staff-details`.`id` INNER JOIN `attendance` ON `nurse-duty`.`nurse-id`=`attendance`.`id` WHERE `attendance`.`exit-time` IS NULL and `date`=CURRENT_DATE");

      if($run->num_rows > 0)
      {
        ?>
        <table class='w3-table-all w3-card-4'>
          <tr class='w3-green'>

            <th><font size=4>ID</th>
              <th><font size=4>NAME</th>
                <th><font size=4>SHIFT</th>
                  <th><font size=4>ENTRY TIME</th>
                    <br><br>
                  </tr>


                  <?php
                  $i = 0;
                  while($row = $run->fetch_array())
                  {
                    $id = $row[0];
                    $name = $row[1];
                    $shift = $row[2];
                    $time = $row[3];


                    echo	"<tr>

                    <td>$id</td>
                    <td>$name</td>
                    <td>$shift</td>
                    <td>$time</td>
                    </tr>";
                    $i = $i + 1;

                  }
                  $blank="-";
                  while($i<20)
                  {
                    echo	"<tr>
                    <td>$blank</td>
                    <td>$blank</td>
                    <td>$blank</td>
                    <td>$blank</td>
                    </tr>";
                    $i = $i + 1;
                  }
                }
                else
                {
                  echo '<font size="4">No Rows To Display</font>';
                }


              }
              ?>


            </table>
          </div>
          <div class="col-1"></div>
          <div class="col-3">
            <div class="container">

              <h3 >Free allotted Rooms</h3><br>
              <form action="<?php echo get_homeurl(); ?>/public/staff_head-components/trans_disc.php" method="post">
                <p>
                  <label for="ARec">Bed No/Patient:</label>
                  <select name="arec" id="ARec" class="custom-select">
                    <option value="0">Not Selected</option>
                    <?php
                    $res6=mysqli_query($temp,"SELECT `patient`.`id`, `patient`.`name`, `admission-history`.`room-id`, `admission-history`.`patient-id` FROM `patient` INNER JOIN `admission-history` ON `patient`.`id`=`admission-history`.`patient-id` JOIN `rooms` ON `admission-history`.`room-id`=`rooms`.`room-id` WHERE `rooms`.`status`='Booked' ORDER BY `patient`.`name`");
                    while($row6=mysqli_fetch_array($res6))
                    {
                      ?>
                      <option value="<?php echo $row6[0]?>"><?php echo "Bed-".$row6["2"].":    ".$row6["1"]; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </p>
                <p>

                  <?php if(isset($_COOKIE['room-free-status']) && $_COOKIE['room-free-status'] == 'true') : ?>
                    <div class="alert alert-success alert-dismissible fade show">
                      The room was freed
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <?php endif; ?>

                  <input class="submit btn btn-info" type="submit" value="Free">
                  <input type="reset" class=" btn btn-primary">
                </form>

              </div>
              <hr>
              <h3>Allocate Nurse</h3>
              <form action="<?php echo get_homeurl(); ?>/public/staff_head-components/allot_nurse.php" method="post">
                <div class="allot">
                  <div class="row align-items">

                    <p>

                      <label for="NShift">Shift:</label>
                      <select name="nshift" id="NShift" onchange="changenurselist(this, '.nurse-allot-names')" class="custom-select">
                        <option value="0">Not Selected</option>
                        <?php
                        $res6=mysqli_query($temp,"SELECT distinct `shift` FROM `nurse-duty`");
                        while($row6=mysqli_fetch_array($res6))
                        {
                          ?>
                          <option value="<?php echo $row6[0]?>"><?php echo $row6["0"];?></option>
                          <?php
                        }
                        ?>
                      </select>



                      <label for="NType">Nurse:</label>
                      <select name="ntype" id="NType" class="nurse-allot-names custom-select">
                        <option value="0">Not Selected</option>
                        <?php
                        $res6=mysqli_query($temp,"SELECT `staff-details`.`id`, `staff-details`.`name`, `nurse-duty`.`shift`, `nurse-duty`.`nurse-id` FROM `staff-details` INNER JOIN `nurse-duty` ON `staff-details`.`id`=`nurse-duty`.`nurse-id` WHERE `nurse-duty`.`room-id`='0' ORDER BY name");
                        while($row6=mysqli_fetch_array($res6))
                        {
                          ?>
                          <option class="<?php echo $row6[2]; ?>" value="<?php echo $row6[0]?>"><?php echo $row6[1];?></option>
                          <?php
                        }
                        ?>
                      </select>


                      <label for="NBed">Bed No/Patient:</label>
                      <select name="nbed" id="NBed" class="custom-select">
                        <option value="0">Not Selected</option>
                        <?php
                        $res6=mysqli_query($temp,"SELECT `patient`.`id`, `patient`.`name`, `admission-history`.`room-id`, `admission-history`.`patient-id` FROM `patient` INNER JOIN `admission-history` ON `patient`.`id`=`admission-history`.`patient-id` JOIN `rooms` ON `admission-history`.`room-id`=`rooms`.`room-id` WHERE `rooms`.`status`='Booked' ORDER BY `patient`.`name`");
                        while($row6=mysqli_fetch_array($res6))
                        {
                          ?>
                          <option value="<?php echo $row6[0]?>"><?php echo "Bed-".$row6["2"].":    ".$row6["1"]; ?></option>
                          <?php
                        }
                        ?>
                      </select>

                    </div>

                    <?php if(isset($_COOKIE['nurse-allot-status']) && $_COOKIE['nurse-allot-status'] == 'true') : ?>
                      <div class="alert alert-success alert-dismissible fade show">
                        Nurse was allotted
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <?php endif; ?>

                    <input class="submit btn btn-info" type="submit" value="Allot">
                    <input type="reset" class=" btn btn-primary">
                  </form>

                  <hr>
                  <h3>Free Booked Nurse</h3>
                  <form action="<?php echo get_homeurl(); ?>/public/staff_head-components/free_nurse.php" method="post" class="rooms">
                    <div class="allot">
                      <div class="row align-center">
                        <p>

                          <label for="NShift">Shift:</label>
                          <select name="nshift" id="NShift" onchange="changenurselist(this, '.nurse-free-names')" class="custom-select">
                            <option value="0">Not Selected</option>
                            <?php
                            $res6=mysqli_query($temp,"SELECT distinct `shift` FROM `nurse-duty`");
                            while($row6=mysqli_fetch_array($res6))
                            {
                              ?>
                              <option value="<?php echo $row6[0]?>"><?php echo $row6["0"];?></option>
                              <?php
                            }
                            ?>
                          </select>


                          <label for="NType">Nurse:</label>
                          <select name="ntype" id="NType" class="nurse-free-names custom-select">
                            <option value="0">Not Selected</option>
                            <?php
                            $res6=mysqli_query($temp,"SELECT `staff-details`.`id`, `staff-details`.`name`, `nurse-duty`.`shift`, `nurse-duty`.`nurse-id` FROM `staff-details` INNER JOIN `nurse-duty` ON `staff-details`.`id`=`nurse-duty`.`nurse-id` WHERE `nurse-duty`.`room-id`!='0' ORDER BY name");
                            while($row6=mysqli_fetch_array($res6))
                            {
                              ?>
                              <option class="<?php echo $row6[2]; ?>" value="<?php echo $row6[0]?>"><?php echo $row6["1"];?></option>
                              <?php
                            }
                            ?>
                          </select>

                        </div>
                        <?php if(isset($_COOKIE['nurse-freed-status']) && $_COOKIE['nurse-freed-status'] == 'true') : ?>
                          <div class="alert alert-success alert-dismissible fade show">
                            Nurse was freed
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <?php endif; ?>
                        <input class="submit btn btn-info" type="submit" value="Free">
                        <input type="reset" class=" btn btn-primary">
                      </form>
                    </div>
                  </div>
                  <?php set_script('staffhead.js'); ?>
