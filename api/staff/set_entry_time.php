<?php

include_once('../config/Database.php');
include_once('../models/Staff_Details.php');

$db = new Database();
$staff = new StaffDetails($db->connect());

//Get raw posted JSON data:
$data = json_decode(file_get_contents("php://input"));

$staff->set_entry_time($data->id);
