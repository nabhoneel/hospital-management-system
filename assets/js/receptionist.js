var doctorName = '',
    specialization = document.querySelector('#specialization').value,
    date = '',
    time = '';

window.onload = function() {
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
        console.log(response);
      },
      error: function(err) {
        console.log(err);
      }
    });
  });
};
