<?php

/* Create a connection below: */
$db = new Database();
$conn = $db->connect();

$query = 'SELECT `id` FROM `staff-details` WHERE `role` = "doctor"';
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$shifts = array(8, 10, 12, 4, 6, 8);
$prices = array(400, 500, 700, 800);
$days = array(1, 2, 3, 4, 5, 6, 7);

$query = 'INSERT INTO `doctor-schedule` (`id`, `datetime`, `day-of-week`, `visit-fees`, `percentage`, `consult-fees`) VALUES (?, ?, ?, ?, ?, ?)';
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssss", $id, $datetime, $day, $visit, $percentage, $consult);

$percentage = 20;
foreach($result as $x) {
  $id = $x['id'];
  foreach($days as $day) {
    $randIndex = array_rand($shifts, 2);

    $date = mktime($shifts[$randIndex[0]], 0, 0, 7, intval($day), 2018);
    $datetime = date('Y-m-d H:i:s', $date);
    $jd = cal_to_jd(CAL_GREGORIAN,date("m", $date),date("d", $date),date("Y", $date));
    $day = jddayofweek($jd,1);
    $visit = $prices[array_rand($prices)];
    $consult = $visit - 100;
    $stmt->execute();

    $date = mktime($shifts[$randIndex[1]], 0, 0, 7, $day, 2018);
    $datetime = date('Y-m-d H:i:s', $date);
    $jd = cal_to_jd(CAL_GREGORIAN,date("m", $date),date("d", $date),date("Y", $date));
    $day = jddayofweek($jd,1);
    $visit = $prices[array_rand($prices)];
    $consult = $visit - 100;
    $stmt->execute();
  }
}

?>
