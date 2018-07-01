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
  public function get_available_doctors($name, $department_id, $date, $time) {
    $query = 'SELECT
              	s.`id`,
                  `name`,
                  `department`,
                  `datetime`,
                  DATE_FORMAT(`datetime`, "%d %M %Y") AS "date",
                  DATE_FORMAT(`datetime`, "%h : %i %p") AS "time",
                  `visit-fees`
              FROM
              	`staff-details` s, `doctor-schedule` d
              WHERE
                  s.`id` = d.`id` AND
                  s.`role` = "doctor" AND
                  s.`name` LIKE ? AND
                  s.`department` = ? AND
                  `datetime` >= ? AND
                  `status` = "free"
              ORDER BY s.`name`, `datetime`';

    $datetime = $date == '' ? date('Y-m-d H:i:s') : ($date . ' ' . $time);
    $name = "%" . $name . "%";
    $department_id = $department_id . "%";
    // echo $query;

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("sis", $name, $department_id, $datetime);
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
    $query = 'SELECT `department-id`, `description` FROM `department`';

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();

    return $result;
  }
}
