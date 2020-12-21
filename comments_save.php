<?php
session_start();
include_once "connection.php";
$name=$_SESSION["username"];
$sql = "UPDATE comments SET comments=? WHERE userid=?";
$comment = isset($_POST['comment']) ? $_POST['comment'] : '';
if($stmt = mysqli_prepare($conn, $sql)){
    mysqli_stmt_bind_param($stmt, "ss", $param_comment, $param_username);
    $param_username = $name;
    $param_comment=$comment;
      if(mysqli_stmt_execute($stmt)){
      echo "success";
      }
      else{
          echo "Something went wrong. Comment not stored";
      }
        mysqli_stmt_close($stmt);
}
header("location: csv_create.php");
?>
