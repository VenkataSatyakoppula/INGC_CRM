<?php
include "../config.php";


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une prestation</title>
    <!-- Pignose Calender -->
    <link href="../plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="../plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="../plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../index.css?v=1659091293">
    <!--Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
            <?php if($_SESSION['role']==4) {
                    $redir = "superuser.php";
                }else{
                    $redir = "index.php";
                } ?>
                <a href="../<?php echo $redir; ?>">
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
                                    <img src="../images/user/4.png" height="40" width="40" alt="">
                                </div>
                                <div class="drop-down dropdown-profile animated fadeIn dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(5px, 57px, 0px);">
                                    <div class="dropdown-content-body">
                                        <ul>
                                           <li><span>Logged in as <?php echo $_SESSION["user"]; ?> </span></li>
                                            <li><a href="../logout.php"><i class="icon-key"></i> <span>Logout</span></a></li>
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
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon-speedometer menu-icon"></i><span class="nav-text">Tableau de bord</span>
                            </a>
                            <ul aria-expanded="false" class="collapse" style="height: 0px;">
                                <li class="active"><a href="../<?php echo $redir; ?>" class="active">Acceuil 1</a></li>
                            </ul>
                        </li>

                        <li class="">
                            <a class="has-arrow" href="../Jobs/viewJob.php" aria-expanded="false">
                                <i class="fa fa-tasks"></i><span class="nav-text">Prestation</span>
                            </a>

                        </li>
                        <li class="">
                            <a class="has-arrow" href="../Jobs/jobhistory.php" aria-expanded="false">
                                <i class="fa fa-history"></i><span class="nav-text">Historique des prestations</span>
                            </a>
                        </li>

                        <li class="">
                            <a class="has-arrow" href="../Client/viewClient.php" aria-expanded="false">
                                <i class="fa fa-user"></i><span class="nav-text">Client</span>
                            </a>

                        </li>

                        <li class="">
                            <a class="has-arrow" href="../Employee/viewEmp.php" aria-expanded="false">
                                <i class="fa fa-users"></i><span class="nav-text">Employé</span>
                            </a>

                        </li>
                        <?php  if ($_SESSION['role']==4 ){?>
                        <li class="">
                            <a class="has-arrow" href="../Managers/viewManagers.php" aria-expanded="false">
                                <i class="fa fa-users"></i><span class="nav-text">Manager</span>
                            </a>
                        </li>
                         <?php }?>  

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

                <div class="w-75 col-lg-12 mx-auto mt-5">
                <span class="text-primary"><strong>Astuce : Ajoutez de nouveaux services et sélectionnez ici !!
                        </strong></span> 
                    <div class="card">

                        <div class="card-body">
                            <h4 class="card-title">A</h4>jouter une prestation
                            <div class="basic-form">
                                <form id="addjobdata" method="post">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nom de la prestation</label>
                                        <div class="col-sm-10">
                                            <!-- <input type="text" class="form-control" placeholder="Job Name" id="nomPrestation" name="nomPrestation"> -->
                                            <select id="service-list"  class="form-select form-select-sm" aria-label=".form-select-sm example" id="nomPrestation" name="nomPrestation" >

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Email de l'employé</label>
                                        <div class="col-sm-10">
                                           
                                            <select id="employee-list"  class="form-select form-select-sm" aria-label=".form-select-sm example" id="ref_employe" name="ref_employe" >

                                            </select>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Email du client</label>
                                        <div class="col-sm-10">
                                            
                                            <select id="client-list" class="form-select form-select-sm" aria-label=".form-select-sm example" id="ref_client" name="ref_client">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Feedback de l'employé</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Employee Feedback" name="commentaire" id="commentaire">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Feedback du client</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Client Feedback" name="remarque_client" id="remarque_client">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Heure de débur :</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" class="form-control" name="heureArrivee" id="heureArrivee">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Heure de fin :</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" class="form-control" name="heureDepart" id="heureDepart">
                                        </div>
                                    </div>

                                    <div class=" d-flex justify-content-between">
                                        <button type="submit" class="btn btn-dark">AJOUTER</button>

                                        <a href="./viewJob.php"><button type="button" class="btn btn-info">VOIRS LES PRESTATIONS</button></a>
                                        
                                    </div>
                                    <div id="timeoutmsg"></div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <!--**********************************
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
            <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>


            <!-- add job script starts -->

            <script>
                        var baseUrl = "../api-calls.php";

                $(() => {
                    //view employess for selection starts

                    $.ajax({
                        url: baseUrl,
                        dataType: "json",
                        type: "POST",
                        async: true,
                        data: {endpoint: "/employes/employeAPI-list/"},
                        success: function(data) {
                            console.log(data);
                            if (data) {
                                var outputEmp = '';
                                data.forEach(item => {
                                    outputEmp += `
                    
                                <select>
                                  <option value='${item.id}'>${item.emailEmploye}</option>
                                </select>

                               `;

                                });
                                $('#employee-list').html(outputEmp);
                            } else {
                                $('#employee-list').html("<select><option>No data found</option></select>");

                            }


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
                    //view emoployes for selection endds


                     //view clients for selection starts

                     $.ajax({
                        url: baseUrl,
                        dataType: "json",
                        type: "POST",
                        async: true,
                        data: {endpoint: "/clients/clientAPI-list/"},
                        success: function(data) {
                            console.log(data);
                            if (data) {
                                var outputClient = '';
                                data.forEach(item => {
                                    outputClient += `

                                <select>
                                  <option value='${item.id}'>${item.emailClient}</option>
                               </select>

                               `;
                                });
                                $('#client-list').html(outputClient);
                            } else {
                                $('#client-list').html("<select><option>No data found</option></select>");

                            }


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
                    //view clients for selection endds

                    //view services
                    $.ajax({
                        url: baseUrl,
                        dataType: "json",
                        type: "POST",
                        async: true,
                        data: {endpoint: "/authentication/service_list/33"},
                        success: function(data) {
                            console.log(data);
                            if (data) {
                                var outputClient = '';
                                data.forEach(item => {
                                    outputClient += `

                                <select>
                                  <option value='${item.SERVICE_NAME}'>${item.SERVICE_NAME}</option>
                               </select>

                               `;
                                });
                                $('#service-list').html(outputClient);
                            } else {
                                $('#service-list').html("<select><option>No data found</option></select>");

                            }


                        },
                    });

                    $('#addjobdata').submit(function(e) {
                        e.preventDefault();
                    }).validate({
                        rules:{
                            nomPrestation:{
                                required: true
                            },
                            commentaire:{
                                required: true,
                                minlength: 3
                            },
                            remarque_client:{
                                required: true,
                                minlength: 3
                            },
                            heureArrivee:{
                                required: true
                            },
                            heureDepart:{
                                required: true
                            }
                        },
                        messages:{
                            nomClient: {
                                required: "Please enter nomPrestation"
                            },
                            commentaire:{
                                required: "Please enter commentaire",
                                minlength: "commentaire must be at least 3 characters"
                            },
                            remarque_client:{
                                required: "Please enter remarque_client",
                                minlength: "remarque_client must be at least 3 characters"
                            },
                            heureArrivee:{
                                required: "Please select heureArrivee"
                            },
                            heureDepart:{
                                required: "Please select heureDepart"
                            },
                        },
                        errorPlacement: function(error, element) {
                            error.insertAfter(element).css("color","red");
                        },
                        submitHandler: function (form) { 
                        console.log('add button clicked!')
                        var fd = new FormData(form);
                        let arrive = fd.get("heureArrivee");
                        let depart = fd.get("heureDepart");
                        console.log(fd, "i am form data");
                        fd.set("heureArrivee",new Date(arrive).toISOString());
                        fd.set("heureDepart",new Date(depart).toISOString());

                        fd.append("endpoint","/addPrestation");
                        $.ajax({
                            url: baseUrl,
                            dataType: "json",
                            processData: false,
                            contentType: false,
                            type: 'POST',
                            async: true,
                            data: fd,
                            success: function(data) {
                                console.log(data, "i am the data after ajax call for adding a job is completed");
                                $('#timeoutmsg').html("Job Added Successfully");
                                setTimeout(() => {
                                    $('#timeoutmsg').html("");
                                    location.href = "./viewJob.php"
                                }, 500)
                                document.getElementById("addjobdata").reset();
                            },
                            error: function(xhr, exception) {
                                var msg = "";

                            }
                        });
                        }
                    });






                   
                });
            </script>
            <!-- add job script ends -->
</body>

</html>