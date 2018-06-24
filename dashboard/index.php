<?php

include_once('../layout/header.php');

//check if session is valid, include the appropriate user file, example: receptionist.php, doctor.php, etc
include_once('../util/user.php');
if(!isValidUser()) {
  global $site_name;
  setcookie("from", "dashboard", 0, '/' . $site_name);
  redirect('/');
} else {
  include_once(getRole() . '.php'); // appropriate profile page is opened
}

include_once('../layout/footer.php');

?>
