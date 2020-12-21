<!DOCTYPE html>
<html>
<head>
  <title>Congratulations</title>
  <link rel="stylesheet" type="text/css" href="congrats.css" />
</head>
<body>
  <div class="wrapper">
    <div class="modal modal--congratulations">
      <div class="modal-top">
        <img class="modal-icon u-imgResponsive" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSsMm-V-v-YVuF-9RKdmm3-RFeNsVaDJsCpZN-H2wWFlA7ATR0SA" alt="Trophy" /><img class="modal-icon u-imgResponsive" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSForpTOrQF-h5y5UvxH4zQAjSXNN4_8AxMVORcGo83mElIMXrs" alt="Congratulation" />
        <div class="modal-header">👍👍 Task complete!!! 👍👍<br/> Good luck with your future goals<br/>Thank You!
          <br/><br/><a id="logout_congratz" href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
        </div>
      </div>
    </div>
  </body>
  </html
  <?php
  // Initialize the session
  session_start();

  // Unset all of the session variables
  $_SESSION = array();

  // Destroy the session.
  session_destroy();

  ?>
