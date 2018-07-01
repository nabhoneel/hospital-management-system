<body>

	<?php

	$conn = new mysqli("localhost", "root", "","hospital-system");

	if ($conn->connect_error)
	{
		echo '<font size="4">Connection failed: ' . $conn->connect_error .'</font>';
	}
	else
	{
		$run = $conn->query("SELECT `department`.description, `rooms`.`room-id`, `rooms`.`room-type`, `price-chart`.`price`, `admission-history`.`admission-date`, `department`.`department-id`  FROM `rooms` LEFT JOIN `department` ON `rooms`.`department-id` = `department`.`department-id` JOIN `price-chart` ON `rooms`.`room-type`=`price-chart`.`item-name` JOIN `admission-history` ON `rooms`.`room-id`=`admission-history`.`room-id` WHERE `rooms`.`status`='booked' order by `description`");

		if($run->num_rows > 0)
		{
			?>
			<h2>Details of Booked Rooms</h2>
			<table class='w3-table-all w3-card-4'>
				<tr class='w3-green'>
					<th><font size=4> DEPARTMENT </th>
						<th><font size=4> ROOM NO.</th>
							<th><font size=4> ROOM TYPE</th>
								<th><font size=4> CHARGE </th>
									<th><font size=4> DATE OF BOOKING </th>
										<br><br>
									</tr>


									<?php
									while($row = $run->fetch_array())
									{
										$department = $row[0];
										$roomno = $row[1];
										$room = $row[2];
										$status = $row[3];
										$date= $row[4];

										echo	"<tr>
										<td><font size=4>$department</td>
										<td><font size=4>$roomno</td>
										<td><font size=4>$room</td>
										<td><font size=4>$status</td>
										<td><font size=4>$date</td>
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
