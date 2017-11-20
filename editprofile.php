<!DOCTYPE html>
<html>
<head>
 <title> Registration </title> 

<link href="style.css" rel="stylesheet">

<style>

input[type=text],input[type=password],
input[type=email],select {
       border: 1px solid white;
    
}

</style>

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

if(isset($_POST["edit"]))
{
$Profile_ID =$_POST["Profile_ID"]; 
$NetID= $_POST["NetID"]; 
$First_Name= $_POST["First_Name"]; 
$Last_Name= $_POST["Last_Name"];
$Email= $_POST["Email"]; 
$Notification_Email= $_POST["Notification_Email"]; 

$servername = "localhost";
$username = "AQ_user";
$password = "my*password";
$dbname = "aqutaish";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE profiles SET NetID='$NetID',First_Name='$First_Name',Last_Name='$Last_Name',Email='$Email' ,Notification_Email='$Notification_Email' WHERE Profile_ID=$Profile_ID";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . " records UPDATED successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }


$conn = null;


}





?>


<form name="form" method="post" action="">

<?php

session_start();

if (!isset($_SESSION['authenticated']) OR !$_SESSION['authenticated'] == 1) {

    die ("ERROR: Unauthorized access!");

}

else {

 
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

            while($row = mysqli_fetch_array($result)){

                               
                     echo  " <div id='conE'>Profile_ID  :<input type='text' name='Profile_ID' value=' {$row['Profile_ID']} '>  <br /> </div>" .

                      " <div id='conE'> NetID :<input type='text' name='NetID' value=' {$row['NetID']}'> <br /></div>".

                      "<div id='conE'> First Name  :<input type='text' name='First_Name' value=' {$row['First_Name']}'> <br /></div>" .

                     "<div id='conE'> Last Name  :<input type='text' name='Last_Name' value='{$row['Last_Name']} '><br /></div>" .

                     "<div id='conE'> Email  :<input type='text' name='Email' value=' {$row['Email']} '><br /></div>" .

                      "<div id='conE'> Notification_Email  :<input type='text' name='Notification_Email' value=' {$row['Notification_Email']}'>  <a href='Eedit.php'>Edit</a>  <br /></div>";



            }

            mysqli_free_result($result);

         }

         mysqli_close($conn);

     }



}



?>

<input type="submit"  name ="edit" value="Edit" />
</form>
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