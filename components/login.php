<form class="form-signin">
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="text" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  <br>
  <?php
  if(isset($_COOKIE['from'])) {
    ?>
    <div class="alert alert-danger" role="alert" id="warning">You need to sign in first</div>
    <?php
  } else {
    ?>
    <div class="alert alert-danger" role="alert" id="warning" style = "display: none;"></div>
    <?php
  }
  ?>
</form>

<script>

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

</script>
