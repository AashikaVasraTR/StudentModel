<?php
// Initialize the session
include_once "connection.php";
session_start();
$name=$_SESSION["username"];
$user_qid=$_SESSION["count"];
/*echo($name);
echo($user_qid);
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
debug_to_console($name);
debug_to_console($user_qid);*/
$sql="UPDATE sessions SET qid = ? WHERE username = ?";
if($stmt = mysqli_prepare($conn, $sql)){
    mysqli_stmt_bind_param($stmt, "is", $param_count, $param_username);
    $param_username = $name;
    $param_count=$user_qid;
      if(mysqli_stmt_execute($stmt)){
        // Redirect to login page
        //header("location: login.php");
      //  exit;
      echo "success";
      }
      else{
          echo "Something went wrong. Session not logged";
      }
        mysqli_stmt_close($stmt);
}
// Unset all of the session variables
$_SESSION = array();
// Destroy the session.
session_destroy();

// Redirect to login page
header("location: login.php");
exit;
?>
