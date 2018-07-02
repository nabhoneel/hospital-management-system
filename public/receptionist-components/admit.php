<?php add_authorization(); ?>

<div class="admit">
  <div class="row">
    <div class="available-doctors col-3">Admit patient</div>
    <div class="form-group col-6">
      <label for="patient-search">Search patients</label>
      <input type="text" name="patient-search" class="form-control" id="patient-search" placeholder="Search patient names, email ids">
      <div class="admit-patient-search-results"></div>
    </div>
    <div class="form-group col-3">
      <button class="btn btn-primary" data-toggle="modal" data-target="#newPatientModal">
        Add new patient
      </button>
    </div>
    <div class="col-12 admit-patient-result">
      <div class="row">
        <div class="form-group col-6">
          Room: <select class="custom-select admit-patient-room-type">
            <?php
            $db = new Database();
            $conn = $db->connect();
            $result = $conn->query("SELECT `item-name` FROM `price-chart` WHERE `type` = 'Room' AND `item-name` IN (SELECT DISTINCT `room-type` FROM `rooms` WHERE `status` = 'Free')");

            while($row = $result->fetch_assoc()) {
              $x = $row['item-name'];
              ?>
              <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
              <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group col-6">
          Admit doctor: <select class="custom-select admit-patient-doctor">
            <?php
            $result = $conn->query("SELECT `id`, `name` FROM `staff-details` WHERE `role` = 'doctor'");

            while($row = $result->fetch_assoc()) {
              ?>
              <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
              <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group col-6">
          Name: <span class="admit-patient-name"></span>
        </div>
        <div class="form-group col-3">
          Sex: <span class="admit-patient-sex"></span>
        </div>
        <div class="form-group col-3">
          Date of birth: <span class="admit-patient-dob"></span>
        </div>
        <div class="form-group col-12">
          Address: <span class="admit-patient-address"></span>
        </div>
        <div class="form-group col-6">
          Email: <span class="admit-patient-email"></span>
        </div>
        <div class="form-group col-3">
          Contact number: <span class="admit-patient-contact"></span>
        </div>
        <div class="form-group col-3">
          <button class="btn btn-primary complete-admit">Admit</button>
        </div>
        <div class="form-group col-12">
          <span class="admit-status"></span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="newPatientModal" tabindex="-1" role="dialog" aria-labelledby="newPatientModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Patient</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="admit-new-patient-form">
          <div class="row">
            <input type="text" class="form-control name col-10" placeholder="full name" onkeyup="resetColor(this)">
            <select class="custom-select form-control col-2">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Others">Others</option>
            </select>
          </div>
          <input type="number" class="form-control contact" placeholder="contact number" onkeyup="resetColor(this)">
          <input type="email" class="form-control email-id" placeholder="you@example.com" onkeyup="resetColor(this)">
          <textarea class="form-control address" rows="4" cols="80" placeholder="residential address" onkeyup="resetColor(this)"></textarea>
          <input type="date" class="form-control dob" onchange="resetColor(this)">
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveNewPatient('admit-new-patient-form')">Save changes</button>
      </div>
    </div>
  </div>
</div>
