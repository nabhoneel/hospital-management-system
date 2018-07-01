<?php

class Transactions {
  private $conn;
  private $table = 'transactions';

  public function __construct($db) {
    $this->conn = $db;
  }

  public function pay_salary($id) {
    try {
      $debit = 'SELECT `salary` FROM `staff-details` WHERE `id` = ' . $id;
      $debit = $this->conn->query($debit);
      $debit = $debit->fetch_assoc();
      $debit = floatval($debit['salary']);
      if($debit == 0) throw new \Exception("Error Processing Request", 1);

      $balance = 'SELECT `balance` FROM `transactions` ORDER BY `datetime` DESC LIMIT 1';
      $balance = $this->conn->query($balance);
      $balance = $balance->fetch_assoc();
      $balance = floatval($balance['balance']);

      $balance -= $debit;

      $query = 'INSERT INTO `' . $this->table . '` (`debit`, `balance`, `details`)
      VALUES (?, ?, ?)';
      $stmt = $this->conn->prepare($query);
      $stmt->bind_param("sss", $debit, $balance, $id);
      $stmt->execute();

      echo 'Payment successful';
    } catch(Exception $e) {
      echo 'Payment unsuccessful';
    }
  }
}
