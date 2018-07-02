<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "","hospital-system");
$err=0;
// Check connection
if($link === false){
  die("ERROR: Could not connect. " . mysqli_connect_error());
}

$aid = mysqli_real_escape_string($link, $_REQUEST['ntype']);
if($aid==0)
{
  echo '<script language="javascript">';
  echo 'alert("Select a nurse to be freed!")';
  echo '</script>';
}
else
{
  $sql2 = "UPDATE `nurse-duty` SET `room-id`='0' where `nurse-id`='$aid'";
  if(mysqli_query($link, $sql2)){
    echo "The Nurse has been freed";
    setcookie('nurse-freed-status', 'true', time() + (5), "/");
    ?>
    <script>window.location.reload(history.back());</script>
    <?php
  } else{
    echo "ERROR: Could not to execute $sql2. " . mysqli_error($link);$err=1;
  }
}

// close connection
mysqli_close($link);
?>
