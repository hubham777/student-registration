<?php
session_start();
$dsn  = "mysql:host=localhost;dbname=student";
$user = "root";
$pass = "";
$db   = new PDO($dsn, $user, $pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    if (isset($_POST['login'])) {
        $password = $_POST['password1'];
        $username = $_POST['username1'];
        $_SESSION['flag'] = "2";
        $select   = $db->prepare("SELECT * FROM user WHERE username = '$username' and password = '$password'");
        $select->setFetchMode(PDO::FETCH_ASSOC);
        $select->execute();
        $data = $select->fetch();
        if ($data['username'] != $username and $data['password'] != $password)
            header("location:../Login.html");
         elseif ($data['username'] == $username and $data['password'] == $password) {
            $_SESSION['username1'] = $data['username'];
            $_SESSION['password1'] = $data['password'];

            $select2 = $db->prepare("SELECT department_id FROM user WHERE username='$username' and password='$password'");
            $select2->setFetchMode(PDO::FETCH_ASSOC);
            $select2->execute();
            $data2                     = $select2->fetch();
            $_SESSION['department_id'] = $data2['department_id'];
            if ($data2['department_id'] == null) {
                header("location:Department.php");

            } else {
                header("location:Course.php");
                $db->null;
            }
        }
    } else {
        echo "no";
    }
}
catch (PDOException $e) {
    echo "failed" . $e->getMessage();
}
$db = null;
?>
