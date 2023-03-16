<?php

//General function for API calls
function api_call(...$arguments){
    $backendURL = "127.0.0.1:8000";
    $curl = curl_init();
    $data = $arguments[0];
    unset($data["endpoint"]);
    $endpoint =  $arguments[1];
    $api_url = $backendURL.$endpoint;
    $post_data =  json_encode($data);
    switch ($arguments[2]) {
        case 'POST':
            $options = array(
                CURLOPT_URL => $api_url,
                CURLOPT_POST=>1,
                CURLOPT_POSTFIELDS => $post_data,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_HTTPHEADER => array('Content-Type: application/json')
            );
            break;
        case 'GET':
            $options = array(
                CURLOPT_URL => $api_url,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_HTTPHEADER => array('Content-Type: application/json')
            );
            break;
        case 'DELETE':
            $options = array(
                CURLOPT_URL => $api_url,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_CUSTOMREQUEST => "DELETE",
            );
            break;
        default:
            # code...
            break;
    }

    curl_setopt_array($curl,$options);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $endp = $_POST["endpoint"];
    

    switch ($endp) {
        case '/clients/clientPrestations':
            $id = $_POST["id"];
            $url = $endp."/".$id."/";
            $req = "GET";
            $response = api_call($_POST,$url,$req);
            echo $response;
            break;
        case '/employes/employeeJobs':
            $id = $_POST["id"];
            $url = $endp."/".$id."/";
            $req = "GET";
            $response = api_call($_POST,$url,$req);
            echo $response;
            break;
        case '/clients/addClient/':
            $response = api_call($_POST,$endp,'POST');
            echo $response;
            break;
        case '/clients/clientAPI-list/':
            $response = api_call($_POST,$endp,'GET');
            echo $response;
            break;
        case '/clients/clientJobsDelete':
            $id = $_POST["id"];
            $url = $endp."/".$id."/";
            $req = "DELETE";
            $reponse = api_call($_POST,$url,$req);
            echo $response;
            break;
        case '/clients/deleteClient':
            $id = $_POST["id"];
            $url = $endp."/".$id."/";
            $req = "DELETE";
            $reponse = api_call($_POST,$url,$req);
            break;
        case '/authentication/delete':
            $id = $_POST["id"];
            $role_id = $_POST["role_id"];
            $url = $endp."/".$id."/".$role_id;
            $req = "DELETE";
            $reponse = api_call($_POST,$url,$req);
            echo $response;
            break;
        case '/clients/updateClient':
            $id = $_POST["id"];
            $req = 'POST';
            $url = $endp."/".$id."/";
            $reponse = api_call($_POST,$url,$req);
            echo $reponse;
            break;
        case '/clients/clientAPI-detail':
            $id = $_POST["id"];
            $req = 'GET';
            $url = $endp."/".$id."/";
            $reponse = api_call($_POST,$url,$req);
            echo $reponse;
            break;
        case "/authentication/updateEmp/3/":
            $id = $_POST["id"];
            $req = 'POST';
            $url = $endp.$id;
            $reponse = api_call($_POST,$url,$req);
            echo $reponse;
            break;
        case "/employes/addEmploye/":
            $response = api_call($_POST,$endp,'POST');
            echo $response;
            break;
        case "/employes/employeAPI-list/":
            $response = api_call($_POST,$endp,'GET');
            echo $response;
            break;
        case '/employes/employeeDeleteJobs':
            $id = $_POST["id"];
            $url = $endp."/".$id."/";
            $req = "DELETE";
            $reponse = api_call($_POST,$url,$req);
            echo $response;
            break;
        case '/employes/deleteEmploye':
            $id = $_POST["id"];
            $url = $endp."/".$id."/";
            $req = "DELETE";
            $reponse = api_call($_POST,$url,$req);
            break;
        case '/employes/employeAPI-detail':
            $id = $_POST["id"];
            $req = 'GET';
            $url = $endp."/".$id."/";
            $reponse = api_call($_POST,$url,$req);
            echo $reponse;
            break;
        case '/employes/updateEmploye':
            $id = $_POST["id"];
            $req = 'POST';
            $url = $endp."/".$id."/";
            $reponse = api_call($_POST,$url,$req);
            echo $reponse;
            break;
        case "/authentication/updateEmp/2/":
            $id = $_POST["id"];
            $req = 'POST';
            $url = $endp.$id;
            $reponse = api_call($_POST,$url,$req);
            echo $reponse;
            break;
        case '/addPrestation':
            $url = $endp."/";
            $reponse = api_call($_POST,$url,'POST');
            echo $reponse;
            break;
        case '/prestationAPI-list/':
            $reponse = api_call($_POST,$endp,'GET');
            echo $reponse;
            break;
        case '/prestationAPI-detail':
            $id = $_POST["id"];
            $req = 'GET';
            $url = $endp."/".$id."/";
            $reponse = api_call($_POST,$url,$req);
            echo $reponse;
            break;
        case '/updatePrestation':
            $id = $_POST["id"];
            $req = 'POST';
            $url = $endp."/".$id."/";
            $reponse = api_call($_POST,$url,$req);
            echo $reponse;
            break;
        case '/deletePrestation':
            $id = $_POST["id"];
            $url = $endp."/".$id."/";
            $req = "DELETE";
            $reponse = api_call($_POST,$url,$req);
            break;
        case '/authentication/view_employees':
            $response = api_call($_POST,$endp,'GET');
            echo $response;
            break;
        case '/authentication/deleteemp/':
            $url= $endp.$_POST["id"];
            $response = api_call($_POST,$url,'DELETE');
            break;
        case '/authentication/updateManager/':
            $url = $endp.$_POST["id"];
            $response = api_call($_POST,$url,'POST');
            break;
        case '/authentication/managerDetail/':
            $url = $endp.$_POST["id"];
            $response = api_call($_POST,$url,'GET');
            echo $response;
            break;
        case '/authentication/updateManager/':
            $url = $endp.$_POST["id"];
            $response = api_call($_POST,$url,'POST');
            echo $response;
            break;
        case '/check-in/':
            $url = $endp.$_POST["id"]."/";
            $response = api_call($_POST,$url,'POST');
            echo $response;
            break;
        case '/check-out/':
            $url = $endp.$_POST["id"]."/";
            $response = api_call($_POST,$url,'POST');
            echo $response;
            break;
        case '/client-feedback/':
            $url = $endp.$_POST["id"]."/";
            $response = api_call($_POST,$url,'POST');
            echo $response;
            break;
        case '/employee-feedback/':
            $url = $endp.$_POST["id"]."/";
            $response = api_call($_POST,$url,'POST');
            echo $response;
            break;
        case '/restart-prestation/':
            $url = $endp.$_POST["id"]."/";
            $response = api_call($_POST,$url,'POST');
            echo $response;
            break;
        case '/manager-validate/':
            $url = $endp.$_POST["id"]."/";
            $response = api_call($_POST,$url,'POST');
            echo $response;
            break;
        case '/authentication/service_list/33':
            $url = $endp;
            $response = api_call($_POST,$url,'GET');
            echo $response;
            break;
        default:
            # code...
            break;
    }
}


?>