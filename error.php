 <!DOCTYPE html>
<html>
<head>
 <title> Registration </title> 

<link href="style.css" rel="stylesheet">



</head>
<body>

<header>
<br><br><br><br>

<!--header -->

    </header>

<?php include "menu.php"; ?>


<div id="content">


        <div id="mainContent">

<?php

session_start();


if (@!$_SESSION['authenticated'] == 1) {

    echo "   <p>To use this web site, you need to have valid credentials.</p>";

}

else {}

?> 




</div>
</div>
    <aside>
        <!-- Sidebar -->
    </aside>
</div>



  <div id="footer"><br><br><br><br><br><br>
  </div>
<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
</body>
</html>