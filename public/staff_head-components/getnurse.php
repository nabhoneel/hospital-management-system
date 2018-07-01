<title>Nurse Details</title>
<body>

  <?php
  $doc = intval($_GET['q']);
  $tot=0;$count=0;
  $link = mysqli_connect("localhost","root","","hospital-system");
  if (!$link) {
    die('Could not connect: ' . mysqli_error($link));
  }

  $sql1="SELECT * from `staff-details` WHERE id ='$doc'" ;
  $res1 = mysqli_query($link,$sql1);
  $row1=mysqli_fetch_array($res1);
  echo "<h2>Nurse Name: ".$row1["name"]."</h2>";
  echo "<h3>Personal Details</h3><p>Gender: ".$row1["sex"]."<br>";
  echo "Date of Birth: ".$row1["date-of-birth"]."<br>";
  echo "Address: ".$row1["address"]."<br>";
  echo "Phone: ".$row1["contact"]."</p>";
  echo "<h3>Professional Details</h3>";
  echo "Qualifications: ".$row1["degree"]."<br>";
  echo "Salary: ".$row1["salary"]."<br>";


  mysqli_close($link);
  ?>
</body>
</html>
