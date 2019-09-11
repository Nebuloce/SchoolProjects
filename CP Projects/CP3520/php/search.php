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
		if(isset($_POST["searchButton"])) {
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
			}
	
		else if($type == "doctor"){
			include '../includes/doctorSearchForm.html';
			if($choice == "Name")
				$sql = $mysqli -> prepare("select * from Patients where Patients.Name like '%". $keyword ."%' and Patients.Physician like '%". $username ."%'");
				if(!empty($keyword)){
					$sql -> execute();
				}
				
			}
		else if($type == "pharmaceutical"){
			if($choice == "ContractP"){
				$sql = $mysqli -> prepare("select * from Contracts where Contracts.PName='". $keyword ."' and Contracts.PCN='". $username ."'");
				if(!empty($keyword)){
				$sql -> execute();
				}		
			}
			elseif($choice == "ContractS"){
				$sql = $mysqli -> prepare("select * from Contracts where Contracts.Supervisor='". $keyword ."' and Contracts.PCN='". $username ."'");
				if(!empty($keyword)){
				$sql -> execute();
				}		
			}
			elseif($choice == "Drug"){
				$sql = $mysqli -> prepare("select distinct Drugs.TName, Drugs.Formula, Makes.PCN, Sells.PName from Drugs, Makes, Sells where Drugs.TName=Makes.DTN and Drugs.TName like '%". $keyword ."%'");
			}
					if(!empty($keyword)){
					$sql -> execute();
				}
			
		}

				
		
			$result = $sql -> get_result();
			
			if(!$result)
				print("<p>Select query failed</p>");
			if($result -> num_rows == 0)
					print("<p>No match found</p>");
			
			else {
				
				
        		if($type == "patient"){
					if($choice == "SIN"){
					print("<h1>Results</h1><table>");
	      			print("<tr><th>Drug Name</th><th>Prescription Start Date</th><th>Prescribing Doctor</th></tr>");
					while($row = $result -> fetch_object()) {
						echo '<tr>';
						echo '<td>'.$row -> DTN.'</td>';
						echo '<td>'.$row -> Date.'</td>';
						echo '<td>'.$row -> Name.'</td>';
						echo '</tr>';
						}
					}
						print("</table>");
				}
				
					elseif($type == "doctor"){
		
						if($choice == "Name"){
					print("<h1>Results</h1><table>");
	      			print("<tr><th>Patient Name</th><th>Patient SIN</th><th>Age</th><th>Address</th><th>Primary Physician</th></tr>");
					while($row = $result -> fetch_object()) {
						echo '<tr>';
						echo '<td>'.$row -> Name.'</td>';
						echo '<td>'.$row -> SIN.'</td>';
						echo '<td>'.$row -> Age.'</td>';
						echo '<td>'.$row -> Address.'</td>';
						echo '<td>'.$row -> Physician.'</td>';
						echo '</tr>';
						}
					}
						print("</table>");
				}
				elseif($type == "pharmacy"){
					if($choice == "ViewC"){
					print("<h1>Results</h1><table>");
	      			print("<tr><th>Drug Name</th><th>Prescription Start Date</th><th>Prescribing Doctor</th></tr>");
					while($row = $result -> fetch_object()) {
						echo '<tr>';
						echo '<td>'.$row -> TName.'</td>';
						echo '<td>'.$row -> Formula.'</td>';
						echo '<td>'.$row -> Price.'</td>';
						echo '</tr>';
						}
					}
						print("</table>");
					}
				elseif($type == "pharmaceutical"){
					include '../includes/pharmaceuticalSearchForm.html';
					if($choice == "ContractP" || $choice == "ContractS"){
					print("<h1>Results</h1><table>");
	      			print("<tr><th>Supervisor</th><th>Pharmacy</th><th>Contract Start Date</th><th>Contract End Date</th></tr>");
					while($row = $result -> fetch_object()) {
						echo '<tr>';
						echo '<td>'.$row -> Supervisor.'</td>';
						echo '<td>'.$row -> PName.'</td>';
						echo '<td>'.$row -> StartD.'</td>';
						echo '<td>'.$row -> EndD.'</td>';
						echo '</tr>';
						}
					}
					
					elseif($choice == "Drug"){
						print("<h1>Results</h1><table>");
						print("<tr><th>Drug Name</th><th>Drug Formula</th><th>Manufactured By:</th><th>Sold By:</th></tr>");
						while($row = $result -> fetch_object()) {
							echo '<tr>';
							echo '<td>'.$row -> TName.'</td>';
							echo '<td>'.$row -> Formula.'</td>';
							echo '<td>'.$row -> PCN.'</td>';
							echo '<td>'.$row -> PName.'</td>';
							echo '</tr>';
							}
					}
						print("</table>");
					}
				}
		}
			
		elseif(isset($_POST["All"])) { 
			if($type== "doctor" ){
					include '../includes/doctorSearchForm.html';
					$sql = $mysqli -> prepare("SELECT * FROM Patients WHERE Patients.Physician like '%". $username ."%'");
					$sql -> execute();
					$result = $sql -> get_result();
						
					print("<h1>Results</h1><table>");
	      			print("<tr><th>Patient Name</th><th>Patient SIN</th><th>Age</th><th>Address</th><th>Primary Physician</th></tr>");
					while($row = $result -> fetch_object()) {
						echo '<tr>';
						echo '<td>'.$row -> Name.'</td>';
						echo '<td>'.$row -> SIN.'</td>';
						echo '<td>'.$row -> Age.'</td>';
						echo '<td>'.$row -> Address.'</td>';
						echo '<td>'.$row -> Physician.'</td>';
						echo '</tr>';
					}
				print("</table>");
			}
		}
		elseif(isset($_POST["Personal"])) { 
			if($type== "doctor" ){
					include '../includes/doctorSearchForm.html';
					$sql = $mysqli -> prepare("SELECT * FROM Doctors WHERE Doctors.Name like '%". $username ."'");
					$sql -> execute();
					$result = $sql -> get_result();
						
					print("<h1>Results</h1><table>");
	      			print("<tr><th>Name</th><th>Years of Experience</th><th>Specialty</th></tr>");
					while($row = $result -> fetch_object()) {
						echo '<tr>';
						echo '<td>'.$row -> Name.'</td>';
						echo '<td>'.$row -> YExp.'</td>';
						echo '<td>'.$row -> Specialty.'</td>';
						echo '</tr>';
					}
				print("</table>");
			}
		}
		elseif(isset($_POST["allDrugsButton"])) {//pharmacy
			if($type=="pharmacy"){
				include '../includes/pharmacySearchForm.html';
					$sql = $mysqli -> prepare("select distinct Drugs.*, Sells.Price from Drugs, Sells where Sells.PName='". $username ."' and Drugs.TName=Sells.DTN");
					$sql -> execute();
					$result = $sql -> get_result();
					print("<h1>All Available Drugs</h1><table>");	
	      			print("<table><tr><th>Drug Trade Name</th><th>Drug Formula</th><th>". $username ." Sell Price</th></tr>");
					while($row = $result -> fetch_object()) {
						echo '<tr>';
						echo '<td>'.$row -> TName.'</td>';
						echo '<td>'.$row -> Formula.'</td>';
						echo '<td>'.$row -> Price.'</td>';
						echo '</tr>';
					}			
			}	
			elseif($type=="pharmaceutical"){
				include '../includes/pharmaceuticalSearchForm.html';
					$sql = $mysqli -> prepare("select distinct Drugs.TName, Drugs.Formula, Makes.PCN from Drugs, Makes where Drugs.TName=Makes.DTN");
					$sql -> execute();
					$result = $sql -> get_result();
					print("<h1>All Available Drugs</h1><table>");	
	      			print("<table><tr><th>Drug Trade Name</th><th>Drug Formula</th><th>Manufactured By:</th></tr>");
					while($row = $result -> fetch_object()) {
						echo '<tr>';
						echo '<td>'.$row -> TName.'</td>';
						echo '<td>'.$row -> Formula.'</td>';
						echo '<td>'.$row -> PCN.'</td>';
						echo '</tr>';
					}
					$sql = $mysqli -> prepare("select distinct Drugs.TName, Sells.PName from Drugs, Sells where Drugs.TName=Sells.DTN");
					$sql -> execute();
					$result = $sql -> get_result();
	      			print("<table><tr><th>Drug Trade Name</th><th>Sold By:</th></tr>");
					while($row = $result -> fetch_object()) {
						echo '<tr>';
						echo '<td>'.$row -> TName.'</td>';
						echo '<td>'.$row -> PName.'</td>';
						echo '</tr>';
					}
			}
			print("</table>");
		}
		elseif(isset($_POST["allContractsButton"])) {
			if($type=="pharmacy"){
				include '../includes/pharmacySearchForm.html';
					$sql = $mysqli -> prepare("select distinct Contracts.* from Contracts where Contracts.PName='". $username ."'");
					$sql -> execute();
					$result = $sql -> get_result();
		
					print("<h1>All Available Contracts</h1><table>");	
	      			print("<table><tr><th>Supervisor</th><th>Pharmaceutical Company</th><th>Contract Start Date</th><th>Contract End Date</th></tr>");
					while($row = $result -> fetch_object()) {
						echo '<tr>';
						echo '<td>'.$row -> Supervisor.'</td>';
						echo '<td>'.$row -> PCN.'</td>';
						echo '<td>'.$row -> StartD.'</td>';
						echo '<td>'.$row -> EndD.'</td>';
						echo '</tr>';
					}
			}
			
			elseif($type=="pharmaceutical"){
				include '../includes/pharmaceuticalSearchForm.html';
					$sql = $mysqli -> prepare("select distinct Contracts.* from Contracts where Contracts.PCN like '%". $username ."%'");
					$sql -> execute();
					$result = $sql -> get_result();

					print("<h1>All Available Contracts</h1><table>");	
	      			print("<tr><th>Supervisor</th><th>Pharmacy Name</th><th>Contract Start Date</th><th>Contract End Date</th></tr>");
					while($row = $result -> fetch_object()) {
						echo '<tr>';
						echo '<td>'.$row -> Supervisor.'</td>';
						echo '<td>'.$row -> PName.'</td>';
						echo '<td>'.$row -> StartD.'</td>';
						echo '<td>'.$row -> EndD.'</td>';
						echo '</tr>';
					}
				
			}
			print("</table>");
		}
		
	
		else {
			if($type == "patient"){
			include '../includes/patientSearchForm.html';
			include '../includes/footer.html';
			}
			else if($type == "doctor"){
			include '../includes/doctorSearchForm.html';
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
		
		else{
		header('Location: ../index.html');}
		}
	}
	$mysqli -> close();
?>
