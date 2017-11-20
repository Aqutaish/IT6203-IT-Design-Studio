 <!DOCTYPE html>
<html>
<head>
 <title> Registration </title> 


<link href="style.css" rel="stylesheet">

 <script src="jquery.min.js"></script>
    <script>

$(document).ready(function(){

$('#search').on('change',function(){
    var searchID = $(this).val();
    if(searchID){
      $.get(
        "ajax.php",
        {search: searchID},
        function(data){
          $('#user').html(data);
         $('#city').html('<option value="">Select state first</option>');
             }
      );
    }else{
      $('#user').html('<option>Select service First</option>');
     $('#city').html('<option value="">Select state first</option>');
    }

});

$('#user').on('change',function(){
        var userID = $(this).val();
        if(userID){
               $.get(
        "ajax1.php",
        {user: userID},
        function(data){
          $('#city').html(data);
             }
      );
        }else{
            $('#city').html('<option value="">Select user first</option>'); 
        }
    });





});

    </script>

<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: white}
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

// start/resume session

session_start();

if (!isset($_SESSION['authenticated']) OR !$_SESSION['authenticated'] == 1) {

    die ("ERROR: Unauthorized access!");

}

else {

    /*  echo  '<p>Welcome, ' . $_SESSION["user"] . '</p>';*/
}
?>

   <h1>Create New Task<u></u></h1><br>
<p><strong>Select a service to see a list of providers and their availability. .</strong></p> 
<form name="form" method="post" action="">

  <fieldset id="myFieldset">
    <legend>Create New Task :</legend>


KSU NetID of the requesting user:
   <select name="ID">
  <option value="123">123 </option>
  <option value="234">234</option>
  <option value="456">456</option>
  <option value="678">678</option>
 </select> 
<br>
<br>
Service Requested :
 <select name="search" id="search">
  <option >Select a Service</option>
  <option value="1">PHP Tutoring</option>
  <option value="2">C Tutoring</option>
  <option value="3">Java Tutoring</option>
  <option value="4">Computer fixing</option>
 </select> 
<br>

<label> Task description: </label>  <textarea  id="desc" name="desc" rows="4" cols="50">  </textarea>


<br><br>

      <label>The user who are selected/assign to complete the task: </label>
       <select name="user" id="user">
        <option value="">Select a User </option>
      </select>

<br>
<br>

      <label>Task deadline : </label>

    <select name="city" id="city">
        <option value="">Select user first</option>
    </select>
    
<br>
<br>


   <input type="submit"  name ="submit" value="submit">

<br>
<br>

 

  </fieldset >

  
  <em   id="user2"></em>
</form></div>

</br>
</br>
</br>


<?php



if(isset($_POST['submit'])){


$User_NetID=$_POST["ID"];
$Service_ID=$_POST["search"];
$Task_description=$_POST["desc"];
$Profile_ID=$_POST["user"];
$Availability=$_POST["city"];

   $conn = mysqli_connect("localhost", "AQ_user", "my*password", "aqutaish")

                  or die("Cannot connect to database:" . mysqli_connect_error($conn));

//******************************************************

    // create prepared statement


    $query = mysqli_prepare($conn, "INSERT INTO Task (User_NetID, Service_ID,Task_description,Profile_ID, Availability) VALUES (?, ?,?, ?,?)")

            or die("Error: ". mysqli_error($conn));

    // bind parameters "s" - string

    mysqli_stmt_bind_param ($query,"sssss",$User_NetID ,$Service_ID ,$Task_description, $Profile_ID ,$Availability);

    //run the query mysqli_stmt_execute returns true if the

    //query was successful

    mysqli_stmt_execute($query)

        or die("Error. Could not insert into the table." . mysqli_error($conn));

    echo "<h2> <i> New record created successfully to Task table.</h2> </i>";


//***************insert************************
   // mysqli_insert_id($conn) Returns the auto generated id used

   // in the last query for current connection

 $inserted_id = mysqli_insert_id($conn);

   echo "Your data was recorded. It is entry #" .$inserted_id;


    mysqli_stmt_close($query); //for prepared stmts only






    //close connection

    mysqli_close($conn);


}


?>
</div>

    <aside>
        <!-- Sidebar -->
    </aside>
</div>



  <div id="footer"><br><br><br><br><br><br>
  </div>

</body>
</html>