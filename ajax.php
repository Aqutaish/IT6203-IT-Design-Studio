<?php

if(isset($_GET['search']) && !empty($_GET['search'])){

$action2 =$_GET['search'];
if($action2=="1")
{
$action="PHP Tutoring";
}
else if($action2=="2")
{
$action="C Tutoring";
}
else if($action2=="3")
{
$action="Java Tutoring";
}
else if($action2=="4")
{

$action="Computer fixing";
}
$conn = new mysqli("localhost", "AQ_user",  "my*password", "aqutaish");

      if (mysqli_connect_errno()){

          echo 'Cannot connect to database: ' .
              mysqli_connect_error($conn);

      }

      else{


         //specify query NOTE that first ; is the end of the query

         $query = "SELECT distinct * FROM  profiles INNER JOIN  services_provided   ON services_provided.Profile_ID= Profiles.Profile_ID
                           INNER JOIN  services   ON services.Service_ID = services_provided.Service_ID where  Service_DSC='$action';";

         //run the query and keep results in $result variable

         $result = mysqli_query($conn, $query);




        if (!$result) {

            die("Invalid query: " . mysqli_error($conn));

         }

else{

$count=mysqli_num_rows($result);

if($count>0){

  while($row = mysqli_fetch_array($result)){


        echo "<option  value='{$row['Profile_ID']} '> {$row['First_Name']} {$row['Last_Name']}</option>"; 

}
   
 }else{ 

   echo "<option>no User Available </option>"; 
 
}  //count

        mysqli_free_result($result);

 }


//*********************************************************
 





         mysqli_close($conn);

}


     
}// isset


?>

