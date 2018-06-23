<?php

include_once('./config/Database.php');
include_once('./models/Accounts.php');


$database = new Database();
$db = $database->connect();
$accounts = new Accounts($db);


//Handle the post request via the AJAX call:
if(!isset($_POST)) return;
$username = $_POST['username'];

if($accounts -> read_one_account($username)) {
  if(md5($_POST['password']) != $accounts -> password) {
    echo 'You have entered an incorrect password';
  } else {
    $_SESSION['username'] = $accounts -> username;
    $_SESSION['role'] = $accounts -> role;
    echo true;
  }
} else {
  echo 'No account under this username exists';
}

function isValidUser() {
  return isset($_SESSION) && $_SESSION['username'] && $_SESSION['role'];
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
