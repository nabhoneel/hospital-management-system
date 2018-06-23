<?php
function addStyleSheet($stylesheet) {
  $site_name = "hospital-system";
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
