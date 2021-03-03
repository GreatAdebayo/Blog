<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbName = 'blog_db';
$a = new mysqli($servername, $username, $password, $dbName);


if(!$a->connect_error){
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $loginSql = "SELECT * FROM users_tb WHERE username = '$username' and password = '$password'";
        $getUser = $a->query($loginSql);
        if($getUser->num_rows > 0){
        $_SESSION['user'] = $username;
        header('Location: homepage.php');
        }

    }
}
?>