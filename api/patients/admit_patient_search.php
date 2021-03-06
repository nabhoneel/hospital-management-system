<?php

include_once('../config/Database.php');
include_once('../models/Patients.php');

$db = new Database();
$patients = new Patients($db->connect());

//Get raw posted JSON data:
$data = json_decode(file_get_contents("php://input"));

$details = $patients->get_details($data->text);

foreach($details as $key => $patient) {
  ?>
  <div class="search-result" onclick="setAdmitPatientDetails('<?php echo $patient['id']; ?>', '<?php echo $patient['name']; ?>', '<?php echo $patient['sex']; ?>', '<?php echo $patient['date-of-birth']; ?>', '<?php echo $patient['address']; ?>', '<?php echo $patient['email-id']; ?>', '<?php echo $patient['contact-number']; ?>')">
    <span class="result-name"><?php echo $patient['name']; ?></span>
    <span class="result-email"><?php echo $patient['email-id']; ?></span>
  </div>
  <?php
}
?>
