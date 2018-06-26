<?php

// User authorization (whether he/she is signed in):
if(!function_exists('is_valid_user') || !is_valid_user()) {
  echo "ERROR: Unauthorized access";
  return;
}

?>
