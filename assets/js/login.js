window.onload = function() {
  let signIn = document.querySelector('.btn');
  signIn.onclick = function(e) {
    e.preventDefault();
    let username = document.querySelector('#inputEmail').value;
    let password = document.querySelector('#inputPassword').value;
    
    jQuery(function($) {
      $.ajax({
        url: "./api/accounts.php",
        method: 'post',
        data: {
          username: username,
          password: password
        },
        success: function(response) {
          if(response == 1) window.location.replace('dashboard');
          else {
            document.querySelector('#warning').style.display = 'block';
            document.querySelector('#warning').innerHTML = response;
          }
        },
        error: function(err) {
          console.log(err);
        }
      });
    });
  }
}
