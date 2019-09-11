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
		else {
			if($type == "pharmaceutical"){
			include '../includes/pheader.html';
			include '../includes/pcaddform.html';
			if(isset($_POST["addContractButton"])) {
				$Supervisor = $_POST['Supervisor'];
				$PName = $_POST['PName'];
				$StartD = $_POST['StartD'];
				$EndD = $_POST['EndD'];

				$sql = $mysqli -> prepare("INSERT INTO Contracts (Supervisor, PCN, PName, StartD, EndD) select ?, '". $username ."' , ?, ?, ? from Pharmacy where '". $PName ."'=Pharmacy.Name");
				$sql -> bind_param('ssss', $Supervisor, $PName, $StartD, $EndD);
				$sql -> execute();

				if($sql -> errno || $mysqli->affected_rows ==0){
					print("<p>Insert query failed</p>");
				if(empty($Supervisor) || empty($PName) || empty($StartD) || empty($EndD))
						print("<p>All fields required</p>");
				}
				else
					print("<p>Contract added</p>");
			}
				elseif(isset($_POST["addDrugsButton"])) {
	
				$DTName = $_POST['DTName'];
				$DFormula = $_POST['DFormula'];

				$sql = $mysqli -> prepare("INSERT INTO Drugs (TName, Formula) select ?, ?");
				$sql -> bind_param('ss', $DTName, $DFormula);				
				$sql -> execute();
				
				$sql = $mysqli -> prepare("INSERT INTO Makes (DTN, PCN) select ?, '". $username ."' from Pharmaceutical where '". $username ."'=Pharmaceutical.Name");
				$sql -> bind_param('s', $DTName);				
				$sql -> execute();

				if($sql -> errno || $mysqli->affected_rows ==0){
					print("<p>Insert query failed</p>");
				if(empty($DFormula) || empty($DTName))
						print("<p>All fields required</p>");
				}
				else
					print("<p>Drug added</p>");
			}
				elseif(isset($_POST["viewPharmacies"])) {
							$sql = $mysqli -> prepare("select * from Pharmacy");
							$sql -> execute();
							$result = $sql -> get_result();

							print("<h2>Pharmacies</h2><table>");	
							print("<table><tr><th>Pharmacy Name</th><th>Address</th><th>Phone Number</th></tr>");
							while($row = $result -> fetch_object()) {
								echo '<tr>';
								echo '<td>'.$row -> Name.'</td>';
								echo '<td>'.$row -> Address.'</td>';
								echo '<td>'.$row -> Phone.'</td>';
								echo '</tr>';
							}
				}
				
		}	//Add Contract for Pharmacy and Pharmaceutical
			if($type == "pharmacy"){
			include '../includes/aheader.html';
			include '../includes/paddContractForm.html';
			if(isset($_POST["addContractPharmacyButton"])) {
	
				$Supervisor = $_POST['Supervisor'];
				$PCN = $_POST['PCN'];
				$StartD = $_POST['StartD'];
				$EndD = $_POST['EndD'];

				$sql = $mysqli -> prepare("INSERT INTO Contracts (Supervisor, PCN, PName, StartD, EndD) select ?, ?, '". $username ."', ?, ? from Pharmaceutical where '". $PCN ."'=Pharmaceutical.Name");
				$sql -> bind_param('ssss', $Supervisor, $PCN, $StartD, $EndD);				
				$sql -> execute();

				if($sql -> errno || $mysqli->affected_rows ==0)
					print("<p>Insert query failed</p>");
				else
					print("<p>Contract added</p>");
			}
				
	
			
		}
			else {
			if($type == "doctor"){
			include '../includes/dheader.html';
			include '../includes/daddform.html';
				if(isset($_POST["viewPrescriptionsButton"])) {
					$PName = $_POST['PName'];
		
					$sql = $mysqli -> prepare("select distinct Prescriptions.Filled, Prescriptions.Quantity, Prescriptions.DTN, Prescriptions.Date, Patients.Physician, Patients.Name from Prescriptions, Patients, Doctors
											where Patients.SIN=Prescriptions.PSIN and Doctors.SIN=Prescriptions.DSIN and Patients.Name=? and Patients.Physician=Doctors.Name and Doctors.Name like '%". $username ."%'");
					$sql -> bind_param('s', $PName);
					$sql -> execute();
					$result = $sql -> get_result();
					
					if($sql -> errno)
						print("<p>Insert query failed</p>");
					elseif(empty($PName))
						print("<p>Patients name required</p>");
					elseif($result -> num_rows == 0){
						print("<p>No prescription on file</p>");	
					}
					else{							
						 print("<h1>Patient Prescriptions</h1><table>");
						 print("<tr><th>Drug Trade Name</th><th>Quantity</th><th>Patient Name</th><th>Date Prescribed</th><th>Primary Physician</th><th>Is Filled?</th></tr>");
							while($row = $result -> fetch_object()) {
							echo '<tr>';
							echo '<td>'.$row -> DTN.'</td>';
							echo '<td>'.$row -> Quantity.'</td>';
							echo '<td>'.$row -> Name.'</td>';
							echo '<td>'.$row -> Date.'</td>';
							echo '<td>'.$row -> Physician.'</td>';
							echo '<td>'.$row -> Filled.'</td>';
						}
							print("</table>");	
					}
				}

			if(isset($_POST["addPrescriptionButton"])) {
				$DTN = $_POST['DTN'];
				$PSIN = $_POST['PSIN'];
				$Date = $_POST['Date'];
				$Quantity = $_POST['Quantity'];
				
				$sql = $mysqli -> prepare("insert into Prescriptions (DTN, Quantity, PSIN, DSIN, Date) select Drugs.TName, ?, ?, Doctors.SIN, ? from Doctors, Patients, Drugs where Doctors.Name 
											like '%". $username ."%' and Patients.Physician like '%". $username ."%' and Patients.SIN=$PSIN and Drugs.TName='$DTN'");
				if(!empty($DTN) && !empty($PSIN) && !empty($Date) && !empty($Quantity)){
				$sql -> bind_param('sss', $Quantity, $PSIN, $Date);
				$sql -> execute();
				
				if($sql -> errno || $mysqli->affected_rows ==0)
					print("<p>Insert query failed</p>");
				
				}
				if(empty($DTN) || empty($PSIN) || empty($Date) || empty($Quantity))
					print("<p>All fields required</p>");
				elseif($mysqli->affected_rows >0){
					print("<p>$DTN added to $PSIN Prescriptions</p>");
				}
			}
		
				if(isset($_POST["addPatientsButton"])) {
					
					$Name = $_POST['Name'];
					$SIN = $_POST['SIN'];
					$Age = $_POST['Age'];
					$Address = $_POST['Address'];

			
				$sql = $mysqli -> prepare("insert into Patients (Name, SIN, Age, Address, Physician) select ?, ?, ?, ?, Doctors.Name from Doctors where Doctors.Name like '%". $username ."%'");
				$sql -> bind_param('ssss', $Name, $SIN, $Age, $Address);
				
				$sql -> execute();
					
					
				if(empty($Name) || empty($SIN) || empty($Age) || empty($Address))
					print("<p>All fields required</p>");
				elseif($sql -> errno || $mysqli->affected_rows ==0)
					print("<p>Insert query failed</p>");
				
				else
					
					print("<p>$Name, $SIN, $Age, $Address added patients database</p>");
				}
				else {
				
					include '../includes/footer.html';
				}
				
			
			}	
		
		}
		}
	}

	$mysqli -> close();
?>
