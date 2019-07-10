<?php
  Header('Content-type: text/xml');
  include_once("conn.php");
  $pid = $_GET['q'];
  $semester = $_GET['s'];

  $query = "SELECT courses.cid, courses.cname,
            courses.credit, courses.lecture, courses.labs
            FROM programs, courses
            WHERE programs.pid='$pid' AND programs.semester='$semester' AND programs.cid=courses.cid";
            
  $result = @mysqli_query($link, $query) or die("Query failed"); 
  $num_rows = mysqli_num_rows($result);

echo'<courses>';
while($row = mysqli_fetch_assoc($result)) {
    echo'<course>';
    echo"<cid>".$row['cid']."</cid>";
    echo"<cname>".$row['cname']."</cname>";
    echo"<credit>".$row['credit']."</credit>";
    echo"<lecture>".$row['lecture']."</lecture>";
    echo"<labs>".$row['labs']."</labs>";
    echo'</course>';  
    }
echo'</courses>';
  mysqli_close($link);
?>
