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
<h3></h3>
 
<br>


 <?php
@session_start(); //start session

$us=' '; $pa=' '; $error=' '; $chkError=' ';

if(isset($_POST['submit'])){
    $chkError = FALSE;


     if (empty($_POST["username"])) {    
	$chkError = TRUE;
	$error.= " UserName is Missing. </br>";
	
         } 
else{

      $us= "%".$_POST["username"]."%";
}

if (empty($_POST["password"])) {    
	$chkError = TRUE;
	$error.= "Password is Missing. ";
	
         } 
else{

    $pa = filter_input(INPUT_POST, "password");

}



if ($chkError == FALSE)
{
$name = $_POST["username"];

  $pass = $_POST["password"];
 


}

ELSE
{
echo  $error ;
}




if (!isset($_SESSION['authenticated'])) {

    session_regenerate_id();

    $_SESSION['authenticated'] = 0;

}


// using ldap bind

$ldaprdn  = 'cn=' . $name . ',dc=designstudio1,dc=com';

$ldappass = $pass; // associated password 'your*password'

// connect to ldap server

$ldapconn = ldap_connect("localhost")

    or die("Could not connect to LDAP server.");

 

if (ldap_set_option($ldapconn,LDAP_OPT_PROTOCOL_VERSION,3))

{

    echo "";//"Using LDAP v3";

}else{

    echo "Failed to set version to protocol 3";

}

 

if ($ldapconn) {

    // binding to ldap server

    $ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);

    // verify binding

    if ($ldapbind) {

      $_SESSION["authenticated"] = 1;

      $_SESSION["user"] = $name;

 

      echo  '<p>Welcome, ' . $_SESSION["user"] . '</p>';

 //    writeRe();

header("location:profile.php");
  

    } else {

      $_SESSION["authenticated"] = 0;


  
header("location:error.php");

    }

}


//*********************profiles information************


function writeRe() {


$query = "SELECT *  from profiles  WHERE Username='$name';";

         //run the query and keep results in $result variable

         $result = mysqli_query($conn, $query);

         // Check the result

         if (!$result) {

            die("Invalid query: " . mysqli_error($conn));

         }

         else {

      // echo "Successful query: " . $query . "<br />";

            //use loop to fetch records from $result

            //you can think about $result as a RECORDSET - a

            //temporary object that holds a set of records from

            // a database table

             //dispaly table headers

            echo "<table border='1'><tr><th>Profile_ID</th>
                                                              <th>FName</th>
                                                             <th>LName</th>
                                                            <th>Email</th>
<th>Service_Offered</th><th>Post_Date </th><th>Availability </th><th> Notification_Email </th>
</tr>";
            
  

            while($row = mysqli_fetch_array($result)){

                // \r\n to print each row on new line

                echo "\r\n <tr><td>{$row['Profile_ID']} </td>" .
              "   <td>{$row['First_Name']} </td>" .
                 " <td>{$row['Last_Name']} </td>" .
                  "<td>{$row['Email']} </td>" .
                  "<td>{$row['Service_Offered']} </td>" .
                   "<td>{$row['Post_Date']} </td>" .
                    "<td>{$row['Availability']} </td>" .
                    "<td>{$row['Notification_Email']} </td></tr> ";

            }

            echo "</table>";

            mysqli_free_result($result);
}



} //  did not call writeRe function.





}





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