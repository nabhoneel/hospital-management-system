<?php

include_once('../config/Database.php');
include_once('../models/Patients.php');

$db = new Database();
$patients = new Patients($db->connect());

//Get raw posted JSON data:
$data = json_decode(file_get_contents("php://input"));

$state = $patients->admit(
  $data->patientID,
  $data->doctorID,
  $data->roomType
);

?>

<div class="alert alert-info" role="alert">
  <?php echo $state; ?>
</div>
