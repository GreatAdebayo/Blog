<?php 
session_start();
$servername = 'localhost';
$username = 'root';
$password = '';
$dbName = 'blog_db';
$a = new mysqli($servername, $username, $password, $dbName);
$posts = [];
$coms = [];
$user = strtoupper($_SESSION['user']);

if(!$a->connect_error){
$postSql = "SELECT post_id, title, description, date FROM post_tb";
$comSql = "SELECT body, date, user_id FROM com_tb";
$getPosts = $a->query($postSql);
$getCom = $a->query($comSql);
if($getPosts->num_rows > 0){
    while($row = $getPosts->fetch_array()){
     $posts[] = $row;  
    }

    } 
if($getCom->num_rows > 0){
    while($row = $getCom->fetch_array()){
     $coms[] = $row;  
    }

    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Great's Blog</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
</head>
<body>
<style>
.text{text-decoration:none; 
     color:white; 
     font-weight:bold;}
    
</style>
<nav class="navbar navbar-expand-md bg-primary navbar-dark fixed-top">
 <div class="container">
  <a class="navbar-brand text"><i class="fas fa-blog"></i> Great's blog</a>
 <?php if(!isset($_SESSION['admin'])){echo "<small class='text-light pr-2 font-weight-bold' data-toggle='modal' data-target='#exampleModal3'>". "<i class='fas fa-user-crown'></i>". ' '. "Admin Login" . "</small>";}?> 
    </div>
</nav>
   <div class="container fluid">
   <div class="row mt-5">
    <div class="col mt-3 pt-2">
    <div class="text-right">
    <?php if(!isset($_SESSION['user'])){echo "<small class='text-primary pr-2' data-toggle='modal' data-target='#exampleModal'>". "<i class='fas fa-plus-square'></i>". ' '. "Sign Up" . "</small>";}?>
    
    <?php if(!isset($_SESSION['user'])){echo "<small class='text-primary pr-2' data-toggle='modal' data-target='#exampleModal1'>". "<i class='fas fa-sign-in-alt'></i>". ' '. "LogIn" . "</small>";}?>
    
     <?php if(isset($_SESSION['user'])){echo "<i class='fas fa-user-tie text-primary'></i>"."<small class='font-weight-bold text-primary'>".' '. $user . "</small>" ;}?>
     
      <?php if(isset($_SESSION['user'])){echo "<a href='userlogout.php' >". "<small>" . 'Logout'."</small>" . "<a/>" ;}?>
    </div>
    
     
    
    <div class="row mt-3">
    <div class="col text-center">
    <small class="font-weight-bold text-primary"><i class="fas fa-clone"></i> Posts</small>
    <ul class="list-group list-group-flush mt-5">
    <?php foreach($posts as $p)  echo "<a href='postcontent.php?id=".$p['post_id']."' class='list-group-item text-primary'>". '<i class="fas fa-blog"></i>'.' '.$p['title']. "<br>" . "</a>" ?>
    </ul>   
    </div>

    </div>
    
    </div>
    </div>
    
<!--   USER SIGN UP PAGE-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><small class="font-weight-bold text-primary"><i class="fas fa-plus-square"></i> Sign Up</small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="usersignup.php" method="POST">
      <input type="text" class="form-control" placeholder="Username" name="username"> <br>
      <input type="text" class="form-control" placeholder="email" name="email"> <br>
      <input type="text" class="form-control" placeholder="password" name="password"> <br>
      <input type="submit" class="btn btn-primary btn-sm" name="submit">
      </form>


      </div>
    </div>
  </div>
</div>
<!--   SIGNUP PAGE-->
  
  
  <!--   USER LOGIN PAGE-->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><small class="font-weight-bold text-primary"><i class="fas fa-sign-in-alt"></i> Login</small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="userlogin.php" method="POST">
      <input type="text" class="form-control" placeholder="email" name="username"> <br>
      <input type="text" class="form-control" placeholder="password" name="password"> <br>
      <input type="submit" class="btn btn-primary btn-sm" name="submit">   
      </form>
      </div>
      </div>
    </div>
  </div>
</div>
<!--   USER LOGIN PAGE-->
  
  
  
<!--  ADMIN LOG IN PAGE-->
 <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><small class="font-weight-bold text-primary"><i class="fas fa-sign-in-alt"></i> Admin Login</small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="adminlogin.php" method="POST">
      <input type="text" class="form-control" placeholder="email" name="email"> <br>
      <input type="text" class="form-control" placeholder="password" name="password">  <br>
      <div class="text-center font-weight-bold">
       <input type="submit" class="btn btn-primary btn-sm" name="submit">    
      </div>
      </form>
      </div>
    </div>
  </div>
</div>
  
  
<!--  ADMIN LOGIN PAGE-->
   
   
   

    
    
    
    
    
    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>