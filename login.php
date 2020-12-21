<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: questions.php");
  exit;
}

// Include config file
require_once "connection.php";

// Define variables and initialize with empty values
$username ="";
$username_err= "";
$dummy=0;

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  // Check if username is empty
  if(empty(trim($_POST["username"]))){
    $username_err = "Please enter username.";
  } else{
    $username = trim($_POST["username"]);
  }
  // Validate credentials
  if(empty($username_err)){
    // Prepare a select statement
    $sql = "SELECT  name FROM registration WHERE name = ?";
    if($stmt = mysqli_prepare($conn, $sql)){
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);
      // Set parameters
      $param_username = $username;
      // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)){
        // Store result
        mysqli_stmt_store_result($stmt);
        // Check if username exists, if yes then verify password
        if(mysqli_stmt_num_rows($stmt) == 1){
          // Bind result variables
          mysqli_stmt_bind_result($stmt, $username);
          if(mysqli_stmt_fetch($stmt)){
            $pick = "SELECT `qid` FROM `sessions` WHERE `username` = '$param_username'";
            echo($pick);
            $result2 = mysqli_query($conn, $pick); // get the mysqli result
            $user_question_count = mysqli_fetch_array($result2); // fetch data
            if($user_question_count[0]==93|| $user_question_count[0]==0)
              $user_question_count[0]=$dummy;
            else {
                $user_question_count[0]=$user_question_count[0]-1;
            }
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["count"]=$user_question_count[0];
            header("location: questions.php");
          }
        } else{
          // Display an error message if username doesn't exist
          $username_err = "No account found with that username.";
        }
      } else{
        echo "Oops! Something went wrong. Please try again later.";
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
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <style type="text/css">
  body{ font: 14px sans-serif; }
  .wrapper{ width: 350px; padding: 20px; }
  </style>
</head>
<body>
  <div class="wrapper">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
        <span class="help-block"><?php echo $username_err; ?></span>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Login">
      </div>
      <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
    </form>
  </div>
</body>
</html>
