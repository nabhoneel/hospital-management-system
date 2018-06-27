var doctorName = '',
specialization = document.querySelector('#specialization').value,
date = '',
time = '';

window.onload = function() {
  setList();

  document.querySelector('#doctor-name').addEventListener('keyup', function() {
    doctorName = this.value;
    setList();
  });

  document.querySelector('#specialization').addEventListener('change', function() {
    specialization = this.value;
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
  document.querySelector('.allot-results').innerHTML = doctorName + specialization + date + time;
  console.log(doctorName + specialization + date + time);

  var data = {
    name: doctorName,
    specialization: specialization,
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

bookDoctor = function(id, name, datetime) {
  console.log(id);
  console.log(name);
  console.log(datetime);

  jQuery(function($) {
    var date = new Date(datetime);

    document.querySelector('.doctor-name').innerHTML = name;
    document.querySelector('.slot-chosen').innerHTML = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear() + ' at ' + date.getHours() + ':' + date.getMinutes();
    $('#patient-details-modal').modal('show');

    document.querySelector('#patient-name-search').addEventListener('keyup', $.ajax({
      url: "/hospital-system/api/patients/patient_search.php",
      type: 'post',
      data: JSON.stringify({text: document.querySelector('#patient-name-search').value}),
      success: function(response) {
        document.querySelector('.search-results').innerHTML = response;
      },
      error: function(response) {
        console.log(response);
      }
    }));
  });

  // jQuery(function($) {
  //
  //
  //   $.ajax({
  //     url: "/hospital-system/api/doctors/book_doctor.php",
  //     type: 'post',
  //     data: JSON.stringify({id: id, slot: datetime}),
  //     success: function(response) {
  //       document.querySelector('.booking-status').innerHTML = response;
  //       setList();
  //     },
  //     error: function(err) {
  //       console.log(err);
  //     }
  //   });
  // });
};
