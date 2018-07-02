<style>
body .modal-ku {
width: 750px;
}
</style>

<div class="allot">
  <div class="row">
    <div class="form-group col-4"><b><font size="+3">Details of Nurse</font></b></div>
    <div class="form-group col-4"></div>
    <div class="form-group col-4">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#morning">Morning</button>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#afternoon">Afternoon</button>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#night">Night</button>
    </div>

    </div>
    </div>


<body>

	<?php

	$conn = new mysqli("localhost", "root", "","hospital-system");

	if ($conn->connect_error)
	{
		echo '<font size="4">Connection failed: ' . $conn->connect_error .'</font>';
	}
	else
	{
		$run = $conn->query("SELECT `staff-details`.id, `staff-details`.name, `nurse-duty`.`shift`, `staff-details`.`degree`, `nurse-duty`.`holiday`, `staff-details`.`contact`, `staff-details`.`salary`, `staff-details`.id FROM `staff-details` JOIN `nurse-duty` on `staff-details`.id=`nurse-duty`.`nurse-id` order by `name`");

		if($run->num_rows > 0)
		{
			?>

			<table class='w3-table-all w3-card-4'>
				<tr class='w3-blue'>
					<th><font size=4> NURSE-ID </th>
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
									$id = $row[0];
									$name = $row[1];
									$shift = $row[2];
									$qual = $row[3];
									$holiday = $row[4];
									$phone = $row[5];
									$salary = $row[6];

									echo	"<tr>
									<td><font size=4>$id</td>
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

						}
						?>


					</table>
					<div class="modal" id="morning" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">NURSES IN MORNING SHIFT</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="table table-striped">
										<table class="table">
										<thead>
											<tr bgcolor="#948B8A">
												<th><font size=4> ID </th>
														<th><font size=4> NAME </th>
															<th><font size=4> HOLIDAY </th>
																<th><font size=4> PHONE </th></font>

																<br><br>
															</tr>
										</thead>
										<tbody>
																<?php
																$run = $conn->query("SELECT `staff-details`.id, `staff-details`.name, `nurse-duty`.`shift`, `staff-details`.`degree`, `nurse-duty`.`holiday`, `staff-details`.`contact`, `staff-details`.`salary`, `staff-details`.id FROM `staff-details` JOIN `nurse-duty` on `staff-details`.id=`nurse-duty`.`nurse-id` order by `name`");

																if($run->num_rows > 0)
																{
																while($row = $run->fetch_array())
																{
																	$id =$row[0];
																	$name = $row[1];
																	$shift = $row[2];

																	$holiday = $row[4];
																	$phone = $row[5];

																	if($shift == 'Morning') {
																	echo	"<tr>
																	<td><font size=4>$id</td>
																	<td><font size=4>$name</td>

																	<td><font size=4>$holiday</td>
																	<td><font size=4>$phone</td>

																	</tr>";}
																}
															}
															else
															{
																echo '<font size="4">No Rows To Display</font>';
															}
									 ?>
											</tbody>
										</table>
										</div>
								</div>  </div>  </div>  </div>

								<div class="modal" id="afternoon" tabindex="-1" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">NURSES IN AFTERNOON SHIFT</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div class="table table-striped">
													<table class="table">
													<thead>
														<tr bgcolor="#948B8A">

															<th> ID </th>
																	<th> NAME </th>
																		<th>HOLIDAY </th>
																			<th> PHONE </th>


																			<br><br>
																		</tr>
													</thead>
													<tbody>
																			<?php
																			$run = $conn->query("SELECT `staff-details`.id, `staff-details`.name, `nurse-duty`.`shift`, `staff-details`.`degree`, `nurse-duty`.`holiday`, `staff-details`.`contact`, `staff-details`.`salary` FROM `staff-details` JOIN `nurse-duty` on `staff-details`.id=`nurse-duty`.`nurse-id` order by `name`");

																			if($run->num_rows > 0)
																			{
																			while($row = $run->fetch_array())
																			{
																				$id =$row[0];
																				$name = $row[1];
																				$shift = $row[2];
																				$salary = $row[6];
																				$holiday = $row[4];
																				$phone = $row[5];

																				if($shift == 'Afternoon') {
																				echo	"<tr>
																				<td>$id</td>
																				<td>$name</a></td>

																				<td>$holiday</td>
																				<td>$phone</td>

																				</tr>";}
																			}
																		}
																		else
																		{
																			echo '<font size="4">No Rows To Display</font>';
																		}
												 ?>
														</tbody>
													</table>
													</div>
											</div>  </div>  </div>  </div>

											<div class="modal" id="night" tabindex="-1" role="dialog">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title">NURSES IN NIGHT SHIFT</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<div class="table table-striped">
																<table class="table">
																<thead>
																	<tr bgcolor="#948B8A">
																		<th>ID </th>
																				<th> NAME </th>
																					<th> HOLIDAY </th>
																						<th> PHONE </th>

																						<br><br>
																					</tr>
																</thead>
																<tbody>
																						<?php
																						$run = $conn->query("SELECT `staff-details`.id, `staff-details`.name, `nurse-duty`.`shift`, `staff-details`.`degree`, `nurse-duty`.`holiday`, `staff-details`.`contact`, `staff-details`.`salary`, `staff-details`.id FROM `staff-details` JOIN `nurse-duty` on `staff-details`.id=`nurse-duty`.`nurse-id` order by `name`");

																						if($run->num_rows > 0)
																						{
																						while($row = $run->fetch_array())
																						{
																							$id =$row[0];
																							$name = $row[1];
																							$shift = $row[2];

																							$holiday = $row[4];
																							$phone = $row[5];

																							if($shift == 'Night') {
																							echo	"<tr>
																							<td><font size=4>$id</td>
																							<td><font size=4>$name</td>

																							<td><font size=4>$holiday</td>
																							<td><font size=4>$phone</td>

																							</tr>";}
																						}
																					}
																					else
																					{
																						echo '<font size="4">No Rows To Display</font>';
																					}
															 ?>
																	</tbody>
																</table>
																</div>
														</div>  </div>  </div>  </div>

				</body>
				</html>
