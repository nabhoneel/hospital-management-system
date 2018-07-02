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

</style>

<h3>Free allotted Rooms</h3><br>
<form action="/hospital-system/public/staff_head-components/trans_disc.php" method="post">
  <p>
    <label for="ARec">Bed No/Patient:</label>
    <select name="arec" id="ARec">
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

    <input class="submit" type="submit" value="Submit">
    <input type="reset">
  </form>

</div>
<br><br>

<h3>Allocate Nurse</h3>
<form action="/hospital-system/public/staff_head-components/allot_nurse.php" method="post">
  <div class="allot">
    <div class="row">
      <div class="available-doctors col-3"></div>
      <p>
        <div class="form-group col-2">
          <label for="NShift">Shift:</label>
          <select name="nshift" id="NShift" onchange="changenurselist()">
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
        </div>
        <div class="form-group col-2">
          <label for="NType">Nurse:</label>
          <select name="ntype" id="NType">
            <option value="0">Not Selected</option>
            <?php
            $res6=mysqli_query($temp,"SELECT `staff-details`.`id`, `staff-details`.`name`, `nurse-duty`.`nurse-id` FROM `staff-details` INNER JOIN `nurse-duty` ON `staff-details`.`id`=`nurse-duty`.`nurse-id` WHERE `nurse-duty`.`room-id`='0' ORDER BY name");
            while($row6=mysqli_fetch_array($res6))
            {
              ?>
              <option value="<?php echo $row6[0]?>"><?php echo $row6["1"];?></option>
              <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group col-2">
          <label for="NBed">Bed No/Patient:</label>
          <select name="nbed" id="NBed">
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
      </div>
    </div>

    <input class="submit" type="submit" value="Submit">
    <input type="reset">
  </form>

  <br><br>
  <h3>Free Booked Nurse</h3>
  <form action="/hospital-system/public/staff_head-components/free_nurse.php" method="post">
    <div class="allot">
      <div class="row">
        <div class="available-doctors col-3"></div>
        <p>
          <div class="form-group col-2">
            <label for="NShift">Shift:</label>
            <select name="nshift" id="NShift" onchange="changenurselist()">
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
          </div>
          <div class="form-group col-2">
            <label for="NType">Nurse:</label>
            <select name="ntype" id="NType">
              <option value="0">Not Selected</option>
              <?php
              $res6=mysqli_query($temp,"SELECT `staff-details`.`id`, `staff-details`.`name`, `nurse-duty`.`nurse-id` FROM `staff-details` INNER JOIN `nurse-duty` ON `staff-details`.`id`=`nurse-duty`.`nurse-id` WHERE `nurse-duty`.`room-id`!='0' ORDER BY name");
              while($row6=mysqli_fetch_array($res6))
              {
                ?>
                <option value="<?php echo $row6[0]?>"><?php echo $row6["1"];?></option>
                <?php
              }
              ?>
            </select>
          </div>
        </div>
        <input class="submit" type="submit" value="Submit">
        <input type="reset">
      </form>

      <?php set_script('staffhead.js'); ?>
