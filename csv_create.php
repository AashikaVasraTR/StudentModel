<?php
include_once "connection.php";
session_start();
$name = $_SESSION["username"];
$text="";
$filename = $name.".csv";
$filepath = "C:/xampp/htdocs/web/csv_files/".$filename;
/*print($name);
print("\n");
print($filename);*/
$myfile = fopen($filepath, "w", "C:/xampp/htdocs/web/csv_files/") or die("Unable to open file!");
fwrite($myfile,"Question,Answer\r\n");
$name = '"'. $name.'"';
//print($name);
$sql ="SELECT question,answer from answers where user_name=".$name;
//print($sql);
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $text = $text. '"'.$row["question"]. '"'.','.'"'.$row["answer"].'"';
    fwrite($myfile, $text);
    fwrite($myfile,"\r\n");
    $text='';
  //  print($text);
  }
  fclose($myfile);
} else {
  echo "0 results";
}
header("location:congratulations.php");
?>
