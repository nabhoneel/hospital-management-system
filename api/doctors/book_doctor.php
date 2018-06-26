<?php

include_once('../config/Database.php');
include_once('../models/Doctors.php');

$db = new Database();
$doctors = new Doctors($db->connect());

//Get raw posted JSON data:
$data = json_decode(file_get_contents("php://input"));

if($doctors->book($data->id, $data->slot) == true) :
  ?>

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
