<?php

$site_name = "hospital-system";

function addStyleSheet($stylesheet) {
  global $site_name;
  ?>

  <head>
    <link rel="stylesheet" href="/<?php echo $site_name; ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/<?php echo $site_name; ?>/assets/css/master.css">
    <link rel="stylesheet" href="/<?php echo $site_name; ?>/<?php echo $stylesheet; ?>">
    <title>S3N Hospital Management System</title>
  </head>

  <?php
}
?>
