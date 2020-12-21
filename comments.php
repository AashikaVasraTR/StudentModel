<?php
include_once "connection.php";
session_start();
$name = $_SESSION["username"];
$message = "Hello there!  A new user  ".$name."  has been added to ITS - text domain.  This is an automatic user registration notification email to Dr. Yoshii under whom this ITS is established";
//$to = "vasraaashi@gmail.com, thiru001@cougars.csusm.edu,ryoshii@csusm.edu";
$to ="vasraaashi@gmail.com";
$subject = "Notification from Student Model - Text domain";

// It is mandatory to set the content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers. From is required, rest other headers are optional
$headers .= 'From: <aashikavasra@example.com>' . "\r\n";
mail($to,$subject,$message,$headers);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Comments page</title>
  <link  rel="stylesheet" type="text/css" href="app.css"></link>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <div id="element1">
    Username : <?php echo htmlspecialchars($name); ?>
  </div>
</head>
<body>
  <link rel="stylesheet" href="comments.css">
  <h3 id="instruction"><br/><br/>Feedback page</h3>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="widget-area no-padding blank">
          <div class="status-upload">
              <form method="POST" action="comments_save.php">
              <textarea placeholder="Please enter your comments about our system here(optional)"  name="comment"></textarea>
              <ul>
                <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Audio"><i class="fa fa-music"></i></a></li>
                <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Video"><i class="fa fa-video-camera"></i></a></li>
                <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Sound Record"><i class="fa fa-microphone"></i></a></li>
                <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Picture"><i class="fa fa-picture-o"></i></a></li>
              </ul>
              <button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Submit</button>
            </form>
          </div>
        </div>
      </div>
      </div>
  </div>
</body>
<script type="text/javascript">
$(document).ready(function(){
    $("[data-toggle=tooltip]").tooltip();
});</script>
</html>
