<head>
  <?php set_title('S3N HMS'); ?>
  <?php load_default_stylesheets(); ?>
  <?php set_stylesheet('login.css'); ?>
</head>

<div class="landing-page">
  <div class="container">
    <div class="login-register">

      <div class="hero-section">
        <p class="lead">S<sup>3</sup>N hospital management system</p>
        <div class="logo"><img src="<?php echo get_assets(); ?>/img/logo.png" alt="Logo"></div>
      </div>

      <ul class="nav nav-tabs"role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true">Login</a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
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
        </div>
      </div>

    </div>
  </div>
</div>

<footer>
  <?php echo load_default_scripts(); ?>
  <?php echo set_script('login.js'); ?>
</footer>
