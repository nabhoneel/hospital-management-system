<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "","hospital-system");
$err=0;
// Check connection
if($link === false){
  die("ERROR: Could not connect. " . mysqli_connect_error());
}

$aid = mysqli_real_escape_string($link, $_REQUEST['arec']);
if($aid==0)
{
  echo '<script language="javascript">';
  echo 'alert("Select a Patient to Discharge!")';
  echo '</script>';
}
else
{
  $res = mysqli_query($link, "SELECT `admission-date`, `patient-id`, `room-id` FROM `admission-history` WHERE `patient-id`='$aid'");
  $row = mysqli_fetch_array($res);
  $adate=$row[0];
  $pid=$row[1];
  $bid=$row[2];
  $sql2 = "UPDATE `rooms` SET `status`='Free' where `room-id`='$bid'";
  if(mysqli_query($link, $sql2)){
    echo "The Room has been freed";
  } else{
    echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);$err=1;
  }
}

// close connection
mysqli_close($link);
?>
