function makePayment() {
  var id = document.querySelector('#paymentID').value;
  var status = document.querySelector('#payment-status');
  if(id == '') {
    status.innerHTML = "Please enter the staff id for confirmation";
    status.style.display = 'block';
    return;
  }

  jQuery(function($) {
    $.ajax({
      url: '/hospital-system/api/transactions/pay_salary.php',
      method: 'post',
      data: JSON.stringify({id: id}),
      success: function(response) {
        status.style.display = 'block';
        status.innerHTML = response;
      },
      error: function(response) {
        console.log(response);
      }
    });
  });
}
