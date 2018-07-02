<?php add_authorization(); ?>

<div class="patients">
  <div class="alert alert-info" style="display: none;"></div>
  <div class="row">
    <div class="available-doctors col-12">Patient Summary</div>
    <div class="col-3 patients-list-panel">
      <input type="text" class="form-control" onkeyup="reducePatientsList(this)">
      <ul class="custom-list">
        <?php

        $db = new Database();
        $conn = $db->connect();
        $results = $conn->query('SELECT `id`, `name` FROM `patient`');// WHERE `id` IN (SELECT `patient-id` FROM `admission-history` WHERE `status` = "Under Treatment")');
        while($row = $results->fetch_assoc()) {
          ?>
          <li id="<?php echo $row['id']; ?>" onclick="showPatientHistory('<?php echo $row['id']; ?>')"><?php echo $row['name']; ?></li>
          <?php
        }
        ?>
      </ul>
    </div>
    <div class="col-9 patients-details"></div>
  </div>
</div>
