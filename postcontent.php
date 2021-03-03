<?php 
session_start();
$username = $GET['user'];
$postId = $_GET['id'];
$servername = 'localhost';
$username = 'root';
$password = '';
$dbName = 'blog_db';
$coms = [];
$a = new mysqli($servername, $username, $password, $dbName);
if(!$a->connect_error){
 $comSql = "SELECT body, date, user_id, post_id, username FROM com_tb";
 $getCom = $a->query($comSql);
if($getCom->num_rows > 0){
    while($row = $getCom->fetch_array()){
     $coms[] = $row;  
    }

}
 $getPost = "SELECT * FROM post_tb WHERE post_id = '$postId'";
 $dbQuery = $a->query($getPost);
 $myPosts = $dbQuery->fetch_assoc();
 $_SESSION['post'] = $myPosts['post_id'];
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Content</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
 <nav class="navbar navbar-expand-md bg-primary navbar-dark fixed-top">
 <div class="container">
  <a class="navbar-brand text  font-weight-bold"><i class="fas fa-blog"></i> Great's blog</a>
 <small class="text-light font-weight-bold"> POST CONTENTS</small>
 </div>
</nav>

   <div class="container">
    <div class="row mt-5">
    <div class="col shadow p-5 mx-auto mt-5 justify-content-center">
    <p class="text-primary font-weight-bold text-center"><i class="fas fa-blog"></i> BLOG POST CONTENTS </p> 
    <h5 class="text-primary font-weight-bold"><i class="fas fa-check-circle"></i> Post Title: <?php echo strtoupper($myPosts['title']) ?></h5> <br>
   <span class="text-dark font-weight-bold">Content:</span> 
   <p style="max-width: 100%; word-wrap: break-word"> 
       <?php echo $myPosts['description'] ?> 
   </p>
   <br>
    <small class="font-weight-bold"><i class="fas fa-watch"></i> Time Posted: <?php echo $myPosts['date'] ?> </small> <br> <br>
    <small class="text-info"><i class="fad fa-comments"></i> Comments:</small><br>
    <?php foreach($coms as $c) if($postId == $c['post_id']){echo "<small class='font-weight-bold text-primary'>".$c['username'].':'."</small>".' '. "<small>" .$c['body']."<br>". "</small>";}?>
<br> <br>
    
    
    <form action="commprocess.php" method="POST">
    <textarea type="text" class="form-control" placeholder="Post Your Comment" name="desc"></textarea> <br>
    <input type="submit" class="btn btn-sm btn-primary px-3" placeholder="Post Title" name="submit">
    </form>

    
    </div>
    </div>
   </div> 
    
</body>
</html>





