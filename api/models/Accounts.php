<?php

class Accounts {
  private $conn;
  private $table = "login";

  //Login properties:
  public $id;
  public $username;
  public $password;
  public $role;

  public function __construct($db) {
    $this->conn = $db;
  }

  //Get all accounts as an array:
  public function read_all_accounts() {
    $query = 'SELECT
    *
    FROM
    ' . $this->table;

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;//returns rows
  }

  //Finding one account by the username:
  public function read_one_account($username) {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE username = ?';

    $row = null;
    try {
      $stmt = $this->conn->prepare($query);
      $stmt->bind_param('s', $username);
      $stmt->execute();
      $result = $stmt -> get_result();
      $row = $result -> fetch_assoc();
    } catch(Exception $e) {
      echo $e;
    }

    if($row != null) {
      $this->id = $row['id'];
      $this->username = $row['username'];
      $this->password = $row['password'];
      $this->role = $row['role'];
      return true;
    } else {
      return false;
    }
  }

}
