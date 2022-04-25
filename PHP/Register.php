<?php
session_start();
$dsn = "mysql:host=localhost;dbname=student";
$user = "root";
$pass = "";
$db=new PDO($dsn,$user,$pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	  try{

if(isset($_POST['signup']))
		{
			$email2=$_POST['email'];
			$password2=$_POST['password'];
			$username2=$_POST['username'];
			$_SESSION ['username']=$username2;
			$_SESSION ['password']=$password2;
			$_SESSION ['email']=$email2;
			$_SESSION['flag']="1";

			$select   = $db->prepare("SELECT * FROM user WHERE  username = '$username2'");
			$select->setFetchMode(PDO::FETCH_ASSOC);
			$select->execute();
			$data = $select->fetch();
			if ($data['username'] == $username2)
					header("location:../Register.html");
			else {
			$sql = "INSERT INTO user (email,username,password) VALUES ('$email2','$username2','$password2')";
				$db->query($sql);
				header("location:Department.php");
			}
	   }

	else
		{
			echo "no";
		}
}
catch(PDOException $e)
		{
			echo "failed". $e->getMessage();
		}
   $db=null;
?>
