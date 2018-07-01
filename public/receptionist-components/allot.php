<?php add_authorization(); ?>

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
        <?php
        foreach(get_specializations() as $key => $specialization) {
          echo '<option value="' . $specialization['department-id'] . '">' . $specialization['description'] . '</option>';
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

  <div class="patient-details">
    <div class="modal fade" id="patient-details-modal" tabindex="-1" role="dialog" aria-labelledby="patient-details-modal" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="patient-details-modal-title">
              <div class="doctor-name"></div>
              <div class="slot-chosen"></div>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="patient-details-modal-body">
            <div class="old-patient-search">
              <div class="booking-status"></div>
              <div class="row patient-search-allot">
                <div class="col-12">
                  <input type="text" name="patient-name-search" id="patient-name-search" class="form-control" placeholder="Patient's name">
                  <div class="search-results"></div>
                </div>
              </div>
              <input type="hidden" id="patient-id-field">
              <div class="row patient-details">
                <!--Patient details-->
                <div class="col-4">
                  <div class="patient-detail">Name</div>
                </div>
                <div class="col-8">
                  <div class="name"></div>
                </div>
                <div class="col-4">
                  <div class="patient-detail">Sex</div>
                </div>
                <div class="col-8">
                  <div class="sex"></div>
                </div>
                <div class="col-4">
                  <div class="patient-detail">Contact number</div>
                </div>
                <div class="col-8">
                  <div class="contact-number"></div>
                </div>
                <div class="col-4">
                  <div class="patient-detail">Date of Birth</div>
                </div>
                <div class="col-8">
                  <div class="dob"></div>
                </div>
                <!--Last treated by this hospital on-->
                <!-- <div class="col-4 last-date"></div> -->
              </div>
            </div>
            <div class="new-patient-form">
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
              <div class="alert alert-success alert-dismissible fade show" role="alert"></div>
              <br>
              <button type="button" class="btn btn-success" onclick="saveNewPatient()">Save</button>
              <button type="button" class="btn btn-error" onclick="togglePatientForm()">Cancel</button>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="togglePatientForm()">New patient</button>
            <button type="button" class="btn btn-primary book-doctor">Book doctor</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
