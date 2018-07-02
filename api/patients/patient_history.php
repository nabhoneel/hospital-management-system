<?php

include_once('../config/Database.php');
include_once('../models/Patients.php');

$db = new Database();
$patients = new Patients($db->connect());

//Get raw posted JSON data:
$data = json_decode(file_get_contents("php://input"));

$bill = $patients->get_summary($data->id);

if($bill != false) {

  echo '<table class="table">';
  ?>
  <table class="table">
    <thead>
      <td>Date/Time</td>
      <td>Item</td>
      <td>Price</td>
      <td>Quantity</td>
      <td>Total</td>
    </thead>
    <?php
    $totalAmount = 0;
    foreach ($bill as $key => $x) {
      ?>
      <tr>
        <td><?php echo $x['datetime']; ?></td>
        <td><?php echo $x['item-name']; ?></td>
        <td>&#x20B9;<?php echo $x['price']; ?></td>
        <td><?php echo $x['quantity']; ?></td>
        <td>&#x20B9;<?php echo (floatval($x['price']) * floatval($x['quantity'])); ?></td>
      </tr>
      <?php
      $totalAmount += (floatval($x['price']) * floatval($x['quantity']));
    }
    ?>
    <tr>
      <td colspan="5" style="text-align: right;">Total amount: &#x20B9;<?php echo $totalAmount; ?></td>
    </tr>
  </table>
  <button class="btn btn-info" onclick="discharge('<?php echo $data->id; ?>', '<?php echo $totalAmount; ?>')">Discharge</button>
  <?php

}

$history = $patients->get_history($data->id);
?>
