
<?php

session_start();


if(isset($_SESSION['id']))
{

    
}elseif(isset($_GET['eid'])){
// get employee id
}
else if(isset($_SESSION['role'])){

}
else{
    header("location: login.php");
}
?>