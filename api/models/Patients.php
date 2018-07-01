<?php

class Patients {
  private $conn;
  private $table = 'patient';

  public function __construct($db) {
    $this->conn = $db;
  }

  public function get_details($text) {
    $query = 'SELECT * FROM `patient` WHERE `name` LIKE ? OR `email-id` LIKE ? LIMIT 0, 5';
    $stmt = $this->conn->prepare($query);
    $text = "%" . $text . "%";
    $stmt->bind_param("ss", $text, $text);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
  }

  public function add_new_patient($name, $sex, $contact, $email, $address, $dob) {
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
}
