<?php

if(isset($_GET['user']) && !empty($_GET['user'])){

$action =$_GET['user'];

$conn = new mysqli("localhost", "AQ_user",  "my*password", "aqutaish");

      if (mysqli_connect_errno()){

          echo 'Cannot connect to database: ' .
              mysqli_connect_error($conn);

      }

      else{


         //specify query NOTE that first ; is the end of the query

         $query = "SELECT  * FROM  profiles where Profile_ID='$action';";

         //run the query and keep results in $result variable

         $result = mysqli_query($conn, $query);




        if (!$result) {

            die("Invalid query: " . mysqli_error($conn));

         }

else{

$count=mysqli_num_rows($result);

if($count>0){

  while($row = mysqli_fetch_array($result)){


        echo "<option  value='{$row['Availability']} '> {$row['Availability']}</option>"; 

}
   
 }else{ 

   echo "<option> no User Available </option>"; 
 
}  //count

        mysqli_free_result($result);

 }


//*********************************************************
 





         mysqli_close($conn);

}


     
}// isset


?>
