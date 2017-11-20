<?php

  if(!isset($_POST["search"]) && $_POST["search"] !== '0') die("service was not provided");

  $search= $_POST["search"];  //read what was received from the form


$conn = new mysqli("localhost", "AQ_user",  "my*password", "aqutaish");

      if (mysqli_connect_errno()){

          echo 'Cannot connect to database: ' .
              mysqli_connect_error($conn);

      }

      else{

   

         //specify query NOTE that first ; is the end of the query

         $query = "SELECT  * FROM  profiles INNER JOIN  services_provided   ON services_provided.Profile_ID= Profiles.Profile_ID
                           INNER JOIN  services   ON services.Service_ID = services_provided.Service_ID where  Service_DSC='$search';";

         //run the query and keep results in $result variable

         $result = mysqli_query($conn, $query);

         // Check the result

         if (!$result) {

            die("Invalid query: " . mysqli_error($conn));

         }

         else {
            
          

            echo "<br> <br>";
           echo"<p> <strong>Here the list of providers and their availability to  <I> " .$search. " </I>  service </strong></p>";
            //use loop to fetch records from $result


            while($row = mysqli_fetch_array($result)){

                               
                     echo "FName: {$row['First_Name']} <br />" .

                     "LName: {$row['Last_Name']} <br />" .

                     "Availability: {$row['Availability']} <br /><br />";
                      echo "<hr>";
            }

            mysqli_free_result($result);

         }

         mysqli_close($conn);

     }







?>
