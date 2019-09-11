<?php
	session_start();
	include 'conn.php';

	if(empty($_SESSION['username']) || empty($_SESSION['password']))
		print("Access to database denied");
	else {
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
		$type = $_SESSION['type'];

		if($type == "pharmacy") {
			include '../includes/aheader.html';
		}
		if($type == "pharmaceutical") {
			include '../includes/pheader.html';
		}
		if($type == "patient") {
			include '../includes/uheader.html';
		}
		if($type == "doctor") {
			include '../includes/dheader.html';
		}
		/*if(isset($_POST["searchButton"])) {
			$keyword = $_POST['keyword'];
			$choice = $_POST['choice'];
 		if($type == "patient"){
			if($choice == "SIN")
				$sql = $mysqli -> prepare("select distinct Prescriptions.DTN, Prescriptions.Date, Doctors.Name from Patients, Prescriptions, Doctors where Prescriptions.PSIN LIKE ?  and Prescriptions.DSIN=Doctors.SIN");
				$keyword = ''.$keyword.'';
			
				if(!empty($keyword)){
					$sql -> bind_param('s', $keyword);
					$sql -> execute();
				}
			}*/
		if($type == "doctor"){
				
					$sql = $mysqli -> prepare("SELECT distinct Drugs.TName, Drugs.Formula, Sells.PName FROM Drugs, Sells where Drugs.TName=Sells.DTN");
					$sql -> execute();
					$result = $sql -> get_result();
						
	      			print("<table><tr><th>Drug Trade Name</th><th>Drug Formula</th><th>Sold By:</th></tr>");
					while($row = $result -> fetch_object()) {
						echo '<tr>';
						echo '<td>'.$row -> TName.'</td>';
						echo '<td>'.$row -> Formula.'</td>';
						echo '<td>'.$row -> PName.'</td>';
						echo '</tr>';
					}
						print("</table>");
				
					
		}
		else {
			if($type == "patient"){
			include '../includes/patientSearchForm.html';
			include '../includes/footer.html';
			}
			else if($type == "doctor"){
			include '../includes/viewDrugs.html';
			include '../includes/footer.html';
			}
			else if($type == "pharmacy"){
			include '../includes/pharmacySearchForm.html';
			include '../includes/footer.html';
			}
			else if($type == "pharmaceutical"){
			include '../includes/pharmaceuticalSearchForm.html';
			include '../includes/footer.html';
			}
		}
	}

	$mysqli -> close();
?>