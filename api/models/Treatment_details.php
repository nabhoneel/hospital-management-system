<?php

class TreatmentDetails {
  private $conn;
  private $table = 'treatment-details';

  public function __construct($db) {
    $this->conn = $db;
  }

  public function add_detail($patient_id, $doctor_id, $type) {
    $result = $this->conn->query('SELECT MAX(`session-number`) AS "session" FROM `' . $this->table . '`');
    $result = $result->fetch_assoc();
    $session_number = intval($result['session']);
    if($session_number == NULL) $session_number = 0;
    $session_number++;

    $query = 'INSERT INTO `' . $this->table . '` (`patient-id`, `doctor-id`, `session-number`, `doctor-type`)
              VALUES (?, ?, ?, ?)';

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("iiis", $patient_id, $doctor_id, $session_number, $type);
    $state = $stmt->execute();
    if(!$state) {
      return false;
    } else {
      return true;
    }
  }
}
