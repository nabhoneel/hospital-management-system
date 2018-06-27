<?php

class Patients {
  private $conn;
  private $table = 'patient';

  public function __construct($db) {
    $this->conn = $db;
  }

  public function get_details($text) {
    //$query = 'SELECT * FROM '
  }
}
