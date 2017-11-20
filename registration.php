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
   <h1><u></u></h1><br>

<?php

main();

function main(){

global $ser; $chkError; $msg=""; $error=""; $services=" "; $dates=" ";$times=" ";$FName=" ";$LName=" ";$Email=" " ;
$pr=" ";

if(isset($_POST['submit'])){
    $chkError = FALSE;


     if (empty($_POST["id"])) {    
	$chkError = TRUE;
	$error.= "<li> NetID is Missing. </li>";
	
         } 
  else if (strlen($_POST["id"]) < 3 )
   {
       $chkError = TRUE;
       $error.="<li> NetID should be at least 3 charachter. </li>";

    }
      ELSE
       {
            $ID = filter_input(INPUT_POST, "id");
      }

   //********************************
     if (empty($_POST["fname"])) {    
	$chkError = TRUE;
	$error.= "<li> First Name is Missing. </li>";	
         } 
  else if (strlen($_POST["fname"]) < 3 )
     {     $chkError = TRUE;
            $error.="<li> First Name should be at least 3 charachter. </li>";

    }
      else
      { 
           $FName = filter_input(INPUT_POST, "fname");
      }

//**********************************
     if (empty($_POST["lname"])) {    
	$chkError = TRUE;
	$error.= "<li>Last Name is Missing. </li>";	
         }

         else if (strlen($_POST["lname"]) < 3 )
       {    $chkError = TRUE;
            $error.="<li> Last Name should be at least 3 charachter. </li>";

      }

      ELSE
       {
            $LName = filter_input(INPUT_POST, "lname");
      }
//*********************************
         if (empty($_POST["email"])) {    
	$chkError = TRUE;
	$error.= "<li>Email is Missing. </li>";	
         }
      
      ELSE
       {
            $Email= filter_input(INPUT_POST, "email");
      }

//********************************

  if (empty($_POST["emailconf"])) {    
$msg ="No";
$msg2 =" email confirmation checkbox was not selected";
         }      
 else
   {  $Emailconf = $_POST["emailconf"];

   //send confirmation email

     $to = $Emailconf ;

     $subject = "Registration";

     $body = $msg;

     if (mail($to, $subject, $body)) {

 $msg ="Yes" ;
$msg2="Confirmation email message successfully sent! ";
 
    } else {

     $msg ="No";

     }

}

//********************************************

 if(!empty($_POST['service'])){

$services = implode(", ", $_POST['service']);

}
else {
	$chkError = TRUE;
	$error.= "<li>No Services were selected .</li>";	
}



//**************************************
if(!empty($_POST['date'])){
$dates = implode(", ", $_POST['date']);

}
else {
	$chkError = TRUE;
	$error.= "<li>No dates were selected. </li>";	

}
//*************************************	
if(!empty($_POST['time'])){
$times = implode(", ", $_POST['time']);

}
else {
	$chkError = TRUE;
	$error.= "<li>No times were selected .</li>";	

}

$availability = $dates.",".$times;

//*******************************************

         if (empty($_POST["username"])) {    
	$chkError = TRUE;
	$error.= "<li>Username is Missing. </li>";	
         }
      
      ELSE
       {
            $UserN= filter_input(INPUT_POST, "username");
      }
//***********************************
         if (empty($_POST["password"])) {    
	$chkError = TRUE;
	$error.= "<li>Password is Missing. </li>";	
         }
      
      ELSE
       {
            $Pass= filter_input(INPUT_POST, "password");
      }


//**************************************

if ($chkError == FALSE)
{

$conn = mysqli_connect("localhost", "AQ_user", "my*password", "aqutaish")

                  or die("Cannot connect to database:" . mysqli_connect_error($conn));

    // mysqli_prepare for insert :

    $query = mysqli_prepare($conn, "INSERT INTO Profiles (NetID, First_Name, Last_Name, email,Service_Offered,Availability, Notification_Email,Username,Password) VALUES (?, ?,?, ?,?,?,?,?,?)")

            or die("Error: ". mysqli_error($conn));

    //  mysqli_stmt_bind_param "s" - string


    mysqli_stmt_bind_param ($query,"sssssssss",$ID, $FName ,$LName ,$Email ,$services, $availability ,$msg,$UserN,$Pass);

    // mysqli_stmt_execute for insert , run the query mysqli_stmt_execute returns true if the

    //query was successful

    mysqli_stmt_execute($query)

        or die("Error. Could not insert into the table." . mysqli_error($conn));

   $pr.=" <h2> <i> New record created successfully to profiles table.</i></h2>";


//*******************profile_ID***********

 $inserted_id = mysqli_insert_id($conn);

     $pr.= "<h2> <i>Your data was recorded. It is entry #" .$inserted_id."</i></h2>";


    mysqli_stmt_close($query); //for prepared stmts only


//************Service_DSC*************

$sarr= " "; 
$sarr =$_POST['service'];
$arrlength = count($sarr);

for($x = 0; $x < $arrlength; $x++) {

   $sql = "SELECT Service_DSC FROM services WHERE Service_ID ='$sarr[$x];' ";

  $result = $conn->query($sql); 

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
         $ser .= ",";
        $ser .= $row["Service_DSC"];
    }

} else {
    echo "0 results";
}

}

$ser= ltrim($ser," , ");

//*************************************************

print <<<HERE

<h2><I> Thank you for registering with our website. Your Information Was Submitted Successfully :</I> </h2>

<br><div id="box">
<h3> <I><U> review information :-</h3> </I></U>
<p> First name  :            $FName   </p>
<p> Last name :            $LName   </p>
<p> Email :                     $Email   </p>
<p> <b> $msg2  </font> </b>
<p>  The Following Services were selected :         $ser</p>
<p>  The Following dates were selected :              $dates</p>
<p>  The Following times were selected :              $times</p><br></div>
HERE;






//**********************Service_ID**************

$count=0;
$SArray = explode(',', $services);
foreach($SArray as $S_Array){

$query1= mysqli_prepare($conn, "INSERT INTO services_provided (Service_ID,Profile_ID) VALUES (?,?)")

            or die("Error: ". mysqli_error($conn));

    // bind parameters "s" - string

    mysqli_stmt_bind_param ($query1,"ss",$S_Array, $inserted_id);

    //run the query mysqli_stmt_execute returns true if the

    //query was successful

    mysqli_stmt_execute($query1)

        or die("Error. Could not insert into the table." . mysqli_error($conn));
       $count++;


    mysqli_stmt_close($query1); //for prepared stmts only



}
   $pr.= "<h2> <i>" .$count. " New record created successfully to services_provided table.</h2> </i>";




echo $pr;
//***************************

function writeRe() {


$query = "SELECT *  from profiles  WHERE Profile_ID='$inserted_id';";

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



//***************************


    //close connection

    mysqli_close($conn);

//*********************create new entry
//what entry we want to add

//IF you execute this code more than once, you will get an

//error message: add failed - record already exists

//as a home assignment, you will add form that will collect

//new record information from user and pass it to this //script for insertion


$username =$_POST["username"];

$password = $_POST["password"];

$firstname = $FName;

$lastname =  $LName;

$email =$Email;

 

// connect to ldap server

$ldapconn = ldap_connect("localhost")

or die("Could not connect to LDAP server.");

 

// use OpenDJ version V3 protocol

if (ldap_set_option($ldapconn,LDAP_OPT_PROTOCOL_VERSION,3)){

   echo "<p>Using LDAP v3</p>";

} // end if

else {

   echo "<p>Failed to set version to protocol 3</p>";

} // end else

 

//administrator credentials in order to add new entries

$ldaprdn = "cn=manager,dc=designstudio1,dc=com";

$ldappass = "my*password"; // associated password

 

if ($ldapconn) {

    // binding to ldap server

    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

   

    // verify binding

   if ($ldapbind) {

      echo "<p>LDAP bind successful...</p>";

      //create new record

      $ldaprecord['givenName'] = $firstname;

      $ldaprecord['sn'] = $lastname;

      $ldaprecord['cn'] = $username;

      $ldaprecord['objectclass'][0] = "top";

      $ldaprecord['objectclass'][1] = "person";

      $ldaprecord['objectclass'][2] = "inetOrgPerson";

      $ldaprecord['userPassword'] = $password;

      $ldaprecord['mail'] = $email;

      //add new record

      if (ldap_add($ldapconn, "cn=" . $username .

         ",dc=designstudio1,dc=com", $ldaprecord)){

          $msg = "Thank you <b>" . $firstname . " " .

             $lastname . "</b> for registering on our" .

                " website.";

          //display thank you message on the website

          echo $msg;

         

      } // end if

      else {

          echo "Error #: " . ldap_errno($ldapconn) . "<br />\n";

          echo "Error: " . ldap_error($ldapconn) . "<br />\n";

          echo("<p>Failed to register you! (add error)</p>");

      }

   } // end if

   else {

      echo("<p>Failed to register you! (bind error)</p>");

   } // end else

   //close ldap connection VERY IMPORTANT

   ldap_close($ldapconn);

} //end if

else {

     echo("<p>Failed to register you! (no ldap server) </p>");

} //end else




















}


ELSE
{
echo " <h2><I> <font color='#b30000'> Error : ' you did not enter or select all information.
<b> please </b> go back to the registration form and complete all  your information. ' </font></I> </h2> <BR>";
}



if (!$error=="")
{
echo "   <div id='box2'> <h3> <I><U> Missing information:</U> </h3>  $error <br> </I> </div> ";

}


}



}



?>
<br>

</div>
    <aside>
        <!-- Sidebar -->
    </aside>
</div>



  <div id="footer"><br><br><br><br><br><br>
  </div>

</body>
</html>