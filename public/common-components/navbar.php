<?php set_stylesheet('navbar.css'); ?>

<nav class="navbar sticky-top navbar-light" style="background-color: #fff;">
  <a href="<?php echo get_homeurl(); ?>/dashboard" class="navbar-brand">
    <img src="<?php echo get_assets(); ?>/img/logo.png" alt="Logo">
    S<sup>3</sup>N Hospital Management System
  </a>
  <a class="btn btn-danger btn-lg" href="<?php echo get_homeurl(); ?>/public/common-components/logout.php"><i class="fas fa-sign-out-alt"></i></a>
</nav>
