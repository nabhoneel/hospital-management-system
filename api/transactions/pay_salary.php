<?php

include_once('../config/Database.php');
include_once('../models/Transactions.php');

$db = new Database();
$staff = new Transactions($db->connect());

//Get raw posted JSON data:
$data = json_decode(file_get_contents("php://input"));

$staff->pay_salary($data->id);
