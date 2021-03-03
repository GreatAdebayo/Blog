<?php
session_start();
$postId = $_SESSION['post'];
$user = $_SESSION['user'];
$servername = 'localhost';
$username = 'root';
$password = '';
$dbName = 'blog_db';
$a = new mysqli($servername, $username, $password, $dbName);

if(!isset($_SESSION['user'])){
    echo "Login" .' '. "<a href='homepage.php'>". 'here'. "</a>";
}else{
   if(!$a->connect_error){
   if(isset($_POST['submit'])){
    $commBody = $_POST['desc'];
    $usernameSql = "SELECT * FROM users_tb WHERE username = '$user'";
    $getUser = $a->query($usernameSql);
    if($getUser->num_rows > 0){
    $myFetchedUser = $getUser->fetch_assoc();
    $userId = $myFetchedUser['user_id'];
    $userna = $myFetchedUser['username'];
    $submit = $a->query("INSERT INTO com_tb(body, post_id, user_id, username) VALUES ('$commBody', '$postId', '$userId', '$userna')");
    if($submit){
           echo "Comment Posted";
        }
    else{
        echo "error";
        
    }
   
    }  }}  
}




?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
</head>
<body>
    
</body>
</html>