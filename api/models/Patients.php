<?php

class Patients {
  private $conn;
  private $table = 'patient';

  public function __construct($db) {
    $this->conn = $db;
  }

  public function get_details($text) {
    $query = 'SELECT * FROM `patient` WHERE
      (`name` LIKE ? OR `email-id` LIKE ?) AND
      `id` NOT IN ( SELECT `patient-id` FROM `admission-history` WHERE `status` = "Under Treatment")
      LIMIT 0, 5';
    $stmt = $this->conn->prepare($query);
    $text = "%" . $text . "%";
    $stmt->bind_param("ss", $text, $text);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
  }

  public function add_new_patient($name, $sex, $contact, $email, $address, $dob) {
    $checkValid = 'SELECT * FROM `patient` WHERE `name` = "' . $name . '" AND `sex` = "' . $sex . '" AND `date-of-birth` = "' . $dob . '"';
    $checkValid = $this->conn->query($checkValid);
    if($checkValid->num_rows > 0) return 'A similar patient already exists';

    $query = 'INSERT INTO `patient` (`name`, `date-of-birth`, `sex`, `address`, `email-id`, `contact-number`)
              VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssssss", $name, $dob, $sex, $address, $email, $contact);
    if(!$stmt->execute()) {
      return 'Could not add patient';
    } else {
      return 'Successfully added the new patient!';
    }
  }

  public function admit($patientID, $doctorID, $roomType) {
    $room = $this->conn->query('SELECT `room-id` FROM `rooms` WHERE `status` = "Free" AND `room-type` = "' . $roomType . '"');
    $room = $room->fetch_assoc();
    $room = $room['room-id'];

    $this->conn->query('UPDATE `rooms` SET `status` = "Booked" WHERE `room-id` = ' . $room);

    $result = $this->conn->query('SELECT MAX(`session-number`) AS "session" FROM `treatment-details`');
    $result = $result->fetch_assoc();
    $session_number = intval($result['session']);
    if($session_number == NULL) $session_number = 0;
    $session_number++;

    $itemID = $this->conn->query('SELECT `id` FROM `price-chart` WHERE `item-name` = "' . $roomType . '"');
    $itemID = $itemID->fetch_assoc();
    $itemID = $itemID['id'];

    $query = 'INSERT INTO `admission-history` (`patient-id`, `doctor-id`, `room-id`, `admission-date`, `discharge-date`, `status`) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $this->conn->prepare($query);
    $addDate = date('Y-m-d H:i:s');
    $disDate = '';
    $state = 'Under Treatment';
    $stmt->bind_param("ssssss", $patientID, $doctorID, $room, $addDate, $disDate, $state);
    if(!$stmt->execute()) {
      return 'Could not admit patient';
    }

    $query = 'INSERT INTO `treatment-details` (`patient-id`, `doctor-id`, `session-number`, `doctor-type`) VALUES (?, ?, ?, ?)';
    $stmt = $this->conn->prepare($query);
    $doctorType = 'Admitting';
    $stmt->bind_param("ssss", $patientID, $doctorID, $session_number, $doctorType);
    if(!$stmt->execute()) {
      return 'Could not admit patient';
    }

    $query = 'INSERT INTO `patient-history` (`patient-id`, `session-number`, `item-id`) VALUES (?, ?, ?)';
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("sss", $patientID, $session_number, $itemID);
    if(!$stmt->execute()) {
      return 'Could not admit patient';
    } else {
      return 'Admission successful!';
    }
  }

  public function get_summary($id) {
    $x = 'SELECT `patient-id` FROM `admission-history` WHERE `status` = "Under Treatment" AND `patient-id` = ' . $id;
    $x = $this->conn->query($x);
    $x = $x->num_rows;
    if($x == 0) return false;

    $session = $this->conn->query('SELECT MAX(`session-number`) AS "session" FROM `patient-history` WHERE `patient-id` = ' . $id);
    $session = $session->fetch_assoc();
    $session = $session['session'];

    $details = $this->conn->query('SELECT i.`item-name`, i.`price`, `quantity`, `datetime` FROM `patient-history`, `price-chart` i WHERE `item-id` = i.`id` AND `patient-id` = ' . $id . ' AND `session-number` = ' . $session);
    return $details;
  }

  public function get_history($id) {

  }

  public function get_visit_details($id) {
    $query = 'SELECT `doctor-id`, `datetime` FROM `treatment-details` WHERE `patient-id` = ' . $id . ' AND `doctor-type` = "Visiting" ORDER BY `datetime` DESC LIMIT 1';
    $result = $this->conn->query($query);
    $result = $result->fetch_assoc();
    $doctorID = $result['doctor-id'];
    $time = $result['datetime'];

    $query = 'SELECT `name` FROM `staff-details` WHERE `id` = ' . $doctorID;
    $name = $this->conn->query($query);
    if(!$name) return false;
    $name = $name->fetch_assoc();
    $name = $name['name'];

    $query = 'SELECT `visit-fees`, `datetime`, MIN(ABS(`datetime` - "' . $time . '")) FROM `doctor-schedule` WHERE `id` = ' . $doctorID . ' AND `status` = "booked"';
    $fees = $this->conn->query($query);
    $fees = $fees->fetch_assoc();
    $date = $fees['datetime'];
    $fees = $fees['visit-fees'];

    return array(
      'doctorID' => $doctorID,
      'doctor' => $name,
      'fees' => $fees,
      'datetime' => $time,
      'slot' => $date
    );
  }
}
