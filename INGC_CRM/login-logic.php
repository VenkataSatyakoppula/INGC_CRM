<?php 

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
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
   
   
    $response = json_decode($result);  
    // print_r($response);
    $result = array($response,$httpcode);
   
 
    curl_close($curl);
    return $result;
 }


$postdata = json_encode(array(
    "email"=> $_POST["email"],
    "password"=> $_POST["password"],
 
));




$resdata = callAPI('POST','http://127.0.0.1:8000/authentication/login',$postdata);

session_start();

if ($resdata[0]->status===200) {
   // echo "<pre>" ;
   // print_r($resdata);
    
   // exit;
   
   $id= $resdata[0]->id;
   $role = $resdata[0]->role;
   $name = $resdata[0]->name;
   $ref_id = $resdata[0]->ref_id;
   
   $_SESSION['id']=$id;
   $_SESSION['role']= $role ;
   $_SESSION['name'] = $name;
   $_SESSION['ref_id'] = $ref_id;
   if($role==1){
      $_SESSION["user"] = "Manager";
   }else if($role==2){
      $_SESSION["user"] = "Employee";
   }else if($role==3){
      $_SESSION["user"] = "Client";
   }else if($role==4){
      $_SESSION["user"] = "SuperUser";
   }
   //echo $_SESSION['role'];

   // header("Location: index.php");


   if ($_SESSION['role']==1) {
      header("Location: index.php");
   }
   elseif ($_SESSION['role']==2) {
      header("Location: empDashboard.php");
     
   }
   elseif ($_SESSION['role']==3) {
      header("Location: clientDashboard.php");
   }elseif( $_SESSION['role']==4){
      header("Location: superuser.php");
   }

   exit;
   
   
 } elseif ($resdata[0]->status==401) {
   $_SESSION['invalid'] = "Invalid Password";
   header("Location: login.php");
   exit;
 } else {
   $_SESSION['invalid'] = "User doesn't exist";
   header("Location: login.php");
   exit;

  
   
 }



 


?>