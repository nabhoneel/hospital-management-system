<?php

include_once('../config/Database.php');
include_once('../models/Doctors.php');

$db = new Database();
$doctors = new Doctors($db->connect());

//Get raw posted JSON data:
$data = json_decode(file_get_contents("php://input"));

$available_doctors = $doctors->get_available_doctors(
  $data->name,
  $data->department,
  $data->date,
  $data->time
);

if(mysqli_num_rows($available_doctors) == 0) {
  echo 'No such doctors are currently available';
  return;
}

?>
<table class="table table-hover table-borderless">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Specialization</th>
      <th scope="col">Slot</th>
      <th scope="col">Fees</th>
      <th scope="col">Book</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($available_doctors as $key => $item) { ?>
      <tr>
        <td><?php echo $item['name']; ?></td>
        <td><?php echo $data->department_name; ?></td>
        <td><?php echo $item['date']; ?> at <?php echo $item['time']; ?></td>
        <td><?php echo $item['visit-fees']; ?></td>
        <td>
          <button class="btn btn-outline-primary btn-sm" onclick="choosePatient('<?php echo $item['id']; ?>', '<?php echo $item['name']; ?>', '<?php echo $item['datetime']; ?>')" id="<?php echo $item['id']; ?>">
            Book
          </button>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
