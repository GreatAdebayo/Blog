<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbName = 'blog_db';
$a = new mysqli($servername, $username, $password, $dbName);

if(!$a->connect_error){
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $adminSql = "SELECT * FROM admin_tb WHERE email = '$email' and password = '$password'";
        $getAdmin = $a->query($adminSql);
        if($getAdmin->num_rows > 0){
            $myFetchedAdmin = $getAdmin->fetch_assoc();
            $_SESSION['admin'] = $myFetchedAdmin['admin_id'];
            header('Location: admindashboard.php');
        }else { echo 'Incorrect Login details';}
       

    }
}

?>