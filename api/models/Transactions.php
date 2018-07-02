<?php

class Transactions {
  private $conn;
  private $table = 'transactions';

  public function __construct($db) {
    $this->conn = $db;
  }

  public function discharge($id, $total) {
    $balance = 'SELECT `balance` FROM `transactions` ORDER BY `datetime` DESC LIMIT 1';
    $balance = $this->conn->query($balance);
    $balance = $balance->fetch_assoc();
    $balance = floatval($balance['balance']);

    $balance += floatval($total);
    $msg = 'Bill';

    $query = 'INSERT INTO `transactions` (`credit`, `balance`, `details`) VALUES (?, ?, ?)';
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("sss", $total, $balance, $msg);
    if(!$stmt->execute()) return false;

    $treatmentState = $this->conn->query('UPDATE `admission-history` SET `status` = "Cured" WHERE `patient-id` = ' . $id . ' AND `status` = "Under Treatment"');
    if(!$treatmentState) return false;

    return true;
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

  public function payVisitFees($slot, $id, $fees) {
    $query = 'UPDATE `doctor-schedule` SET `status` = "free" WHERE `datetime` = "' . $slot . '" AND `id` = ' . $id;
    $state = $this->conn->query($query);
    if($state == false) return false;

    $balance = 'SELECT `balance` FROM `transactions` ORDER BY `datetime` DESC LIMIT 1';
    $balance = $this->conn->query($balance);
    $balance = $balance->fetch_assoc();
    $balance = floatval($balance['balance']);

    $balance += floatval($fees);
    $msg = 'Bill';

    $query = 'INSERT INTO `transactions` (`credit`, `balance`, `details`) VALUES (?, ?, ?)';
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("sss", $fees, $balance, $msg);
    if(!$stmt->execute()) return false;

    return true;
  }
}
