<?php add_authorization(); ?>

<div class="attendance">
  <div class="row">
    <div class="available-doctors col-3">Staff Attendance</div>
    <div class="form-group col-3">
      <label for="staff-search">Search staff</label>
      <input type="text" name="staff-search" class="form-control" id="staff-search" placeholder="Search staff name, contact">
    </div>
    <div class="form-group col-3">
      <label for="staff-type">Staff Type</label>
      <select name="staff-type" id="staff-type" class="custom-select">
        <?php
        foreach(get_all_roles() as $key => $specialization) {
          echo '<option value="' . $specialization['role'] . '">' . $specialization['role'] . '</option>';
        }
        ?>
      </select>
    </div>
    <div class="form-group col-3">
      <label for="staff-department">Department (doctors only)</label>
      <select name="staff-department" id="staff-department" class="custom-select">
        <?php
        foreach(get_departments() as $key => $specialization) {
          echo '<option value="' . $specialization['department-id'] . '">' . $specialization['description'] . '</option>';
        }
        ?>
      </select>
    </div>
  </div>

  <div class="attendance-list"></div>
</div>
