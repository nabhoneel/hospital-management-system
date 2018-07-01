<?php

/*

This file contains helper functions for the entire project

*/

function get_homeurl() {
  return '/hospital-system';
}

function get_url() {
  return $_SERVER['REQUEST_URI'];
}

function get_requested_url() {

  /*
  Only the requested path is returned
  Example: localhost/hospital-system/receptionist.php is returned as 'receptionist'
  Example: localhost/hospital-system/dashboard is returned as 'dashboard'
  */

  $requested_url = $_SERVER['REQUEST_URI'];
  $requested_url = str_replace(get_homeurl(), '', $requested_url);
  //$requested_url = ltrim($requested_url, get_homeurl());
  $requested_url = ltrim($requested_url, '/');
  $requested_url = rtrim($requested_url, '.php');
  $requested_url = rtrim($requested_url, '/');

  return $requested_url;
}

function set_title($title) {
  echo '<title>' . $title . '</title>';
}

function get_assets() {
  return get_homeurl() . '/assets';
}

function load_default_stylesheets() {
  ?>
  <link rel="stylesheet" href="<?php echo get_assets(); ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo get_assets(); ?>/css/fontawesome.css">
  <link rel="stylesheet" href="<?php echo get_assets(); ?>/css/master.css">
  <?php
}

function set_stylesheet($stylesheet) {
  ?>
  <link rel="stylesheet" href="<?php echo get_assets(); ?>/css/<?php echo $stylesheet; ?>">
  <?php
}

function load_default_scripts() {
  ?>
  <script src="<?php echo get_assets(); ?>/js/jquery-3.3.1.min.js"></script>
  <script src="<?php echo get_assets(); ?>/js/popper.min.js"></script>
  <script src="<?php echo get_assets(); ?>/js/bootstrap.min.js"></script>
  <script src="<?php echo get_assets(); ?>/js/fontawesome.js"></script>
  <?php
}

function set_script($script) {
  ?>
  <script src="<?php echo get_assets(); ?>/js/<?php echo $script; ?>"></script>
  <?php
}

/*

Get user details:

*/

session_start();

function is_valid_user() {
  return isset($_SESSION['username']) && isset($_SESSION['role']);
}

function add_authorization() {
  if(!is_valid_user()) {
    setcookie("from", "dashboard", 0, '/' . $site_name);
    redirect('/');
  }
}

//Get name of signed in user:
function get_name() {
  if(is_valid_user()) {
    return $_SESSION['username'];
  } else {
    return null;
  }
}

//Get role of signed in user:
function get_role() {
  if(is_valid_user()) {
    return $_SESSION['role'];
  } else {
    return null;
  }
}

function get_all_roles() {
  $db = new Database();
  $staff_details = new StaffDetails($db->connect());

  return $staff_details->get_roles();
}

function get_departments() {
  $db = new Database();
  $doctors = new Doctors($db->connect());

  return $doctors->get_specializations();
}

function redirect($url, $statusCode = 303)
{
  header('Location: ' . get_homeurl() . $url, true, $statusCode);
  die();
}

/*

Get database connection variable:

*/

function get_database() {
  $db = new Database();
  return ($db->connect());
}

/*

UI elements:

*/

/*

Doctor details:

*/

function get_specializations() {
  $db = new Database();
  $doctors = new Doctors($db->connect());

  $specializations = $doctors->get_specializations();

  return $specializations;
}
