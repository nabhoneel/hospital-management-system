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

  <div class="booking-status"></div>
  <div class="allot-results"></div>

  <div class="patient-details">
    <div class="modal fade" id="patient-details-modal" tabindex="-1" role="dialog" aria-labelledby="patient-details-modal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="patient-details-modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="patient-details-modal-body">
            <div class="row">
              <div class="col-4">
                <div class="doctor-name"></div>
              </div>
              <div class="col-4">
                <div class="slot-chosen"></div>
              </div>
              <div class="col-4">
                <input type="text" name="patient-name-search" id="patient-name-search" class="form-control" placeholder="Patient's name">
                <div class="search-results"></div>
              </div>
            </div>
            <div class="row">
              <!--Patient details-->
              <div class="col-4 patient-name"></div>
              <div class="col-4 sex"></div>
              <div class="col-4 email-id"></div>
              <div class="col-4 contact-number"></div>
              <!--Last treated by this hospital on-->
              <div class="col-4 last-date"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Book doctor</button>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
