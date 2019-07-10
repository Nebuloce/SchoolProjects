<?php
Header('Content-type: text/xml');
include_once("conn.php");
$instructorID = $_GET['q'];

$query ="SELECT assignments.instructorID, assignments.courseID, courses.cid, sum(courses.lecture), sum(courses.labs) 
        FROM assignments JOIN courses
        WHERE courseID = cid AND instructorID = '$instructorID'";
$result = @mysqli_query($link,$query) or die("Query failed");
$num_rows = mysqli_num_rows($result);

echo'<totalhours>';
while($row = mysqli_fetch_assoc($result)) {
echo'<hours>';
echo"<instructorID>".$row['instructorID']."</instructorID>";
echo"<lecthours>".$row['sum(courses.lecture)']."</lecthours>";
echo"<labhours>".$row['sum(courses.labs)']."</labhours>";
echo'</hours>';
  }
  
echo'</totalhours>';

mysqli_close($link);

?>
