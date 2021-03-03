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
    $email = $_POST['email'];
    $password = $_POST['password'];
    $aleadyExistsSql = "SELECT * FROM users_tb WHERE username = '$username' and email = '$email' ";
    $check = $a->query($aleadyExistsSql);
    if($check->num_rows > 0){
     echo '<div class="alert alert-danger" role="alert">
     Email and username already exists!
     </div>';     
    }else{
         $successSubmission = $a->query("INSERT INTO users_tb(username, email, password) VALUES ('$username', '$email', '$password')");
     if($successSubmission){
            $_SESSION['user'] = $username;
            header('Location: homepage.php');
        }else{
            echo "error";
        
    }
 
}  
                       
}   
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
    
</body>
</html>