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

if (!isset($_SESSION['authenticated']) OR !$_SESSION['authenticated'] == 1) {

    die ("ERROR: Unauthorized access!");

}

else {

      echo  '<div id="conE" style="margin:80px; padding-bottom:40px"> <p>Welcome, ' . $_SESSION["user"] . ' </p>';

 
  $username=  $_SESSION["user"]; 


$conn = new mysqli("localhost", "AQ_user",  "my*password", "aqutaish");

      if (mysqli_connect_errno()){

          echo 'Cannot connect to database: ' .
              mysqli_connect_error($conn);

      }

      else{

        

         $query = "SELECT  * FROM  profiles where  Username='$username';";

         //run the query and keep results in $result variable

         $result = mysqli_query($conn, $query);

         // Check the result

         if (!$result) {

            die("Invalid query: " . mysqli_error($conn));

         }

         else {
            
   

            echo "<br>";



            while($row = mysqli_fetch_array($result)){

                $fstring =substr($row['First_Name'],0,1);  
                $lstring =substr($row['Last_Name'],0,1);  
                echo  "<div id='round2''><center> <h1 style=' font-size:100%; float:right'> $fstring$lstring  </h1></div>";              
 
                     echo "<h2> {$row['First_Name']}   {$row['Last_Name']}</h2></center>" ;

      
            }

            mysqli_free_result($result);

         }

         mysqli_close($conn);

     }



}



?>
<BR><BR>
<h2> <a href="mytask.php">Task Assign To Me</a></h2> <br>


<br><div id="right"><nav style="width:90px"> 
 <a href="editprofile.php">Edit</a> </div><br>
<a  href="about.php" style="padding-left:340px"> <b> About </b> </a></nav>
</div>
</div>
</div>

    <aside>
        <!-- Sidebar -->
    </aside>
</div>
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