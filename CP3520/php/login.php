<?php
	session_start();
	include 'conn.php';

/*
	if($mysqli->connect_errno)
		echo 'not connected to database: '.$mysqli->connect_error;
	else
		echo 'connected';
*/

	if(empty($_POST['username']) || empty($_POST['password']))
		header('Location: ../index.html');
	else {
		
    		if(isset($_POST['login'])) {

			$username = $_POST['username'];
			$password = $_POST['password'];
			$password = md5($password);
			

			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;

			$sql = $mysqli -> prepare("SELECT * FROM PHusers WHERE username=? AND password=?");
			$sql -> bind_param('ss', $username, $password);
			$sql -> execute();
			$result = $sql -> get_result();

			if($result -> num_rows == 1) {
				$_SESSION['type'] = "pharmacy";
				include '../includes/aheader.html';
				print("<p>Welcome $username</p>");
				include '../includes/footer.html';
			}
			else {
				$sql = $mysqli -> prepare("SELECT * FROM Pusers WHERE username=? AND password=?");
				$sql -> bind_param('ss', $username, $password);
				$sql -> execute();
				$result = $sql -> get_result();

				if($result -> num_rows == 1) {
					$_SESSION['type'] = "patient";
					include '../includes/uheader.html';
					print("<p>Welcome $username</p>");
					include '../includes/footer.html';
				}
				
				else {
				$sql = $mysqli -> prepare("SELECT * FROM Dusers WHERE username=? AND password=?");
				$sql -> bind_param('ss', $username, $password);
				$sql -> execute();
				$result = $sql -> get_result();

				if($result -> num_rows == 1) {
					$_SESSION['type'] = "doctor";
					include '../includes/dheader.html';
					print("<p>Welcome Dr. $username</p>");
					include '../includes/footer.html';
				}
				else {
				$sql = $mysqli -> prepare("SELECT * FROM PCusers WHERE username=? AND password=?");
				$sql -> bind_param('ss', $username, $password);
				$sql -> execute();
				$result = $sql -> get_result();

				if($result -> num_rows == 1) {
					$_SESSION['type'] = "pharmaceutical";
					include '../includes/pheader.html';
					print("<p>Welcome $username</p>");
					include '../includes/footer.html';
				}
				else {
					header('Location: ../index.html');
				}
			}
			}
		}
	}
    		/*else if(isset($_POST['signup'])) {
		    	$username = $_POST['username'];
		        $password = $_POST['password'];
		        $password = md5($password);

		        $sql = $mysqli -> prepare("INSERT INTO Pusers(username, password) VALUES(?, ?)");
		        $sql -> bind_param('ss', $username, $password);
		        $sql -> execute();
			
			if($sql -> errno) {
				//echo $mysqli -> error;
				header('Location: ../index.html');
			}
			else {
			        $_SESSION['username'] = $username;
			        $_SESSION['password'] = $password;
			        $_SESSION['type'] = "patient";

				include '../includes/uheader.html';
				print("<p>Welcome $username</p>");
				include '../includes/footer.html';
			}
		}*/
	}

	
	$mysqli -> close();
?>

