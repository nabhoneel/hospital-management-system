<?php

class StaffDetails {
  private $conn;
  private $table = 'staff-details';

  public function __construct($db) {
    $this->conn = $db;
  }

  public function get_roles() {
    $query = 'SELECT DISTINCT `role` FROM `' . $this->table . '`';
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
  }

  public function get_all_details($text, $department, $type) {
    $query = 'SELECT
    `id`, `name`, `role`, `contact`, `description`
    FROM
    `' . $this->table . '` s LEFT JOIN `department` d ON s.`department` = d.`department-id`
    WHERE
    (`name` LIKE ? OR `contact` LIKE ?) AND
    (`department` IS NULL OR `department` = ?) AND
    `role` LIKE ?';
    $stmt = $this->conn->prepare($query);
    $text = "%" . $text . "%";
    $department = $department == 0 ? '' : $department;
    $stmt->bind_param("ssss", $text, $text, $department, $type);
    $stmt->execute();

    $results = $stmt->get_result();

    return $results;
  }

  public function set_entry_time($id) {
    $query = 'INSERT INTO `attendance` (`id`, `date`, `entry-time`, `exit-time`) VALUES (?, ?, ?, ?)';
    $stmt = $this->conn->prepare($query);
    $entry = date("H:i:s");
    $date = date("Y-m-d");
    $exit = NULL;
    $stmt->bind_param("ssss", $id, $date, $entry, $exit);
    $stmt->execute();
    $result = $stmt->get_result();

    echo $entry;
  }

  public function set_exit_time($id) {
    $query = 'UPDATE `attendance` SET `exit-time` = ? WHERE `id` = ?';
    $stmt = $this->conn->prepare($query);
    $exit = date("H:i:s");
    $stmt->bind_param("ss", $exit, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    echo $exit;
  }

  public function get_entry_time($id) {
    $query = 'SELECT `entry-time` FROM `attendance` WHERE `id` = ' . $id;
    $result = $this->conn->query($query);
    if($result != false) {
      $result = $result->fetch_assoc();
      $result = $result['entry-time'];
    }

    return $result;
  }

  public function get_exit_time($id) {
    $query = 'SELECT `exit-time` FROM `attendance` WHERE `id` = ' . $id;
    $result = $this->conn->query($query);
    if($result != false) {
      $result = $result->fetch_assoc();
      $result = $result['exit-time'];
    }

    return $result;
  }
}
