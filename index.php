<?php
include_once './layout/header.php';
addStyleSheet("index.css");
?>

<div class="landing-page">
  <div class="container">
    <div class="login-register">

      <div class="hero-section">
        <p class="lead">S<sup>3</sup>N hospital management system</p>
        <div class="logo"><img src="./assets/img/logo.png" alt="Logo"></div>
      </div>

      <ul class="nav nav-tabs"role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true">Login</a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
          <?php include_once('./components/login.php'); ?>
        </div>
      </div>

    </div>
  </div>
</div>

<?php include_once './layout/footer.php';?>
