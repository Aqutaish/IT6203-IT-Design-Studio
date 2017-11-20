<?xml version="1.0" encoding="ISO-8859-1"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<script type="text/javascript">

    var xmlReq;

    function processResponse(){

       if(xmlReq.readyState == 4){

           var place = document.getElementById("placeholder");

           place.innerHTML = xmlReq.responseText

      }

    }

 

   function loadResponse(){

      // create an instance of XMLHttpRequest

      xmlReq = new XMLHttpRequest();

      xmlReq.onreadystatechange = processResponse;

 

      //call server_side.php

      xmlReq.open("POST", "server_search.php", true);

 

      //read value from the form

      // encodeURI is used to escaped reserved characters

      parameter = "search=" + encodeURI(document.forms["form1"].search.value);

 

      //send headers

      xmlReq.setRequestHeader("Content-type",

                  "application/x-www-form-urlencoded");

      xmlReq.setRequestHeader("Content-length", parameter.length);

      xmlReq.setRequestHeader("Connection", "close");

 

      //send request with parameters

      xmlReq.send(parameter);

      return false;

   }

</script>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Search  </title> 


<link href="style.css" rel="stylesheet">

<style type="text/css">
 
              body {font-family:Arial, Sans-Serif;}
             #search{ background-color: #F0F0F0;
  }
            #mainContent{border:1px solid black; }

  


        </style>
</head>


<body>

<header>
<br><br><br><br>

<!--header -->

    </header>

<?php include "menu.php"; ?>

<div id="search">
<div id="content">
<br>

<?php
session_start();

if (!isset($_SESSION['authenticated']) OR !$_SESSION['authenticated'] == 1) {

    die ("ERROR: Unauthorized access!");

}

else {

    /*  echo  '<p>Welcome, ' . $_SESSION["user"] . '</p>';*/

?>
  <div id="mainContent">

      <form method="POST" name="form1" action="" onsubmit="return loadResponse();">


  <p><strong>Select a service to see a list of providers and their availability. .</strong></p> 
<select   name="search">
   
  <option value="PHP Tutoring " >PHP Tutoring </option>
  <option value="C Tutoring">C Tutoring</option>
  <option value="Java Tutoring">Java Tutoring</option>
  <option value="Computer fixing">Computer fixing</option>


         <input type="submit"  name ="submit" value="Search"

             onclick="loadResponse()">

      </form>

      <div id="placeholder"></div>

</div>

</br>
</br>
<?php
}
?>


</div>

<br>
<br>
<br>
<br>
<br>
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
    if (x.className === "nav") {
        x.className += " responsive";
    } else {
        x.className = "nav";
    }
}
</script>

</body>
</html>

