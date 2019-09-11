<?php
 Header('Content-type: text/xml');
   include_once("conn.php");
$instructorID = $_GET['s'];
$courseID = $_GET['q'];
    $query ="INSERT INTO assignments VALUES('$instructorID','$courseID')";
    $result = @mysqli_query($link,$query) or die("Query Failed");

    $query2 ="SELECT assignments.courseID, assignments.instructorID
                FROM assignments
                WHERE instructorID= '$instructorID'";
    $result2 = @mysqli_query($link,$query2) or die("Query failed");
    $num_rows = mysqli_num_rows($result2);


echo'<assignments>';
    while($row = mysqli_fetch_assoc($result2)) {
        echo'<assignment>';
        echo"<instructorID>".$row['instructorID']."</instructorID>";
        echo"<courseID>".$row['courseID']."</courseID>";
        echo'</assignment>';
    }
echo'</assignments>';
mysqli_close($link);

?>
