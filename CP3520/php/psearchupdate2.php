<?php
	session_start();
	include 'conn.php';

	if(empty($_SESSION['username']) || empty($_SESSION['password']))
		print("Access to database denied");
	else {
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
		$type = $_SESSION['type'];

		if($type == "patient") {
			include '../includes/uheader.html';
		}
		
		if(isset($_POST["searchButton"])) {
			$keyword = $_POST['keyword'];
			$choice = $_POST['choice'];	
 
		if($choice == "SIN") 
				$sql = $mysqli -> prepare("SELECT * from Patients Where SIN like ?");

	//	if ($choice == "PSIN") 
	//			$sql = $mysqli -> prepare("SELECT * FROM PrimaryPhysicians WHERE PSIN LIKE ?");

	//	if ($choice == "Pres") 
	//			$sql = $mysqli -> prepare("SELECT * FROM Prescription WHERE SIN LIKE ?");

			$keyword = '%'.$keyword.'%';
			$sql -> bind_param('s', $keyword);
			$sql -> execute();
			$result = $sql -> get_result();
		
		
			if(!$result)
				print("<p>Select query failed</p>");
			else {
				if($result -> num_rows == 0)
					print("<p>No match found</p>");
        		
				if($choice == "SIN") {
					print("<h1>Results</h1><table>");
	      			print("<tr><th>Name</th><th>Address</th><th>SIN</th><th>Age<th></th></tr>");
					while($row = $result -> fetch_object()) {
						echo '<tr>';
						echo '<td>'.$row -> Name.'</td>';
						echo '<td>'.$row -> Address.'</td>';
						echo '<td>'.$row -> SIN.'</td>';
                       	echo '<td>'.$row -> Age.'</td>';
						echo '</tr>';
						
					}
					print("</table">);
				}
        		
			/*	if ($choice == "PSIN"){
					print("<h1>Results</h1><table>");
	      			print("<tr><th>Patients SIN</th><th>Doctors SIN</th></tr>");
					while($row = $result -> fetch_object()) {
						echo '<tr>';
						echo '<td>'.$row -> PSIN.'</td>';
						echo '<td>'.$row -> DSIN.'</td>';
						echo '</tr>';
						
					}
						print("</table>");
				}
			
				
        		
				if ($choice == "Pres") {
					print("<h1>Results</h1><table>");
	      	print("<tr><th>Date</th><th>Quantity</th><th>Patients SIN</th><th>Doctors SIN<th><th>Tradename</th></tr>");
					while($row = $result -> fetch_object()) {
						echo '<tr>';
						echo '<td>'.$row -> Date.'</td>';
						echo '<td>'.$row -> Quantity.'</td>';
						echo '<td>'.$row -> PSIN.'</td>';
                                                echo '<td>'.$row -> DSIN.'</td>';
						echo '<td>'.$row -> TradeName.'</td>';
						echo '</tr>';
						
					}
					print("</table>");
				}*/
			}
		
		}
		
	

		else {
			include '../includes/psearchFormupdate.html';
			include '../includes/footer.html';
		}
	}
	$mysqli -> close();
?>
