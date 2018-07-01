var doctorName = '',
specialization = document.querySelector('#specialization').value,
date = '',
time = '',
department_name = document.querySelector('#specialization').options[document.querySelector('#specialization').selectedIndex].text;

var patientFormStatus = false;

window.onload = function() {
  setList();

  document.querySelector('#doctor-name').addEventListener('keyup', function() {
    doctorName = this.value;
    setList();
  });

  document.querySelector('#specialization').addEventListener('change', function() {
    specialization = this.value;
    department_name = this.options[this.selectedIndex].text;
    setList();
  });

  document.querySelector('#date').addEventListener('change', function() {
    date = this.value;
    setList();
  });

  document.querySelector('#time').addEventListener('change', function() {
    time = this.value;
    setList();
  });
};

setList = function() {
  var data = {
    name: doctorName,
    department: specialization,
    department_name: department_name,
    date: date,
    time: time
  };

  jQuery(function($) {
    $.ajax({
      url: "/hospital-system/api/doctors/available_doctors.php",
      type: 'post',
      data: JSON.stringify(data),
      success: function(response) {
        document.querySelector('.allot-results').innerHTML = response;
      },
      error: function(err) {
        console.log(err);
      }
    });
  });
};

choosePatient = function(id, name, datetime) {
  jQuery(function($) {
    var date = new Date(datetime);

    document.querySelector('.doctor-name').innerHTML = name;
    document.querySelector('.slot-chosen').innerHTML = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear() + ' at ' + date.getHours() + ':' + date.getMinutes();
    $('#patient-details-modal').modal('show');

    document.querySelector('#patient-name-search').addEventListener('keyup', function() {
      if(this.value == '') document.querySelector('.search-results').style.display = 'none';
      else document.querySelector('.search-results').style.display = 'block';
      $.ajax({
        url: "/hospital-system/api/patients/patient_search.php",
        type: 'post',
        data: JSON.stringify({text: document.querySelector('#patient-name-search').value}),
        success: function(response) {
          document.querySelector('.search-results').innerHTML = response;
        },
        error: function(response) {
          console.log(response);
        }
      });
    });

    document.querySelector('.book-doctor').addEventListener('click', function() {
      if(document.querySelector('#patient-id-field').value == '') return;
      data = {
        patientID: document.querySelector('#patient-id-field').value,
        doctorID: id,
        slot: datetime
      };

      $.ajax({
        url: "/hospital-system/api/doctors/book_doctor.php",
        type: 'post',
        data: JSON.stringify(data),
        success: function(response) {
          console.log(response);
          document.querySelector('.booking-status').innerHTML = response;
          setList();
          setTimeout(function() {
            $('#patient-details-modal').modal('hide');
            document.querySelector('.booking-status').innerHTML = '';
            selectPatient('', '', '', '', '');
          }, 4000);
        },
        error: function(err) {
          console.log(err);
        }
      });
    });
  });
};

selectPatient = function(id, name, sex, contact, dob) {
  document.querySelector('.search-results').style.display = 'none';
  document.querySelector('#patient-id-field').value = id;
  document.querySelector('.patient-details .name').innerHTML = name;
  document.querySelector('.patient-details .sex').innerHTML = sex;
  document.querySelector('.patient-details .dob').innerHTML = dob;
  document.querySelector('.patient-details .contact-number').innerHTML = contact;
};

togglePatientForm = function() {
  if(!patientFormStatus) {
    document.querySelector('.old-patient-search').style.display = 'none';
    document.querySelector('.new-patient-form').style.display = 'block';
  } else {
    document.querySelector('.old-patient-search').style.display = 'block';
    document.querySelector('.new-patient-form').style.display = 'none';
  }
  patientFormStatus = !patientFormStatus;
};

saveNewPatient = function() {
  var patientFields = document.querySelectorAll('.new-patient-form .form-control');
  for (var i = 0; i < patientFields.length; i++) {
    if(patientFields[i].value == '') {
      patientFields[i].style.borderColor = 'red';
      return;
    } else {
      patientFields[i].style.borderColor = '#ced4da';
    }
  }

  var data = {
    name: patientFields[0].value,
    sex: patientFields[1].value,
    contact: patientFields[2].value,
    email: patientFields[3].value,
    address: patientFields[4].value,
    dob: patientFields[5].value
  };

  console.log(data);

  jQuery(function($) {
    $.ajax({
      url: "/hospital-system/api/patients/save_new_patient.php",
      method: 'post',
      data: JSON.stringify(data),
      success: function(response) {
        document.querySelector('.new-patient-form .alert').style.display = 'block';
        document.querySelector('.new-patient-form .alert').innerHTML = response;

        setTimeout(function() {
          $('.new-patient-form .alert').fadeOut('slow');
          for (var i = 0; i < patientFields.length; i++) {
            if(i != 1) {
              patientFields[i].value = '';
            }
          }
          togglePatientForm();
        }, 3000);

        document.querySelector('.patient-details .name').innerHTML = data.name;
        document.querySelector('.patient-details .sex').innerHTML = data.sex;
        document.querySelector('.patient-details .dob').innerHTML = data.dob;
        document.querySelector('.patient-details .contact-number').innerHTML = data.contact;
      },
      error: function(err) {
        console.log(err);
      }
    });
  });
};

resetColor = function(e) {
  e.style.borderColor = '#ced4da';
};
