<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$db = new Database();
$link = $db->connect();
$err=0;
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$aid = mysqli_real_escape_string($link, $_REQUEST['ntype']);
if($aid==0)
{
	echo '<script language="javascript">';
	echo 'alert("Select a nurse to Allocate!")';
	echo '</script>';
}
else
{

$cid = mysqli_real_escape_string($link, $_REQUEST['nbed']);
if($cid==0)
{
	echo '<script language="javascript">';
	echo 'alert("Select a bed to Allocate!")';
	echo '</script>';
}
else
{
  $res = mysqli_query($link, "SELECT `room-id` FROM `admission-history` WHERE `patient-id`='$cid'");
  $row = mysqli_fetch_array($res);
  $did=$row[0];
		$sql2 = "UPDATE `nurse-duty` SET `room-id`='$did' where `nurse-id`='$aid'";
		if(mysqli_query($link, $sql2)){
		   	echo "The Nurse has been allocated";
		} else{
		    echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);$err=1;
		}
	}
}

// close connection
mysqli_close($link);
?>
