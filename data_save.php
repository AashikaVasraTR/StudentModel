 <?php
 session_start();
 include_once "connection.php";
 $name=$_SESSION["username"];
 $q_id=$_SESSION["q_id"];
$question= $_SESSION["question"];
 $INSERT = "INSERT Into answers (user_name, question_number, question, answer) values(?, ?, ?, ?)";
 $options = isset($_POST['options']) ? $_POST['options'] : '';
 $stmt = $conn->prepare($INSERT);
 echo($options);
 echo($q_id);
 $stmt->bind_param("siss", $name, $q_id, $question, $options);
 $stmt->execute();
 $stmt->close();
 $conn->close();
 header("location: questions.php");
 ?>
