<!DOCTYPE html>
<html>
<head>
 <title> Registration </title> 

<link href="style.css" rel="stylesheet">

<script type="text/javascript">
function validateForm(){


    var d = document.getElementById("id");
    var f = document.getElementById("fname");
    var l= document.getElementById("lname");
    var em= document.getElementById("email");
 
    e0= document.getElementById("m0");
    e1= document.getElementById("m");
    e2= document.getElementById("m2");
    e3= document.getElementById("m3");
   e4= document.getElementById("m4");
   e5= document.getElementById("m5");
   e6= document.getElementById("m6");
var alphaExp = /^[a-zA-Z]+$/;
var reg = /^\d+$/;

if (d.value=="" ){
         e0.innerHTML="KSU NetID must be filled out";
        d.style. borderColor= "red";
          } 

else if(!d.value.match(reg) ){
 e0.innerHTML= " KSU NetID should be only number";
     d.style. borderColor= "red";
 } 

 else if (d.value.length <' 3'){
     e0.innerHTML="KSU NetID should be at least 3 charachter";
     d.style. borderColor= "red"; 

  }
else{  e0.innerHTML="";}

//********First name validation*********             

  if (f.value=="" ){
        e1.innerHTML="First Name must be filled out";
        f.style. borderColor= "red";

    }

else if(!f.value.match(alphaExp) ){
 e1.innerHTML= " First name should be only letters";
     f.style. borderColor= "red";
 } 
  else if (f.value.length <' 3'){
            e1.innerHTML="First name should be at least 3 charachter";
           f.style. borderColor= "red";
   }

else {    e1.innerHTML=""; }
       

//********Last name validation*********             
  if (l.value== "" ){
         e2.innerHTML="Last Name must be filled out";
         l.style. borderColor= "red"; 
    }

else if(!l.value.match(alphaExp) ){
 e2.innerHTML= " last name should be only letters";
     l.style. borderColor= "red";
 } 

   else if (l.value.length <' 3'){
  e2.innerHTML="Last name should be at least 3 charachter";
  l.style. borderColor= "red"; 
   }

  else {e2.innerHTML=""; }


//***********email validation********************

  if (em.value== "" ){
         e3.innerHTML="Email must be filled out";
         em.style. borderColor= "red";
     }
   else if (em.value.length <' 3'){
         e3.innerHTML="email should be at least 3 charachter";
         em.style. borderColor= "red";
    }
    else {e3.innerHTML="";}

/**********************handler*******************/

id.addEventListener("blur", idVerify);
fname.addEventListener("blur", fnameVerify);
lname.addEventListener("blur", lnameVerify);
email.addEventListener("blur", emailVerify);

function idVerify(){

     if(id.value!=" "){
            id.style.border=" 1px solid black";
            e0.innerHTML="";
        }

}

function fnameVerify(){

     if(fname.value!=" "){
           fname.style.border="1px solid black";
           e1.innerHTML="";
       }
}

function lnameVerify(){

   if(lname.value!=" "){
         lname.style.border="1px solid black";
          e2.innerHTML="";
       }
}

function emailVerify(){

if(email.value!=" "){
       email.style.border="1px solid black";
        e3.innerHTML="";
       }
}

//*************check"***********/

  var services= document.getElementsByName('service[]');
  var dates= document.getElementsByName('date[]');
  var times= document.getElementsByName('time[]');

   var Ch= false;
  var Da= false;
 var ti=false;



for (var i = 0; i < services.length; i++)
  {
       if (services[i].checked)
       {e4.innerHTML="";
       Ch = true;
       break;
       }
}
if (Ch == false)
{
	e4.innerHTML="Please select at least one Service";
	
}

for (var i = 0; i < dates.length; i++)
{
       if (dates[i].checked)
        {e5.innerHTML="";
       Da = true;
        break;
}
}
if (Da == false)
{
	e5.innerHTML="Please select at least one date";

}



for (var i = 0; i < times.length; i++)
{
       if (times[i].checked)
        {e6.innerHTML="";
       ti = true;
        break;
}
}
if (ti == false)
{
	e6.innerHTML="Please select at least one Time";
                   return false;	
}
           return true;	


}
</script>





</head>
<body>

<header>
<br><br><br><br>

<!--header -->

    </header>

<?php include "menu.php"; ?>


<div id="content">


        <div id="mainContent">
<h3> Welcome to CSE Community </h3>
   <p>Please fill out your profile below to register the services that you can provide.</p>
<br>


<form name="form" method="post" action="registration.php">
  <fieldset id="myFieldset">
    <legend> CSE Service Registration Form :</legend>
<br>
<label > KSU NetID: </label> <input type="text"  id="id" name="id"  > <em id="m0" style="color:red" > * </em>  <br>
<label > First Name: </label> <input type="text"  id="fname" name="fname"  > <em id="m" style="color:red"> * </em>  <br>
<label > Last Name: </label> <input type="text"  id="lname" name="lname"  > <em id="m2" style="color:red"> * </em>  <br>
<label >Email: </label> <input type="email"  id="email"  name="email"   > <font id="m3" color="red"> * </font> <br>
 <input type="checkbox" name="emailconf" value="php"><font color="'b30000">would you like to receive an email confirmation? </font><br><hr>

<label > User name: </label> <input type="text" placeholder="Enter Username" id="username" name="username"  required>  <em id="m44" style="color:red"> * </em>  <br>
<label > Password: </label> <input type="password" placeholder="Enter Password" id="password" name="password" required ><em id="m55" style="color:red"> * </em>  <br>   <br>










<br>

<?php
       
        // connect to database
            $conn = new mysqli("localhost", "AQ_user",

          "my*password", "aqutaish");

      if (mysqli_connect_errno($conn)){

            echo 'Cannot connect to database: ' . mysqli_connect_error();
      }

      else{


$sql = 'select *  from Services';
$result = $conn->query($sql);

if ($result->num_rows > 0) { 
    echo "<labe><b>ServicesOffered</b>:please select all the services you will provide to the CSE community:</label></br>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo "<input  type='checkbox'  name='service[]'  value='" . "{$row['Service_ID']}" . "' />{$row['Service_DSC']}<br />";
          }
    } else {
    echo "0 results";
}
 
        mysqli_close($conn);
}
       
        ?>

<br><center> <font id="m4" color="red"> </font> </center>
<hr>

     <label> <b> Availability Date:</b> Please select the date  in which you are available to provide the selected services:

:</label>
               <input type="checkbox" name="date[]" value="Monday"> Monday <br>
               <input type="checkbox" name="date[]" value="Tuseday" > Tuseday  <br>
               <input type="checkbox" name="date[]" value="Wednesday" >Wednesday  <br>
               <input type="checkbox" name="date[]" value=" thursday" > thursday <br>
               <input type="checkbox" name="date[]" value="Friday" > Friday <br>
              <input type="checkbox" name="date[]" value="Saturday" > Saturday<br>
              <input type="checkbox" name="date[]" value="Sunday" > Sunday<br>

<br><center> <font id="m5" color="red"> </font> </center>

<hr>

    <label> <b> Availability Time:</b> Please select the time  in which you are available to provide the selected services:

:</label> <br>
               <input type="checkbox" name="time[]" value="Morning"> Morning<br>
               <input type="checkbox" name="time[]" value="noon" >noon<br>
               <input type="checkbox" name="time[]" value="afternon" >afternon <br>
               <input type="checkbox" name="time[]" value=" evening">evening<br>
<br><br><center> <font id="m6" color="red"> </font> </center>


<input type="submit" name="submit" value="Submit" onclick="return validateForm();" />
 </fieldset>
</form>

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