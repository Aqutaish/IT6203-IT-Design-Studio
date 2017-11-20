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
            $rr="";
if (!isset($_SESSION['authenticated']) OR !$_SESSION['authenticated'] == 1) {

    die ("ERROR: Unauthorized access!");

}

else {

      echo  '<p>Welcome, ' . $_SESSION["user"] . '</p>';




$conn = new mysqli("localhost", "AQ_user",  "my*password", "aqutaish");

      if (mysqli_connect_errno()){

          echo 'Cannot connect to database: ' .
              mysqli_connect_error($conn);

      }

      else{

        $username=$_SESSION["user"];

       /*  $username=$_SESSION["user"]; */
        
                 $query = "SELECT  * FROM  task  INNER JOIN  profiles  ON  task.Profile_ID= profiles.Profile_ID
                           where  Username='$username';";
                       


         //run the query and keep results in $result variable

         $result = mysqli_query($conn, $query);

         // Check the result

         if (!$result) {

            die("Invalid query: " . mysqli_error($conn));

         }

         else {


            while($row = mysqli_fetch_array($result)){
        
        $rr = $row['Task_ID'];

                     echo  "<div id='conE' style='max-width:550px; margin-right:40px'>  <h2><u> Task Information </u></h2><br> <b>".

                      "<b>Task_ID: </b>&nbsp; &nbsp;{$row['Task_ID']} <br /><br />" .

                     "<b>Task_description: </b>&nbsp; &nbsp; {$row['Task_description']} <br /><br />".

                     "<b>Task deadline : </b>&nbsp; &nbsp; {$row['Availability']} <br /><br />".

                    "<b>Task status : </b>&nbsp; &nbsp; Inprogress<br /><br /></br>".

                   " <form name='form' method='post' action=''> Edit Status :           

                    <input type='submit'  name='' value='Complete'/> </form></br></br></div>";
        
       
            }




                           $sql ="DELETE FROM task  where  Task_ID='$rr';";

if ($conn->query($sql) === TRUE) {
/*    echo "Record deleted successfully";*/
} else {
   /* echo "Error deleting record: " . $conn->error;*/
}   



            mysqli_free_result($result);

         }

         mysqli_close($conn);

     }



}



?>




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