<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <style type="text/css">
  body{ font: 14px sans-serif; text-align: center; }
  </style>
</head>
<body>
  <div class="page-header">
    Pick the media of questions that you want to answer</h3>
  </div>
  <p>
    <br/><br/><br/>
    <font size="6">    <a href="https://cgi.csusm.edu/anton031/index.php" >Image</a></font><br/><br/><br/>
    <font size="6">    <a href="https://cgi.csusm.edu/gupta008/Web/index.html" >Sound</a></font><br/><br/><br/>
    <font size="6">    <a href="questions.php" >Text</a></font><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a><br/><br/><br/>
  </p>
</body>
</html>
