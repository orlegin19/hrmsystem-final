<?php
include 'conn.php';
include 'timezone.php';
	if(isset($_POST['employee'])){
		$output = array('error'=>false);

		$employee = $_POST['employee'];
		$status = $_POST['status'];

		$sql = "SELECT * FROM employee WHERE em_code = '$employee'";
		$query = $conn->query($sql);
		
		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			$empid = $row['em_code'];
			$id = $row['id'];
			$sched = $row['schedule_id'];
			$date_now = date('Y-m-d');

			if($status == 'in'){
				$sql = "SELECT * FROM attendance WHERE emp_id = '$empid' AND atten_date = '$date_now' AND signin_time IS NOT NULL";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
					//$output['error'] = true;
					//$output['message'] = 'You have timed in for today';
					$sql = "SELECT *, attendance.id AS uid FROM attendance LEFT JOIN employee ON employee.em_code=attendance.emp_id WHERE attendance.emp_id = '$empid' AND atten_date = '$date_now'";
					$query = $conn->query($sql);
					$row = $query->fetch_assoc();
					if($row['signout_time'] != '00:00:00'){
						$output['error'] = true;
						$output['message'] = 'You have timed out for today';
					} else {
						$sql = "UPDATE attendance SET signout_time = NOW() WHERE id = '".$row['uid']."'";
						if($conn->query($sql)){
							$output['message'] = 'Time out: '.$row['firstname'].' '.$row['lastname'];
							$sql = "SELECT * FROM attendance WHERE id = '".$row['uid']."'";
							$query = $conn->query($sql);
							$urow = $query->fetch_assoc();

							$time_in = $urow['signin_time'];
							$time_out = $urow['signout_time'];

							$sql = "SELECT * FROM employee LEFT JOIN attendance_schedules ON attendance_schedules.id = employee.schedule_id WHERE employee.id = '$id' ";
							$query = $conn->query($sql);
							$srow = $query->fetch_assoc();
							if($srow['time_in'] > $urow['signin_time']){
								$time_in = $srow['time_in'];
							}

							if($srow['time_out'] < $urow['signin_time']){
								$time_out = $srow['time_out'];
							}
							$sin  = new DateTime($time_in);
							$sout = new DateTime($time_out);
							$interval = $sin->diff($sout);
							$hours = $interval->format('%h');
							$mins = $interval->format('%i');
							$mins = $mins/60;
							
							$int = $hours + $mins;
							
							if($int > 12){
								$int = '12';
							} else{
								$int = $interval->format('%h')+ number_format($mins,1);								
							}	
							$sql = "UPDATE attendance SET working_hour = '$int' - TRUNCATE((ABS(( TIME_TO_SEC( TIMEDIFF('$time_in', '".$urow['signin_time']."' ) ) )))/3600, 1), schedtime = '$time_in', dlate = TRUNCATE((ABS(( TIME_TO_SEC( TIMEDIFF('$time_in', '".$urow['signin_time']."' ) ) )))/3600, 1) 
								WHERE id = '".$row['uid']."'";
							$conn->query($sql);


						}
						else{
							$output['error'] = true;
							$output['message'] = $conn->error;
						}	

					}

				}
				else{
					//updates
					//$sched = $row['schedule_id'];
					$lognow = date('H:i:s');
					$sql = "SELECT * FROM attendance_schedules WHERE id = '$sched'";
					$squery = $conn->query($sql);
					$srow = $squery->fetch_assoc();
					$logstatus = ($lognow > $srow['time_in']) ? 0 : 1;
					//
					$sql = "INSERT INTO attendance (emp_id, atten_date, signin_time, place, status, logstatus) VALUES ('$employee', '$date_now', NOW(), 'office','A', '$logstatus')";
					if($conn->query($sql)){
						$output['message'] = 'Time in: '.$row['first_name'].' '.$row['last_name'];
					}
					else{
						$output['error'] = true;
						$output['message'] = $conn->error;
					}
				}
			}
			else{
				$sql = "SELECT *, attendance.id AS uid FROM attendance LEFT JOIN employee ON employee.em_code=attendance.emp_id WHERE attendance.emp_id = '$empid' AND attendance.atten_date = '$date_now'";
				$query = $conn->query($sql);
				if($query->num_rows < 1){
					$output['error'] = true;
					$output['message'] = 'Cannot Timeout. No time in.';
				}
				else{
					$row = $query->fetch_assoc();
					if($row['signout_time'] != '00:00:00'){
						$output['error'] = true;
						$output['message'] = 'Time out: '.$row['first_name'].' '.$row['last_name'];
					}
					else{
						
						$sql = "UPDATE attendance SET signout_time = NOW() WHERE id = '".$row['uid']."'";
						if($conn->query($sql)){
							$output['message'] = 'Time out: '.$row['first_name'].' '.$row['last_name'];

							$sql = "SELECT * FROM attendance WHERE id = '".$row['uid']."'";
							$query = $conn->query($sql);
							$urow = $query->fetch_assoc();

							$time_in = $urow['signin_time'];
							$time_out = $urow['signout_time'];

							$sql = "SELECT * FROM employee LEFT JOIN attendance_schedules ON attendance_schedules.id=employee.schedule_id WHERE employee.em_code = '$empid'";
							$query = $conn->query($sql);
							$srow = $query->fetch_assoc();

							if($srow['time_in'] > $urow['time_in']){
								$time_in = $srow['time_in'];
							}

							if($srow['time_out'] < $urow['time_in']){
								$time_out = $srow['time_out'];
							}
							
							$sin  = new DateTime($time_in);
							$sout = new DateTime($time_out);
							$interval = $sin->diff($sout);
							$hours = $interval->format('%h');
							$mins = $interval->format('%i');
							$mins = $mins/60;
							
							$int = $hours + $mins;
							
							if($int > 12){
								$int = '12';
							} else{
								$int = $interval->format('%h') + number_format($mins,1);								
							}	
							if($urow['signin_time'] > $time_in )	{
								$sql = "UPDATE attendance SET working_hour = '$int' - TRUNCATE((ABS(( TIME_TO_SEC( TIMEDIFF('$time_in', '".$urow['signin_time']."' ) ) )))/3600, 1), schedtime = '$time_in', dlate = TRUNCATE((ABS(( TIME_TO_SEC( TIMEDIFF('$time_in', '".$urow['signin_time']."' ) ) )))/3600, 1) 
								WHERE id = '".$row['uid']."'";
								$conn->query($sql);
							} else {
								$sql = "UPDATE attendance SET working_hour = '$int', schedtime = '$time_in', dlate = TRUNCATE((ABS(( TIME_TO_SEC( TIMEDIFF('$time_in', '".$urow['signin_time']."' ) ) )))/3600, 1) 
								WHERE id = '".$row['uid']."'";
								$conn->query($sql);
							}
							
						}
						else{
							$output['error'] = true;
							$output['message'] = $conn->error;
						}
					}
					
				}
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Employee PIN not found';
		}
		
	}
	
	echo json_encode($output);
	if($query){
		$query->free();
	}

	$conn->close();

?>