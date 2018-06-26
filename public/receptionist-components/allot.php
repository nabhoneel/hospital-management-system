<?php add_authorization(); ?>

<style>

.available-doctors {
  color: darkgray;
  font-size: 2em;
}

.row {
  text-align: center;
  margin: 0;
  align-items: center;
}

.allot {
  padding: 1em;
}

.table {
  background-color: #f8f9fa;
  border-radius: 5px;
  text-align: center;
}

</style>

<div class="allot">
  <div class="row">
    <div class="available-doctors col-3">Available doctors</div>
    <div class="form-group col-2">
      <label for="doctor-name">Doctor preference</label>
      <input type="text" name="doctor-name" class="form-control" id="doctor-name" placeholder="Doctor's name">
    </div>
    <div class="form-group col-2">
      <label for="specialization">Specialization</label>
      <select name="specialization" id="specialization" class="custom-select">
        <option value="" selected></option>
        <?php
        foreach(get_specializations() as $key => $specialization) {
          echo '<option value="' . $specialization . '">' . $specialization . '</option>';
        }
        ?>
      </select>
    </div>
    <div class="form-group col-2">
      <label for="date">Date</label>
      <input type="date" name="date" class="form-control" id="date">
    </div>
    <div class="form-group col-2">
      <label for="time">Time</label>
      <input type="time" name="time" class="form-control" id="time">
    </div>
  </div>

  <div class="allot-results"></div>
</div>
