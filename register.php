<?php
session_start();
include_once "connection.php";
$username ="";
$username_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
  // Validate username
  if(empty(trim($_POST["username"]))){
    $username_err = "Please enter a username.";
  } else{
    // Prepare a select statement
    $sql = "SELECT name FROM registration WHERE name = ?";
    if($stmt = mysqli_prepare($conn, $sql)){
      mysqli_stmt_bind_param($stmt, "s", $param_username);
      $param_username = trim($_POST["username"]);
      if(mysqli_stmt_execute($stmt)){
        /* store result */
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1){
          $username_err = "This username is already taken.";
        } else{
          $username = trim($_POST["username"]);
        }
      } else{
        echo "Oops! Something went wrong. Please try again later.";
      }
      // Close statement
      mysqli_stmt_close($stmt);
    }
  }
  // Check input errors before inserting in database
  if(empty($username_err) ){
    // Prepare an insert statement
    $sql = "INSERT Into registration (name) values(?);";
    $sql2 = "INSERT into sessions (username) values (?);";
    $sql3="INSERT into comments (userid) values (?);";
    if(($stmt = mysqli_prepare($conn, $sql))&&($stmt2 = mysqli_prepare($conn, $sql2))&&($stmt3 = mysqli_prepare($conn, $sql3))){
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);
      mysqli_stmt_bind_param($stmt2, "s", $param_username);
      mysqli_stmt_bind_param($stmt3, "s", $param_username);
      // Set parameters
      $param_username = $username;
      // Attempt to execute the prepared statement
      if((mysqli_stmt_execute($stmt))&&(mysqli_stmt_execute($stmt2))&&(mysqli_stmt_execute($stmt3))){
        // Redirect to login page
        header("location: login.php");
        $_SESSION["username"] = $username;
        $_SESSION["count"]=0;
      }
      else{
        echo "Something went wrong. Please try again later.";
      }
      // Close statement
      mysqli_stmt_close($stmt);
    }
  }
  // Close connection
  mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <style type="text/css">
  body{ font: 14px sans-serif; }
  .wrapper{ width: 350px; padding: 20px; }
  </style>
</head>
<body>
  <div class="wrapper">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
        <span class="help-block"><?php echo $username_err; ?></span>
      </div>

      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Submit">
        <input type="reset" class="btn btn-default" value="Reset">
      </div>
      <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
  </div>
</body>
</html>
