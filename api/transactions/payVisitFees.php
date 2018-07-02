<?php

include_once('../config/Database.php');
include_once('../models/Transactions.php');

$db = new Database();
$staff = new Transactions($db->connect());

//Get raw posted JSON data:
$data = json_decode(file_get_contents("php://input"));

$state = $staff->payVisitFees($data->slot, $data->id, $data->fees);

if($state == true) echo 'Payment successful';
else echo 'Error while payment';
