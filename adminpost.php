<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbName = 'blog_db';
$a = new mysqli($servername, $username, $password, $dbName);
$adminId = $_SESSION['admin'];
if(!$a->connect_error){
    if(isset($_GET['submit'])){
    $title = $_GET['title'];
    $desc = $_GET['desc'];
    $myFile = $_GET['myFile'];
    $successSubmission = $a->query("INSERT INTO post_tb(title, description,images, admin_id) VALUES ('$title', '$desc', '$myFile', '$adminId ')");
     if($successSubmission){
           echo "success";
        }else{
            echo "error";
        
    }
 
}  
                       
}   
    


?>