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
			print("<p>Insufficient privileges to access these functions.</p>");
		}
		if($type == "doctor") {
			include '../includes/dheader.html';
			print("<p>Insufficient privileges to access these functions.</p>");
		}
		elseif($type == "pharmacy")  {
			include '../includes/aheader.html';

			if(isset($_POST["deleteContractsButton"])) {
				$Select = $_POST['select'];
				$count = count($Select);

				for($i = 0; $i < $count; $i++) {
					$sql = $mysqli -> prepare("DELETE FROM Contracts WHERE PName='". $username ."' and Supervisor=?");
					$sql -> bind_param('s', $Select[$i]);
					$sql -> execute();
					if($sql -> errno)
						print("Delete query failed");
				}
				if($count == 1)
					print("<p>$count contract removed from database.</p>");
				else
					print("<p>$count contracts removed from database.</p>");
			}
			else {
				$sql = "SELECT * FROM Contracts where PName='". $username ."'";
				$result = $mysqli -> query($sql);
				if(!$result)
					print("<p>Select query failed</p>");
				else {
					if($result -> num_rows == 0)
						print("<p>There are no contracts in database</p>");
					else {
						print("<h1>Select contracts(s) to remove from database</h1>");
					?>

						<form name="deleteContracts" method="post" action="<?php $PHP_SELF?>">

					<?php
							print("<h1>Results</h1><table>");	
	      					print("<table><tr><th>Delete</th><th>Supervisor</th><th>Pharmaceutical Company</th><th>Contract Start Date</th><th>Contract End Date</th></tr>");
							while($row = $result -> fetch_object()) {
								echo '<tr>';
								$Select = $row -> Supervisor;
								print("<td><input type=\"checkbox\" name=\"select[]\" value=\"$Select\"></td>");
								echo '<td>'.$row -> Supervisor.'</td>';
								echo '<td>'.$row -> PCN.'</td>';
								echo '<td>'.$row -> StartD.'</td>';
								echo '<td>'.$row -> EndD.'</td>';
								echo '</tr>';
								print("\n");
							}
							print("</table><br />\n<input type=\"submit\" value=\"Delete selected contracts\" name=\"deleteContractsButton\"></form>");
					}
				}
			}
		}
		elseif($type == "pharmaceutical")  {
			include '../includes/pheader.html';

			if(isset($_POST["deleteContractsButton"])) {
				$Select = $_POST['select'];
				$count = count($Select);

				for($i = 0; $i < $count; $i++) {
					$sql = $mysqli -> prepare("DELETE FROM Contracts WHERE PCN='". $username ."' and Supervisor=?");
					$sql -> bind_param('s', $Select[$i]);
					$sql -> execute();
					if($sql -> errno)
						print("Delete query failed");
				}
				if($count == 1)
					print("<p>$count contract removed from database.</p>");
				else
					print("<p>$count contracts removed from database.</p>");
			}
			else {
				$sql = "SELECT * FROM Contracts where PCN='". $username ."'";
				$result = $mysqli -> query($sql);
				if(!$result)
					print("<p>Select query failed</p>");
				else {
					if($result -> num_rows == 0)
						print("<p>There are no contracts in database</p>");
					else {
						print("<h1>Select contract(s) to remove from database</h1>");
					?>

						<form name="deleteContracts" method="post" action="<?php $PHP_SELF?>">

					<?php	
	      					print("<table><tr><th>Delete</th><th>Supervisor</th><th>Pharmacy</th><th>Contract Start Date</th><th>Contract End Date</th></tr>");
							while($row = $result -> fetch_object()) {
								echo '<tr>';
								$Select = $row -> Supervisor;
								print("<td><input type=\"checkbox\" name=\"select[]\" value=\"$Select\"></td>");
								echo '<td>'.$row -> Supervisor.'</td>';
								echo '<td>'.$row -> PName.'</td>';
								echo '<td>'.$row -> StartD.'</td>';
								echo '<td>'.$row -> EndD.'</td>';
								echo '</tr>';
								print("\n");
							}
							print("</table><br />\n<input type=\"submit\" value=\"Delete selected contracts\" name=\"deleteContractsButton\"></form>");
					}
				}
			}	
			if(isset($_POST["deleteDrugsButton"])) {
				$SelectD = $_POST['selectd'];
				$count = count($SelectD);

				for($i = 0; $i < $count; $i++) {
					$sql = $mysqli -> prepare("DELETE Drugs, Makes FROM Drugs inner join Makes where Drugs.TName='" .$SelectD[$i]. "' and Makes.DTN='" .$SelectD[$i]. "' and Makes.PCN='". $username ."'");
					//DELETE FROM Drugs, Makes where Drugs.TName='" .$SelectD[$i]. "' and Makes.DTN='" .$SelectD[$i]. "'");

					$sql -> execute();
					
					if($sql -> errno)
						print("Delete query failed");
				}
				if($count == 1)
					print("<p>$count contract removed from database.</p>");
				else
					print("<p>$count contracts removed from database.</p>");
			}
			else {
				$sql = "SELECT Drugs.TName, Drugs.Formula FROM Drugs, Makes where Makes.PCN='". $username ."' and Drugs.TName=Makes.DTN";
				$result = $mysqli -> query($sql);
				if(!$result)
					print("<p>Select query failed</p>");
				else {
					if($result -> num_rows == 0)
						print("<p>There are no drugs in database</p>");
					else {
						print("<h1>Select drug(s) to remove from database</h1>");
					?>

						<form name="DeleteDrugs" method="post" action="<?php $PHP_SELF?>">

					<?php	
	      					print("<table><tr><th>Delete</th><th>Drug Name</th><th>Formula</th></tr>");
							while($row = $result -> fetch_object()) {
								echo '<tr>';
								$SelectD = $row -> TName;
								print("<td><input type=\"checkbox\" name=\"selectd[]\" value=\"$SelectD\"></td>");
								echo '<td>'.$row -> TName.'</td>';
								echo '<td>'.$row -> Formula.'</td>';
								echo '</tr>';
								print("\n");
							}
							print("</table><br />\n<input type=\"submit\" value=\"Delete selected drugs\" name=\"deleteDrugsButton\"></form>");
					}
				}
			}
		}

    	include '../includes/footer.html';
	}
	$mysqli -> close();
?>
