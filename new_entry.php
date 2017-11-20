
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
      ELSE
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

//*******************************************
if ($chkError == FALSE)
{

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

