<?php

include_once('../config/Database.php');
include_once('../models/Patients.php');

$db = new Database();
$patients = new Patients($db->connect());

//Get raw posted JSON data:
$data = json_decode(file_get_contents("php://input"));

$status = $patients->add_new_patient(
  $data->name,
  $data->sex,
  $data->contact,
  $data->email,
  $data->address,
  $data->dob
);

echo $status;
