<?php


session_start();
include 'conn.php';

if(empty($_SESSION['username']) || empty($_SESSION['password']))
    print("Access to database denied");
else {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $type = $_SESSION['type'];

    if($type =='doctor') {
	include '../includes/dheader.html';
	print("<p>Insufficient privileges to add to Contracts Database</p>");      
    }
	elseif($type =='patient') {
	include '../includes/uheader.html';
	print("<p>Insufficient privileges to add to Contracts Database</p>");      
    }
	elseif($type =='pharmaceutical') {
	include '../includes/pheader.html';
	print("<p>Insufficient privileges to add to Contracts Database</p>");      
    }
    elseif($type =='pharmacy') {
	include '../includes/aheader.html';
	include '../includes/lookupform.html';

	if(isset($_POST["lookupPrescriptionButton"])) {

	    $Name = $_POST['Name'];
		$DName = $_POST['DName'];
		
		$sql = $mysqli -> prepare("select distinct Prescriptions.Filled, Prescriptions.Quantity, Prescriptions.DTN, Prescriptions.Date, Patients.Physician, Patients.Name from Prescriptions, Patients, Doctors
											where Prescriptions.Filled='No' and Patients.SIN=Prescriptions.PSIN and Doctors.SIN=Prescriptions.DSIN and Patients.Name='". $Name ."' and Patients.Physician=Doctors.Name and Doctors.Name='". $DName ."'");
		$sql -> execute();
		$result = $sql -> get_result();
		
	    if($sql -> errno)
			print("<p>Insert query failed</p>");
		if(empty($Name) || empty($DName))
			print("<p>Patients name and Doctors name required</p>");
		elseif($result -> num_rows == 0){
			print("<p>No prescription on file</p>");	
		}
		else{
	    print("<h1>Results</h1><table>");
	    print("<tr><th>Drug Trade Name</th><th>Quantity</th><th>Patient Name</th><th>Date Prescribed</th><th>Primary Physician</th><th>Is Filled?</th></tr>");
	    while($row = $result -> fetch_object()) {
		echo '<tr>';
		echo '<td>'.$row -> DTN.'</td>';
		echo '<td>'.$row -> Quantity.'</td>';
		echo '<td>'.$row -> Name.'</td>';
		echo '<td>'.$row -> Date.'</td>';
		echo '<td>'.$row -> Physician.'</td>';
		echo '<td>'.$row -> Filled.'</td>';
		echo '</tr>';
	    }
	    print("</table>");	
		}
	    
	}
		
	
		elseif(isset($_POST["fillPrescriptionButton"])){
	
			$PName = $_POST['PName'];
			$DoName = $_POST['DoName'];
			$DTName = $_POST['DTName'];
			$QuantityP = $_POST['QuantityP'];
			$DPrescribed = $_POST['DPrescribed'];
			
	
        $sql = $mysqli -> prepare("update Prescriptions, Doctors, Patients set Filled='Yes' where Patients.Name=? and Doctors.Name=? and Prescriptions.DTN=? and Prescriptions.Quantity=? and Prescriptions.Date=? and  Patients.SIN=Prescriptions.PSIN and Doctors.SIN=Prescriptions.DSIN and Patients.Physician=Doctors.Name");

		$sql -> bind_param('sssss', $PName, $DoName, $DTName, $QuantityP, $DPrescribed);
		$sql -> execute();
	
		if($sql -> errno || $mysqli->affected_rows ==0){
			print("<p>Insert query failed</p>");
		
		if(empty($DTName) || empty($QuantityP) || empty($DPrescribed))
			print("<p>All fields required to fill prescriptions</p>");
			}
		else 	
			print("<p>Prescription has been successfully filled</p>");
			
		
		}		
		
		include '../includes/footer.html';
	}
}
$mysqli -> close();
?>
