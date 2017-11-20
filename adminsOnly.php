<?php

// start/resume session

session_start();

if (!isset($_SESSION['authenticated']) OR !$_SESSION['authenticated'] == 1) {

    die ("ERROR: Unauthorized access!");

}

else {

      echo  '<p>Welcome, ' . $_SESSION["user"] . '</p>';

?>

    <!DOCTYPE html>
<html>
<head>
 <title> Registration </title> 


<link href="style2.css" rel="stylesheet">

</head>
<body>

<header>

</header>

<div id="con">

    <div id="mainC">

    This is a secure page. You can only see this if you login.

</div>

</div>

    </body>

    </html>

<?php

}

?>
