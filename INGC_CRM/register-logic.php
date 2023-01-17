<?php 
session_start();
function callAPI($method, $url, $data){
    
    $curl = curl_init();
    switch ($method){
        case "POST":
          
          curl_setopt($curl, CURLOPT_POST, 1);
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          break;
       case "PUT":
    
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
          break;
       default:
   
          if ($data)
          
             $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept:application/json'));


    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
  
    $result = curl_exec($curl);
   
   
    $response = json_decode($result);  
   //  print_r($response);
   
 
    curl_close($curl);
    return $response;
 }


if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])){
   $postdata = json_encode(array(
      "name"=> $_POST["name"],
      "email"=> $_POST["email"],
      "password"=> $_POST["password"],
      "role" => (isset($_POST["role"]))? $_POST["role"]:1,
      "ref_id" => (isset($_POST["ref_id"]))? $_POST["ref_id"]:0,
   ));
   $resdata = callAPI('POST','http://127.0.0.1:8000/authentication/register',$postdata);
}else{
   $_SESSION["error"] = "Fill all the Fields";
}


if(isset($_SESSION["id"])){
   // echo $resdata;
   echo json_encode($resdata);
}else{
   if($resdata->status===200){
      $_SESSION["Success"] = "Registered Succesfully";
      header("Location: login.php");
      die();
   }
   else if($resdata->status===400){
      $_SESSION["error"] = $resdata->result;
      header("Location: register.php");
      die();
   }

}



 


?>