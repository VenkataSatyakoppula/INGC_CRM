<?php
$fname=$lname=$age=$adress=$email=$zipcode="";

if (isset($_POST['clientData'])) {
  // var_dump($_POST);
  $fname = (isset($_POST['fName']) ? $_POST['fName'] : 'ashu');
  $lname = (isset($_POST['lName']) ? $_POST['lName'] : 'sufi');
  $age = (isset($_POST['Age']) ? $_POST['Age'] : '25');
  $adress = (isset($_POST['complementAdresseClient']) ? $_POST['complementAdresseClient'] : 'sgr');
  $email = (isset($_POST['Email']) ? $_POST['Email'] : 'as@gmail.com');
  $zipcode = (isset($_POST['Zipcode']) ? $_POST['Zipcode'] : '19002');

   


   $curl = curl_init(); 

   curl_setopt_array($curl, array(
     CURLOPT_URL => 'http://127.0.0.1:8000/clients/addClient/',
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => '',
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 0,
     CURLOPT_FOLLOWLOCATION => true,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => 'POST',
     CURLOPT_POSTFIELDS =>' {
           
        "prenomClient": "'.$fname.'",
        "nomClient": "'.$lname.'",
        "ageClient": "'.$age.'",
        "emailClient": "'.$email.'",
        "complementAdresseClient": "'.$adress.'",
        "cpClient": "'.$zipcode.'"
    }',
     CURLOPT_HTTPHEADER => array(
       'Content-Type: application/json'
     ),
   ));
   
   $response = curl_exec($curl);
   
   curl_close($curl);
   echo $response;
   


}




?>