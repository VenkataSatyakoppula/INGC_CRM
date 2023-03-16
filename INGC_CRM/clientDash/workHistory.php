<?php include '../config.php';
    if($_SESSION['role']==1){
        header("location:index.php");
    }elseif ($_SESSION['role']==2) {
        header("location:empDashboard.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work History</title>
    <!-- Pignose Calender -->
    <link href="../plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="../plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="../plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">

    <!-- Custom Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../index.css?v=<?php echo time(); ?>">
</head>

<body>

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
                <a href="../clientDashboard.php">
                    <b class="logo-abbr"><img src="../images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="../images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <img src="../images/logo-text.png" alt="">

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
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">

                </div>
                <div class="header-right">

                    <div class="header-right">
                        <ul class="clearfix">

                            <li class="icons dropdown">
                                <div class="user-img c-pointer position-relative" data-toggle="dropdown" aria-expanded="false">
                                    <span class="activity active"></span>
                                    <img src="../images/user/2.png" height="40" width="40" alt="">
                                </div>
                                <div class="drop-down dropdown-profile animated fadeIn dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(5px, 57px, 0px);">
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li><span>connecté en tant que<?php echo $_SESSION["user"]; ?> </span></li>
                                            <li><a href="../logout.php"><i class="icon-key"></i> <span>Se déconnecter</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
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

                        <li class="">
                            <a class="has-arrow" href="../clientDashboard.php" aria-expanded="false">
                                <i class="fa fa-dashboard"></i><span class="nav-text">Tableau de bord clients</span>
                            </a>

                        </li>


                        <!-- <li class="">
                            <a class="has-arrow" href="../clientDash/jobsAssigned.php" aria-expanded="false">
                                <i class="fa fa-tasks"></i><span class="nav-text">Request an Employee</span>
                            </a>

                        </li> -->

                        <li class="">
                            <a class="has-arrow" href="../clientDash/workHistory.php" aria-expanded="false">
                                <i class="fa fa-history"></i><span class="nav-text">Historique des prestations</span>
                            </a>

                        </li>

                        <!-- <li class="">
                            <a class="has-arrow" href="../clientDash/clientLogs.php" aria-expanded="false">
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


        <div class="content-body" style="min-height: 876px;">

            <div class="container-fluid mt-3">

                <div class="row">
                    <div class="col-lg-12">

                        <h2>Historique des prestations</h2>

                        <div class="card">
                            <div class="card-body">
                                <div class="active-member">
                                    <div class="table-responsive">


                                        <table class="table table-xs mb-0">
                                            <thead>
                                                <tr>
                                                    <th>S.NO.</th>
                                                    <th>JOB NAME</th>
                                                    <th>ASSIGNED EMPLOYEE</th>
                                                    <th>START DATE AND TIME</th>
                                                    <th>END DATE AND TIME</th>
                                                    <th>STATUS OF THE WORK</th>

                                                </tr>
                                            </thead>

                                            <tbody id="client-workhistory">
                                                <!-- <tr>
                                                    <td>1</td>
                                                    <td>Shreya</td>
                                                    <td>2022-11-26T19:31</td>
                                                    <td>2022-12-04T19:35</td>
                                                    <td>House-Keeping</td>
                                                    <td>Completed</td>
                                                </tr>

                                                <tr>
                                                    <td>2</td>
                                                    <td>Kavya</td>
                                                    <td>2022-08-26T19:31</td>
                                                    <td>2022-12-04T19:35</td>
                                                    <td>Cleaning</td>
                                                    <td>Completed</td>
                                                </tr>

                                                <tr>
                                                    <td>3</td>
                                                    <td>Rhea</td>
                                                    <td>2022-11-26T19:31</td>
                                                    <td></td>
                                                    <td>Painting</td>
                                                    <td>Ongoing</td>
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

    <!--*********************************

   <!-**********************************
        Scripts
    ***********************************-->
    <script src="../plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>
    <script src="../js/styleSwitcher.js"></script>

    <!-- Chartjs -->
    <script src="../plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="../plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <script src="../plugins/d3v3/index.js"></script>
    <script src="../plugins/topojson/topojson.min.js"></script>
    <script src="../plugins/datamaps/datamaps.world.min.js"></script>
    <!-- Morrisjs -->
    <script src="../plugins/raphael/raphael.min.js"></script>
    <script src="../plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <script src="../plugins/chartist/js/chartist.min.js"></script>
    <script src="../plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>


<script>
    $(()=>{
        var baseUrl =  "../api-calls.php";
        var id = '<?php echo $_SESSION["ref_id"]; ?>';
        $.ajax({
            url: baseUrl,
            dataType: "json",
            type: "POST",
            async: true,
            data: { endpoint:"/clients/clientPrestations", id:id },
            success: function (data) {
            console.log(data);
                if (data){
                    var output = '';
                    var count = 1;
                    data.forEach(item => {
                        var end_date_time = new Date(item.heureDepart);
                        var start_time = new Date(item.heureArrivee)
                        var current = new Date();
                        if(end_date_time < current){
                        output += `
                        
                        <tr>
                                                        <td>${count}</td>
                                                        <td>${item.nomPrestation}</td>
                                                        <td>${item.ref_employe.nomEmploye}</td>
                                                        <td>${start_time.toLocaleString()}</td>
                                                        <td>${end_date_time.toLocaleString()}</td>
                                                        <td>${action_history(item.status)}</td>
                                                    </tr>
                        `;
                        count = count +1;
                        }
                    });
                    console.log(count);
                    if(count==1){
                        $('#client-workhistory').html("<tr><td colspan = '6'>No data found</td></tr>");
                        
                    }else{
                    $('#client-workhistory').html(output);
                    }
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
        function action_history(status) { 
                    if(status == "Pending Validation"){
                        return `<strong style="color:red">Time out</strong>`
                    }
                    if(status == "Validated and Complete" || status == "Client Validated"){
                        return `<strong style="color:green">${status}</strong>`
                    }
                    if(status == "On-Going"){
                        return `<strong style="color:red">Time out</strong>`
                    }
                    if(status == "Not Started Yet" || status == "Disputed"){
                        return `<strong style="color:red">Abandoned</strong>`

                    }

                }
    });
</script>


</body>

</html>