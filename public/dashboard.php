<?php

//check if session is valid, include the appropriate user file, example: receptionist.php, doctor.php, etc

if(!isValidUser()) {
  setcookie("from", "dashboard", 0, '/' . $site_name);
  redirect('/');
} else {
  include_once(getRole() . '.php'); // appropriate profile page is opened
}

?>
