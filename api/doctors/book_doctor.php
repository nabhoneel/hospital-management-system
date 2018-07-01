<?php

include_once('../config/Database.php');
include_once('../models/Doctors.php');
include_once('../models/Treatment_Details.php');

$db = new Database();
$doctors = new Doctors($db->connect());
$treatment = new TreatmentDetails($db->connect());

//Get raw posted JSON data:
$data = json_decode(file_get_contents("php://input"));

$treatment_status = $treatment->add_detail($data->patientID, $data->doctorID, 'single visit');
$doctor_status = $doctors->book($data->doctorID, $data->slot);
if($treatment_status && $doctor_status) : ?>

  <div class="alert alert-success alert-dismissible fade show" role="alert">
    Booking successful!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

<?php else : ?>

  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    Booking failed
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

<?php endif; ?>
