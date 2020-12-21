<?php
session_start();
include_once "connection.php";
$name = $_SESSION["username"];
$counts = $_SESSION["count"];
?>
<!DOCTYPE html>
<html>
<head>
  <link  rel="stylesheet" type="text/css" href="app.css"></link>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"></link>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <br/>
  <div id="element1">
    Username : <?php echo htmlspecialchars($name); ?>
  </div>
  <div id="element2">
    <?php echo htmlspecialchars($_SESSION["count"]); ?>/93 questions answered
  </div>
</head>

<body id = "background_body">
  <?php
  $SELECT ;
  $result;
  $maxCount=33;
  if($_SESSION['count']==$maxCount){
       $_SESSION["username"]=$_SESSION["username"];
      header("location: comments.php");
    exit;
  }
  if($_SESSION['count']==0){
    $SELECT = "SELECT * FROM questions WHERE question_id=1";
    $result = mysqli_query($conn, $SELECT);
    $x=$_SESSION['count'] + 2;
  //  $_SESSION['count']=$x;
    //  echo($_SESSION['count']);
    $_SESSION["username"]=$_SESSION["username"];
    $_SESSION["count"]=$x;
  }
  else{
    $SELECT = "SELECT * FROM questions WHERE question_id=".$_SESSION['count'];
    $result = mysqli_query($conn, $SELECT);
    $x=$_SESSION['count'] + 1;
    //$_SESSION['count']=$x;
    $_SESSION["username"]=$_SESSION["username"];
    $_SESSION["count"]=$x;
  }

  $resultCheck = mysqli_num_rows($result);
  if($resultCheck > 0){
    //Fetching the results and storing it in bulk
    while($row = mysqli_fetch_assoc($result)){
      ?>
      <br/><br/>
      <p align="center"  id="instruction">Choose the most likely sentiment that matches the following sentence</p>
      <form method="POST" action="data_save.php">
        <h3 align = "center" id="question_text">"<?php echo $row['question'];?>"</h3>
        <?php
        $question=$row['question'];
        $name = $_SESSION["username"];
        $q_id = $row['question_id'];
        //$q_id=$_SESSION['count'];
         ?>
        <div id='div2'  align="center">
          <br/>
          <label  class="container" >
                <input type="radio" name="options" value=" <?php echo $row['option1'];?>" required/>&nbsp;&nbsp; <?php echo($row['option1']);?>
          </label>
          <br/><br/>
          <label class="container">
            <input type="radio" name="options" value="<?php echo $row['option2'];?>" required/>&nbsp;&nbsp;<?php echo($row['option2']);?>
          </label>
          <br/><br/>
          <label class="container">
            <input type="radio"  align="center" name="options" value="<?php echo $row['option3'];?>" required/>&nbsp;&nbsp;<?php echo($row['option3']);?>
          </label>
          <?php
          $_SESSION["username"]=$_SESSION["username"];
          $_SESSION["count"]=$x;
          $_SESSION["q_id"]=$q_id;
          $_SESSION["question"]=$question;

        }
      }
      ?>
      <br/><br/><button class="button" style="vertical-align:middle" id="submit_button"><span>Load next question </span></button>
      <!--<button id ="submit_button" type="submit">Load next question</button>-->
      <br/><br/><u><a href="logout.php" class="button">Sign Out of Your Account</a></u></div>
    </form>
  </body>
</html>
