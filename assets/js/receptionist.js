var doctorName = '',
specialization = document.querySelector('#specialization').value,
date = '',
time = '',
department_name = document.querySelector('#specialization').options[document.querySelector('#specialization').selectedIndex].text;

var patientFormStatus = false;

window.onload = function() {
  setList();
  setAttendanceList();

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

saveNewPatient = function(formName) {
  var patientFields = document.querySelectorAll('.' + formName + ' .form-control');
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
        document.querySelector('.' + formName + ' .alert').style.display = 'block';
        document.querySelector('.' + formName + ' .alert').innerHTML = response;

        setTimeout(function() {
          $('.' + formName + ' .alert').fadeOut('slow');
          for (var i = 0; i < patientFields.length; i++) {
            if(i != 1) {
              patientFields[i].value = '';
            }
          }
          if(formName == 'new-patient-form') togglePatientForm();
        }, 3000);

        if(formName == 'new-patient-form') {
          document.querySelector('.patient-details .name').innerHTML = data.name;
          document.querySelector('.patient-details .sex').innerHTML = data.sex;
          document.querySelector('.patient-details .dob').innerHTML = data.dob;
          document.querySelector('.patient-details .contact-number').innerHTML = data.contact;
        }

        if(formName == 'admit-new-patient-form') {
          setAdmitPatientDetails(
            '',
            data.name,
            data.sex,
            data.dob,
            data.address,
            data.email,
            data.contact
          );
        }
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

/*

Attendance functions:

*/

var staffSearch = '',
staffType = document.getElementById('staff-type').value,
departmentType = document.getElementById('staff-department').value;

setAttendanceList = function() {
  var data = {
    searchText: staffSearch,
    department: staffType == 'doctor' ? departmentType : 0,
    staffType: staffType
  };

  jQuery(function($) {
    $.ajax({
      url: "/hospital-system/api/staff/show_attendance_log.php",
      type: 'post',
      data: JSON.stringify(data),
      success: function(response) {
        document.querySelector('.attendance-list').innerHTML = response;
      },
      error: function(err) {
        console.log(err);
      }
    });
  });
};

setEntryTime = function(e, id) {
  jQuery(function($) {
    $.ajax({
      url: "/hospital-system/api/staff/set_entry_time.php",
      method: 'post',
      data: JSON.stringify({id: id}),
      success: function(response) {
        var x = e;
        x = x.parentElement.parentElement.childNodes;
        console.log(x);
        x[11].childNodes[1].removeAttribute('disabled');
        e.parentElement.innerHTML = response;
      },
      error: function(err) {
        console.log(err);
      }
    });
  });
};

setExitTime = function(e, id) {
  jQuery(function($) {
    $.ajax({
      url: "/hospital-system/api/staff/set_exit_time.php",
      method: 'post',
      data: JSON.stringify({id: id}),
      success: function(response) {
        e.parentElement.innerHTML = response;
      },
      error: function(err) {
        console.log(err);
      }
    });
  });
};

document.getElementById('staff-type').addEventListener('change', function() {
  staffType = this.value;
  if(this.value != 'doctor') {
    document.getElementById('staff-department').setAttribute('disabled', 'true');
  } else {
    document.getElementById('staff-department').removeAttribute('disabled');
  }
  setAttendanceList();
});

document.getElementById('staff-department').addEventListener('change', function() {
  departmentType = this.value;
  setAttendanceList();
});

document.getElementById('staff-search').addEventListener('keyup', function() {
  staffSearch = this.value;
  setAttendanceList();
});

/*

Patient admission

*/

setAdmitPatientDetails = function(id, name, sex, dob, address, email, contact) {
  document.querySelector('.admit-patient-search-results').style.display = 'none';

  document.querySelector('span.admit-patient-name').innerHTML = name;
  document.querySelector('span.admit-patient-sex').innerHTML = sex;
  document.querySelector('span.admit-patient-dob').innerHTML = dob;
  document.querySelector('span.admit-patient-address').innerHTML = address;
  document.querySelector('span.admit-patient-email').innerHTML = email;
  document.querySelector('span.admit-patient-contact').innerHTML = contact;

  if(id != '') {
    document.querySelector('.complete-admit').addEventListener('click', function() {
      data = {
        patientID: id,
        doctorID: document.querySelector('.admit-patient-doctor').value,
        roomType: document.querySelector('.admit-patient-room-type').value
      };
      $.ajax({
        url: "/hospital-system/api/patients/admit_patient.php",
        type: 'post',
        data: JSON.stringify(data),
        success: function(response) {
          document.querySelector('.admit-status').innerHTML = response;
          id = '';
        },
        error: function(err) {
          console.log(err);
        }
      });
    });
  } else {
    console.log('nope');
  }
};

document.getElementById('patient-search').addEventListener('keyup', function() {
  if(this.value == '') document.querySelector('.admit-patient-search-results').style.display = 'none';
  else document.querySelector('.admit-patient-search-results').style.display = 'block';
  $.ajax({
    url: "/hospital-system/api/patients/admit_patient_search.php",
    type: 'post',
    data: JSON.stringify({text: document.querySelector('#patient-search').value}),
    success: function(response) {
      document.querySelector('.admit-patient-search-results').innerHTML = response;
    },
    error: function(response) {
      console.log(response);
    }
  });
});

/*

Patients:

*/

reducePatientsList = function(e) {
  var patients = document.querySelectorAll('.patients-list-panel ul li');
  for(var i=0; i<patients.length; i++) {
    patients[i].style.display = 'block';
    if(patients[i].innerText.toLowerCase().indexOf(e.value.toLowerCase()) == -1) patients[i].style.display = 'none';
  }
};

showPatientHistory = function(id) {
  $.ajax({
    url: "/hospital-system/api/patients/patient_history.php",
    method: 'post',
    data: JSON.stringify({id: id}),
    success: function(response) {
      document.querySelector('.patients .patients-details').innerHTML = response;
    },
    error: function(err) {
      console.log(err);
    }
  });
};

discharge = function(id, total) {
  $.ajax({
    url: '/hospital-system/api/transactions/discharge.php',
    method: 'post',
    data: JSON.stringify({id: id, total: total}),
    success: function(response) {
      document.querySelector('.patients .alert-info').style.display = 'block';
      document.querySelector('.patients .alert-info').innerHTML = response;
    },
    error: function(response) {
      console.log(response);
    }
  });
};

payVisitFees = function(slot, doctorID, fees) {
  $.ajax({
    url: '/hospital-system/api/transactions/payVisitFees.php',
    method: 'post',
    data: JSON.stringify({slot: slot, id: doctorID, fees: fees}),
    success: function(response) {
      document.querySelector('.patients .alert-info').style.display = 'block';
      document.querySelector('.patients .alert-info').innerHTML = response;
    },
    error: function(err) {
      console.log(err);
    }
  })
}
