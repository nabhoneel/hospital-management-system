<?php

/*

ENTRY POINT FILE:
All URLs under this project will be forced to go through this file first

*/

/*
Helper functions are included below:
*/
include_once('./lib/functions.php');

// echo get_url() . '<br>';
// echo get_requested_url();

if(get_url() == get_homeurl() . '/') {
  include_once('public/login.php');
} else {
  include 'public/' . get_requested_url() . '.php';
}

?>
