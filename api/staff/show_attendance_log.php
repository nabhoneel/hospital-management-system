<?php

include_once('../config/Database.php');
include_once('../models/Staff_Details.php');

$db = new Database();
$staff = new StaffDetails($db->connect());

//Get raw posted JSON data:
$data = json_decode(file_get_contents("php://input"));

$details = $staff->get_all_details(
  $data->searchText,
  $data->department,
  $data->staffType
);

if(mysqli_num_rows($details) == 0) {
  echo 'No staff members with the given details exist';
  return;
}

?>
<table class="table table-hover table-borderless">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Role</th>
      <th scope="col">Contact</th>
      <th scope="col">Department</th>
      <th scope="col">Mark entry</th>
      <th scope="col">Mark exit</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($details as $key => $item) { ?>
      <tr>
        <td><?php echo $item['name']; ?></td>
        <td><?php echo $item['role']; ?></td>
        <td><?php echo $item['contact']; ?></td>
        <td><?php echo $item['description']; ?></td>
        <td>
          <?php if($staff->get_entry_time($item['id']) == false) : ?>
            <button class="btn btn-outline-primary btn-sm" onclick="setEntryTime(this, '<?php echo $item['id']; ?>')">
              Entry
            </button>
          <?php else :
            echo $staff->get_entry_time($item['id']); ?>
          <?php endif; ?>
        </td>
        <td>
          <?php if($staff->get_exit_time($item['id']) == false) : ?>
            <button <?php if($staff->get_entry_time($item['id']) == false) echo 'disabled'; ?> class="btn btn-outline-primary btn-sm" onclick="setExitTime(this, '<?php echo $item['id']; ?>')">
              Exit
            </button>
          <?php else :
            echo $staff->get_exit_time($item['id']); ?>
          <?php endif; ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
