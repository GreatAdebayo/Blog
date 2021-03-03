<?php 
session_start();
if(isset($_SESSION['admin']))
{$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'blog_db';
$a = new mysqli($servername, $username, $password, $dbname);
$loggedInAdmin = $_SESSION['admin'];

if(!$a->connect_error){
 $getAdmin = "SELECT * FROM admin_tb WHERE admin_id = '$loggedInAdmin'";
 $dbQuery = $a->query($getAdmin);
 $myAdmin = $dbQuery->fetch_assoc();}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
 <nav class="navbar navbar-expand-md bg-primary navbar-dark fixed-top">
 <div class="container">
  <a class="navbar-brand text  font-weight-bold"><i class="fas fa-blog"></i> Great's blog</a>
 <a href="adminlogout.php"> <small class="text-light font-weight-bold">Admin Logout <i class="fas fa-user-crown"></i></small></a>
    </div>
</nav>

   <div class="container">
    <div class="row mt-5">
    <div class="col mt-4">
    <p class="text-primary font-weight-bold text-center"><i class="fas fa-blog"></i> Blog Admin Section</p> 
    
    <form action="adminpost.php" method="GET" class="w-100 mx-auto shadow rounded p-5">
    <small class="font-weight-bold text-primary"><i class="far fa-user-crown"></i> Admin Name: <?php echo $myAdmin['username'] ?></small><br> <br>
    <input type="text" class="form-control" placeholder="Post Title" name="title"><br>
    <textarea class="form-control text-justify" placeholder="Post Description" name="desc"></textarea>
    <br>
    <label for="exampleFormControlFile1"><small class="text-primary font-weight-bold"><i class="fas fa-paperclip"></i> Attach Image</small></label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="myFile"> <br> 
    <div class="text-center">
    <input type="submit" class="btn btn-sm btn-primary px-3" placeholder="Post Title" name="submit">    
    </div>    
    </form>   
    
    </div>
    </div>
   </div>   
</body>
</html>

<?php 

}else{
    echo "You cannot visis this page, login <a href='homepage.php'>here</a>";
}?>