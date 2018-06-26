<?php

//check if session is valid, include the appropriate user file, example: receptionist.php, doctor.php, etc

if(!is_valid_user()) {
  setcookie("from", "dashboard", 0, '/');
  redirect('/');
} else {
  include_once(get_role() . '.php'); // appropriate profile page is opened
}

?>
