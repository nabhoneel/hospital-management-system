<?php

// User authorization (whether he/she is signed in):
if(!function_exists('isValidUser') || !isValidUser()) {
  echo "ERROR: Unauthorized access";
  return;
}

?>
