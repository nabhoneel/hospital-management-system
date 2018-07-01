<body>

	<?php

	$conn = new mysqli("localhost", "root", "","hospital-system");

	if ($conn->connect_error)
	{
		echo '<font size="4">Connection failed: ' . $conn->connect_error .'</font>';
	}
	else
	{
		$run = $conn->query("SELECT `staff-details`.name, `nurse-duty`.`shift`, `staff-details`.`degree`, `nurse-duty`.`holiday`, `staff-details`.`contact`, `staff-details`.`salary`, `staff-details`.id FROM `staff-details` JOIN `nurse-duty` on `staff-details`.id=`nurse-duty`.`nurse-id` order by `name`");

		if($run->num_rows > 0)
		{
			?>
			<h2>Details of Nurses</h2>
			<table class='w3-table-all w3-card-4'>
				<tr class='w3-blue'>
					<th><font size=4> NAME </th>
						<th><font size=4> SHIFT</th>
							<th><font size=4> QUALIFICATION </th>
								<th><font size=4> HOLIDAY </th>
									<th><font size=4> PHONE </th></font>
									<th><font size=4> SALARY </th></font>
									<br><br>
								</tr>


								<?php
								while($row = $run->fetch_array())
								{
									$name = $row[0];
									$shift = $row[1];
									$qual = $row[2];
									$holiday = $row[3];
									$phone = $row[4];
									$salary = $row[5];

									echo	"<tr>
									<td><font size=4><a href='" . get_homeurl() . "/public/staff_head-components/getnurse.php?q=" . $row['id'] . "'>$name</a></td>
									<td><font size=4>$shift</td>
									<td><font size=4>$qual</td>
									<td><font size=4>$holiday</td>
									<td><font size=4>$phone</td>
									<td><font size=4>$salary</td>
									</tr>";
								}
							}
							else
							{
								echo '<font size="4">No Rows To Display</font>';
							}

							$conn->close();
						}
						?>


					</table>



				</body>
				</html>
