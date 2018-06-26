<?php

class Doctors {
  private $conn;
  private $table = 'staff-details';
  private $table_doctor_schedule = 'doctor-schedule';

  public function __construct($db) {
    $this->conn = $db;
  }

  // Doctor details:
  public function get_doctors() {
    $query = 'SELECT * FROM `' . $this->table . '` WHERE `role` = "Doctor"';

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();

    return $result;
  }

  // IDs of available doctors:
  public function get_available_doctors($name, $specialization, $date, $time) {
    $query = 'SELECT
                s.`id`, `name`, `specialization`, `datetime`, DATE_FORMAT(`datetime`, "%d %M %Y") AS "date", DATE_FORMAT(`datetime`, "%h : %i %p") AS "time", `visit-fees`
              FROM
                `' . $this->table . '` s INNER JOIN `doctor-schedule`
              WHERE
                s.`role` = "Doctor" AND
                s.`name` LIKE ? AND
                s.`specialization` LIKE ? AND
                `datetime` > ? AND
                `status` = "free"
              ORDER BY s.`name`';

    $datetime = $date . ' ' . $time;
    $name = $name . "%";
    $specialization = $specialization . "%";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("sss", $name, $specialization, $datetime);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();
    return $result;
  }

  // Book a doctor with specified id at given timeslot:
  public function book($id, $datetime) {
    $query = 'UPDATE `doctor-schedule` SET `status` = "booked" WHERE `id` = ? AND `datetime` = ?';
    try {
      $stmt = $this->conn->prepare($query);
      $stmt->bind_param("ss", $id, $datetime);
      $stmt->execute();
      return true;
    } catch(Exception $e) {
      return false;
    }

    $stmt->close();
  }

  // List of specializations of doctors:
  public function get_specializations() {
    $query = 'SELECT DISTINCT `specialization` FROM `' . $this->table . '` WHERE `role` = "Doctor"';
    echo $query;

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();

    $arr = array();
    // Converting the rows to an array with numeric indices, specialization values as data:
    foreach($result as $specialization) {
      array_push($arr, $specialization['specialization']);
    }

    return $arr;
  }
}
