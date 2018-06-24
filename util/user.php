<?php

session_start();

function isValidUser() {
  return isset($_SESSION['username']) && isset($_SESSION['role']);
}

//Get name of signed in user:
function getName() {
  if(isValidUser()) {
    echo $accounts->username;
    return $_SESSION['username'];
  } else {
    return null;
  }
}

//Get role of signed in user:
function getRole() {
  if(isValidUser()) {
    echo $accounts->role;
    return $_SESSION['role'];
  } else {
    return null;
  }
}

function redirect($url, $statusCode = 303)
{
  global $site_name; // access site_name variable from header.php
  header('Location: /' . $site_name . $url, true, $statusCode);
  die();
}

?>
