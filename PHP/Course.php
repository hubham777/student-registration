<?php
  session_start();
      if($_SESSION['flag']=="1")
      echo "welcome  ".$_SESSION['username'];
      elseif ($_SESSION['flag']=="2") {
         echo "welcome  ".$_SESSION['username1'];
        }
$dsn = "mysql:host=localhost;dbname=student";
$user = "root";
$pass = "";
$db=new PDO($dsn,$user,$pass);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   try{
   	$iid=$_SESSION['what'];
     if($_SESSION['flag']=="2"){
      $iid=$_SESSION['what'];
    }
    elseif($_SESSION['flag']=="1"){
      $iid=$_SESSION['what'];
    }
      $sql="SELECT * from course where department_id=$iid";
      $result=$db->query($sql);
echo '
<!DOCTYPE html>
<html>
    <head>
      <title>Courses</title>
      <link rel="stylesheet" href="../css/style2.css">
      <link rel="stylesheet"  href="../css/normlization.css">
      <meta charset="UTF-8">
      <script>
          function myFunction() {
            location.replace("../Login.html")
        }
        </script>

    </head>
    <body>

<table <width="70%" border="1" highet="30%">
<tr>
<th> Course Name </th>


</tr>

 ';


foreach ($result as $row) {

	echo '<tr>
		<td>'.$row['course_name'].'</td>
	     </tr>';

      }

echo '</table>

 </body>
<button class="myButton" onclick="myFunction()">Logout</button>
</html>';


}
catch(PDOException $e)
		{
			echo "failed". $e->getMessage();
		}
   $db=null;
       ?>
