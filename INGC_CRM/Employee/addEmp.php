<?php
include "../config.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Employés</title>
    <!-- Pignose Calender -->
    <link href="../plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="../plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="../plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../index.css?v=1659091293">
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
                                    <img src="../images/user/2.png" height="40" width="40" alt="">
                                </div>
                                <div class="drop-down dropdown-profile animated fadeIn dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(5px, 57px, 0px);">
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li><span>connecté en tant que <?php echo $_SESSION["user"]; ?> </span></li>
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
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon-speedometer menu-icon"></i><span class="nav-text">Tableau de bord</span>
                            </a>
                            <ul aria-expanded="false" class="collapse" style="height: 0px;">
                                <li class="active"><a href="../<?php echo $redir; ?>" class="active">Acceuil 1</a></li>
                            </ul>
                        </li>

                        <li class="">
                            <a class="has-arrow" href="../Jobs/viewJob.php" aria-expanded="false">
                                <i class="fa fa-tasks"></i><span class="nav-text">Prestations</span>
                            </a>
                          
                        </li>
                        <li class="">
                            <a class="has-arrow" href="../Jobs/jobhistory.php" aria-expanded="false">
                                <i class="fa fa-history"></i><span class="nav-text">Historique des prestations</span>
                            </a>
                        </li>

                        <li class="">
                            <a class="has-arrow" href="../Client/viewClient.php" aria-expanded="false">
                                <i class="fa fa-user"></i><span class="nav-text">Clients</span>
                            </a>
                          
                        </li>

                        <li class="">
                            <a class="has-arrow" href="../Employee/viewEmp.php" aria-expanded="false">
                                <i class="fa fa-users"></i><span class="nav-text">Employés</span>
                            </a>
                          
                        </li>
                        <?php  if ($_SESSION['role']==4 ){?>
                        <li class="">
                            <a class="has-arrow" href="../Managers/viewManagers.php" aria-expanded="false">
                                <i class="fa fa-users"></i><span class="nav-text">Managers</span>
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
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ajouter Employés</h4>
                            <div class="basic-form">
                                <form id="addemployeedata" method="post">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Prénom</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="First Name" id="prenomEmploye" name="prenomEmploye">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nom de famille</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Last Name" id="nomEmploye" name="nomEmploye">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Numéro de téléphone</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Enter Your Phone Number" id="telEmploye" name="telEmploye">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Adresse</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Address" name="addressEmploye"  id="addressEmploye">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">E-mail</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" placeholder="E-mail" id="emailEmploye" name="emailEmploye">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Mot de passe</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" placeholder="Password" id="mdpEmploye" name="mdpEmploye">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Code postal de l'employé</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Employee Postal Code" id="cpEmployee" name="cpEmployee" id="zipcode">
                                        </div>
                                    </div>

                                    <div class=" d-flex justify-content-between">
                                        <button type="submit" class="btn btn-dark">AJOUTER</button>

                                        <a href="./viewEmp.php"><button type="button" class="btn btn-info">VOIR EMPLOYES</button></a> 
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
            <script src=".../plugins/chart.js/Chart.bundle.min.js"></script>
            <!-- Circle progress -->
            <script src=".../plugins/circle-progress/circle-progress.min.js"></script>
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

            <!-- add employee script starts -->

            <script>
                $(() => {
                    $('#addemployeedata').submit(function(e) {
                        e.preventDefault();
                    }).validate({
                        rules: {
                            prenomEmploye: {
                                required: true,
                                minlength: 3
                            },
                            nomEmploye: {
                                required: true,
                                minlength: 3
                            },
                            telEmploye: {
                                required: true,
                                minlength: 5,
                            },
                            addressEmploye: {
                                required: true
                            },
                            emailEmploye: {
                                required: true,
                                email: true
                            },
                            mdpEmploye: {
                                required: true,
                                minlength: 5
                            },
                            cpEmployee: {
                                required: true,
                                minlength: 3,
                            }
                            },
                            messages: {
                            prenomEmploye: {
                                required: "Please enter your first name",
                                minlength: "Your first name must be at least 3 characters"
                            },
                            nomEmploye: {
                                required: "Please enter your last name",
                                minlength: "Your last name must be at least 3 characters"
                            },
                            telEmploye: {
                                required: "Please enter your phone number",
                                minlength: "Your phone number must be 5 digits"
                            },
                            addressEmploye: {
                                required: "Please enter your address"
                            },
                            emailEmploye: {
                                required: "Please enter your email address",
                                email: "Please enter a valid email address"
                            },
                            mdpEmploye: {
                                required: "Please enter a password",
                                minlength: "Your password must be at least 5 characters"
                            },
                            cpEmployee: {
                                required: "Please enter your zip code",
                                minlength: "Your zip code must be 3 digits"
                            }
                        },
                        errorPlacement: function(error, element) {
                            error.insertAfter(element).css("color","red");
                        },
                        submitHandler: function(form) {
                            console.log('add button clicked!')
                            var fd = new FormData(form);
                            console.log(fd.get("prenomEmploye") , "i am form data");
                            var baseUrl = "../api-calls.php";
                            fd.append("endpoint","/employes/addEmploye/");
                            $.ajax({
                                url: baseUrl,
                                dataType: "json",
                                processData: false,
                                contentType: false,
                                type: 'POST',
                                async: true,
                                data: fd,
                                success: function(data) {
                                    if(typeof data !== 'object' && data !== null){
                                        $('#timeoutmsg').html("Email already Exists, please try again").css("color","red");
                                    }else{
                                        console.log(data , "i am the data after ajax call is completed");
                                        $.ajax({
                                            type: "POST",
                                            url: "../register-logic.php",
                                            data: {
                                                name:data["prenomEmploye"],
                                                email:data["emailEmploye"],
                                                password:fd.get("mdpEmploye"),
                                                role:2,
                                                ref_id:data["id"]
                                            },
                                            dataType: 'json',
                                            success: function (data) {
                                                console.log("success");
                                            },
                                            
                                        });
                                        $('#timeoutmsg').html("Employee Added Successfully");
                                        setTimeout(()=>{
                                            location.href = "./viewEmp.php"
                                        }, 1000)
                                        document.getElementById("addemployeedata").reset();
                                }
                                },
                                error: function(xhr, exception) {
                                    var msg = "";
                                }
                            });
                        }
                    });
                });
            </script>
            <!-- add employee script ends -->
</body>

</html>