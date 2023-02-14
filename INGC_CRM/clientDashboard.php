<?php include 'config.php';
    if($_SESSION['role']==1){
        header("location:index.php");
    }elseif ($_SESSION['role']==2) {
        header("location:empDashboard.php");
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Tableau de bord Client</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Pignose Calender -->
    <link href="./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="./plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css?v=<?php echo time(); ?>">


    <style type="text/css">
        /* Chart.js */
        @-webkit-keyframes chartjs-render-animation {
            from {
                opacity: 0.99
            }

            to {
                opacity: 1
            }
        }

        @keyframes chartjs-render-animation {
            from {
                opacity: 0.99
            }

            to {
                opacity: 1
            }
        }

        .chartjs-render-monitor {
            -webkit-animation: chartjs-render-animation 0.001s;
            animation: chartjs-render-animation 0.001s;
        }
    </style>
    <style class="datamaps-style-block">
        .datamap path.datamaps-graticule {
            fill: none;
            stroke: #777;
            stroke-width: 0.5px;
            stroke-opacity: .5;
            pointer-events: none;
        }

        .datamap .labels {
            pointer-events: none;
        }

        .datamap path:not(.datamaps-arc),
        .datamap circle,
        .datamap line {
            stroke: #FFFFFF;
            vector-effect: non-scaling-stroke;
            stroke-width: 1px;
        }

        .datamaps-legend dt,
        .datamaps-legend dd {
            float: left;
            margin: 0 3px 0 0;
        }

        .datamaps-legend dd {
            width: 20px;
            margin-right: 6px;
            border-radius: 3px;
        }

        .datamaps-legend {
            padding-bottom: 20px;
            z-index: 1001;
            position: absolute;
            left: 4px;
            font-size: 12px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .datamaps-hoverover {
            display: none;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .hoverinfo {
            padding: 4px;
            border-radius: 1px;
            background-color: #FFF;
            box-shadow: 1px 1px 5px #CCC;
            font-size: 12px;
            border: 1px solid #CCC;
        }

        .hoverinfo hr {
            border: 1px dotted #CCC;
        }
    </style>
</head>

<body data-theme-version="light" data-layout="vertical" data-nav-headerbg="color_1" data-headerbg="color_1" data-sidebar-style="full" data-sibebarbg="color_1" data-sidebar-position="static" data-header-position="static" data-container="wide" direction="ltr">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader" style="display: none;">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10"></circle>
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper" class="show menu-toggle">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="clientDashboard.php">
                    <b class="logo-abbr"><img src="images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="./images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <img src="images/logo-text.png" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger is-active">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">

                </div>

                <div class="header-right">
                    <ul class="clearfix">


                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown" aria-expanded="false">
                                <span class="activity active"></span>
                                <img src="images/user/1.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(5px, 57px, 0px);">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><span>Connecté en tant que <?php echo $_SESSION["user"]; ?> </span></li>
                                        <li><a href="logout.php"><i class="icon-key"></i> <span>Se déconnecter</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
                <div class="nk-nav-scroll active" style="overflow: hidden; width: auto; height: 100%;">
                    <ul class="metismenu in" id="menu">
                        <li class="nav-label">Tableau de bord</li>



                        <!-- <li class="">
                            <a class="has-arrow" href="./clientDash/jobsAssigned.php" aria-expanded="false">
                                <i class="fa fa-tasks"></i><span class="nav-text">Jobs Assigned</span>
                            </a>

                        </li> -->

                        <li class="">
                            <a class="has-arrow" href="./clientDash/workHistory.php" aria-expanded="false">
                                <i class="fa fa-history"></i><span class="nav-text">Historique des prestations</span>
                            </a>

                        </li>

                        <!-- <li class="">
                            <a class="has-arrow" href="./clientDash/clientLogs.php" aria-expanded="false">
                                <i class="fa fa-list"></i><span class="nav-text">Request List</span>
                            </a>

                        </li> -->



                    </ul>
                </div>
                <div class="slimScrollBar" style="background: transparent; width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 860px;"></div>
                <div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->

        <?php
        function callAPI($method, $url, $data)
        {

            $curl = curl_init();
            switch ($method) {
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


            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            // EXECUTE:

            $result = curl_exec($curl);


            $response = json_decode($result);
            // print_r($response);



            curl_close($curl);
            return $response;
        }
        ?>
        <div id="Validate-modal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">
                            <i class="material-icons">&#xE5CD;</i>
                        </div>
                        <h4 class="modal-title">Validate Work</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="client-feedback">
                        <div id="form1">
                                <div class="modal-update-body">

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label my-1">Commentaire</label>
                                        <div class="col-sm-10">
                                            <textarea name="clientcommentaire" id="clientcommentaire" cols="60" rows="10" required></textarea>
                                        </div>
                                    </div>
                                </div>
                         </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-success" value="VALIDATE" data-id="" id="btnValidateYes"></input>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="dispute-modal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Dispute Work (Cannot Edit again)</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="dispute-feedback">
                        <div id="form1">
                                <div class="modal-update-body">

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label my-1">Commentaire </label>
                                        <div class="col-sm-10">
                                            <textarea name="clientcommentaire" id="clientcommentaire" cols="60" rows="10" required></textarea>
                                        </div>
                                    </div>
                                </div>
                         </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-danger" value="RESTART WORK" data-id="" id="btnDisputeYes"></input>

                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="content-body" style="min-height: 876px;">

            <div class="container-fluid mt-3">
                <h1>Hello Client,&nbsp <?php echo $_SESSION['name']; ?>!</h1>
                <div class="row">
                    <div class="col-lg-12">

                        <h2>Prestation en cours</h2>

                        <div class="card">
                            <div class="card-body">
                                <div class="active-member">
                                    <div class="table-responsive">


                                        <table class="table table-xs mb-0">
                                            <thead>
                                                <tr>
                                                    <th>S.NO.</th>
                                                    <th>NOM DE LA PRESTATION </th>
                                                    <th>NOM DE L'EMPLOYE</th>
                                                    <th>HEURE DE DEBUT</th>
                                                    <th>HEURE DE FIN</th>
                                                    <th>STATUS DE LA PRESTATION</th>
                                                    <th>EMPLOYEE FEEDBACK</th>
                                                    <th>YOUR FEEDBACK</th>
                                                    <th>VALIDATE</th>
                                                </tr>
                                            </thead>

                                            <tbody id="viewClientjobs">

                                                <!-- <tr>
                                                    <td>1</td>
                                                    <td>House-Keeping</td>
                                                    <td>Shreya</td>
                                                    <td>2022-11-26T19:31</td>
                                                    <td></td>
                                                    <td>In Progress</td>
                                                </tr>

                                                <tr>
                                                    <td>2</td>
                                                    <td>Cleaning</td>
                                                    <td>Kavya</td>
                                                    <td>2022-08-26T19:31</td>
                                                    <td></td>
                                                    <td>In Progress</td>
                                                </tr>

                                                <tr>
                                                    <td>3</td>
                                                    <td>Planting Flowers</td>
                                                    <td>Rhea</td>
                                                    <td>2022-11-26T19:31</td>
                                                    <td></td>
                                                    <td>In Progress</td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

    <!-- Chartjs -->
    <script src="./plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="./plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <script src="./plugins/d3v3/index.js"></script>
    <script src="./plugins/topojson/topojson.min.js"></script>
    <script src="./plugins/datamaps/datamaps.world.min.js"></script>
    <!-- Morrisjs -->
    <script src="./plugins/raphael/raphael.min.js"></script>
    <script src="./plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="./plugins/moment/moment.min.js"></script>
    <script src="./plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <script src="./plugins/chartist/js/chartist.min.js"></script>
    <script src="./plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>



<script>

$(()=>{
    var baseUrl =  "api-calls.php";
     var id = '<?php echo $_SESSION["ref_id"]; ?>';
    $.ajax({
        url: baseUrl,
        dataType: "json",
        type: "POST",
        async: true,
        data: { endpoint: `/clients/clientPrestations`,id:id },
        success: function (data) {
            if(typeof data != 'object'){
                location.href = "./logout.php"
            }
            if (data){
                var output = '';
                var count = 1;
                data.forEach(item => {
                    var end_date_time = new Date(item.heureDepart);
                    var start_time = new Date(item.heureArrivee)
                    var current = new Date();
                    if(end_date_time > current){
                    output += `
                    
                    <tr>
                                                    <td>${count}</td>
                                                    <td>${item.nomPrestation}</td>
                                                    <td>${item.ref_employe.nomEmploye}</td>
                                                    <td>${start_time.toLocaleString()}</td>
                                                    <td>${end_date_time.toLocaleString()}</td>
                                                    <td id="status${item.status}">${validate(item.status,item.id,item.checkin_time,"status")}</td>
                                                    <td>${item.commentaire}</td>
                                                    <td>${item.clientcommentaire}</td>
                                                    <td id="validate_row${item.id}">${validate(item.status,item.id,item.checkin_time,"action")}</td>
                                                </tr>
                    `;
                    count = count +1;
                    }
                });
                if(count==1){
                    $('#viewClientjobs').html("<tr><td colspan = '6'>All Jobs Completed , Check Work History!!</td></tr>");              
                }else{
                    $('#viewClientjobs').html(output);
                }
            }
else{
    $('#viewClientjobs').html("<tr><td colspan = '6'>No data found</td></tr>");
    
}
        },
        error: function (xhr, exception) {
            var msg = "";
            if (xhr.status === 0) {
                msg = "Not connect.\n Verify Network." + xhr.responseText;
            } else if (xhr.status == 404) {
                msg = "Requested page not found. [404]" + xhr.responseText;
            } else if (xhr.status == 500) {
                msg = "Internal Server Error [500]." +  xhr.responseText;
            } else if (exception === "parsererror") {
                msg = "Requested JSON parse failed.";
            } else if (exception === "timeout") {
                msg = "Time out error." + xhr.responseText;
            } else if (exception === "abort") {
                msg = "Ajax request aborted.";
            } else {
                msg = "Error:" + xhr.status + " " + xhr.responseText;
            }
           
        }
    });
    function validate(status,user_id,checkin,flag) {
        if(status == "Pending Validation" ){
            if(flag == "status"){
                return `<strong style="color:blue">${status}</strong>`
            }else{
                return `<button class="btn btn-success validate" data-id=${user_id}>VALIDATE</button><button class="m-2 btn btn-danger dispute" data-id=${user_id}>DISPUTE</button>`
            }
        }else if(status == "Not Started Yet" || status == "Disputed"){
            if(flag == "status"){
                if(status == "Disputed"){
                    return `<strong style="color:red">${status}</strong>`
                }else{
                    return `<strong style="color:#9C3587">${status}</strong>`
                }
            }else{
                return `Employee Not Cheked in yet`
            }
        }else if(status == "On-Going"){
            if(flag== "status"){
                return `<strong style="color:#8B8000">${status}</strong>`
            }else{
                let check_in = new Date(checkin)
                return `<strong>Employee Checked in at: ${check_in.toLocaleString()}</strong>`
            }
        }else if(status == "Validated"){
            $("#status"+user_id).text(status).css("color","green")
            if(flag == "status"){
                return `<strong style="color:green">${status}</strong>`
            }else{
                return `<button class="btn btn-warning validate" data-id=${user_id}>Edit</button>`
            }
        }
    }

    $(document).on('click',".validate",function(){
        let id = $(this).attr("data-id");
        $("#btnValidateYes").attr("data-id",id);
        
        $("#Validate-modal").modal("show");
    });

    $(document).on('click',".dispute",function(){
        let id = $(this).attr("data-id");
        $("#btnDisputeYes").attr("data-id",id);
        
        $("#dispute-modal").modal("show");
    });

    $("#client-feedback").submit(function (e) { 
        e.preventDefault()
        var fd = new FormData(this);
        console.log("hello")
        let uid = $("#btnValidateYes").attr("data-id");
        fd.append("endpoint","/client-feedback/");
        fd.append("id",uid);
        console.log(uid)
        $.ajax({
            url: baseUrl,
            dataType: "json",
            processData: false,
            contentType: false,
            type: 'POST',
            async: true,
            data: fd,
            success: function(data) {
                console.log(data, "i am the data after update job is completed");
                console.log("update is done");
                $('#Validate-modal').modal('hide');
                $("#validate_row"+uid).html(`<button class="btn btn-warning validate" data-id=${uid}>Edit</button>`);
                setTimeout(() => {
                    $('#timeoutmsg').html("");
                    window.location.reload();
                }, 500)
            },
            error: function(xhr, exception) {
                var msg = "";
                if (xhr.status === 0) {
                    msg = "Not connect.\n Verify Network." + xhr.responseText;
                } else if (xhr.status == 404) {
                    msg = "Requested page not found. [404]" + xhr.responseText;
                } else if (xhr.status == 500) {
                    msg = "Internal Server Error [500]." + xhr.responseText;
                } else if (exception === "parsererror") {
                    msg = "Requested JSON parse failed.";
                } else if (exception === "timeout") {
                    msg = "Time out error." + xhr.responseText;
                } else if (exception === "abort") {
                    msg = "Ajax request aborted.";
                } else {
                    msg = "Error:" + xhr.status + " " + xhr.responseText;
                }
            }
        });
    });

    $("#dispute-feedback").submit(function (e) { 
        e.preventDefault()
        var fd = new FormData(this);
        let uid = $("#btnDisputeYes").attr("data-id");
        fd.append("endpoint","/restart-prestation/");
        fd.append("id",uid);
        $.ajax({
            url: baseUrl,
            dataType: "json",
            processData: false,
            contentType: false,
            type: 'POST',
            async: true,
            data: fd,
            success: function(data) {
                console.log(data, "i am the data after update job is completed");
                console.log("update is done");
                $('#Validate-modal').modal('hide');
                $("#validate_row"+uid).html(`Employee Not Cheked in yet`);

                setTimeout(() => {
                    $('#timeoutmsg').html("");
                    window.location.reload();
                }, 500)
            },
        });
    });




    
});
</script>

</body>

</html>