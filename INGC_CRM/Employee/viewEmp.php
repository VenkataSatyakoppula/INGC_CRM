<?php
include "../config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Detail</title>
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
                        <li class="nav-label">Dashboard</li>
                        <li class="">
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                            </a>
                            <ul aria-expanded="false" class="collapse" style="height: 0px;">
                                <li class="active"><a href="../<?php echo $redir; ?>" class="active">Home 1</a></li>
                            </ul>
                        </li>

                        <li class="">
                            <a class="has-arrow" href="../Jobs/viewJob.php" aria-expanded="false">
                                <i class="fa fa-tasks"></i><span class="nav-text">Jobs</span>
                            </a>

                        </li>

                        <li class="">
                            <a class="has-arrow" href="../Jobs/jobhistory.php" aria-expanded="false">
                                <i class="fa fa-history"></i><span class="nav-text">Jobs History</span>
                            </a>
                        </li>

                        <li class="">
                            <a class="has-arrow" href="../Client/viewClient.php" aria-expanded="false">
                                <i class="fa fa-user"></i><span class="nav-text">Client</span>
                            </a>

                        </li>

                        <li class="">
                            <a class="has-arrow" href="../Employee/viewEmp.php" aria-expanded="false">
                                <i class="fa fa-users"></i><span class="nav-text">Employee</span>
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
           <!-- update modal starts -->



           <div class="modal fade" id="myUpdateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Update</h4>
                    </div>

                    <div class="modal-body">
                        <form id="updateformofEmployedata" method="post">
                            <div id="form1" action="" >
                                <div class="modal-update-body">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">First Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="First Name" name="prenomEmploye">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Last Name</label>
                                        <div class="col-sm-10">
                                        <input type="text" placeholder="Last Name" class="form-control" name="nomEmploye">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Telephone</label>
                                        <div class="col-sm-10">
                                        <input type="text" placeholder="Phone No" class="form-control" name="telEmploye">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Address" name="addressEmploye">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" placeholder="Email" name="emailEmploye">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Pincode</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="cpEmployee" name="cpEmployee">
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <input id="submit" type="submit" value="UPDATE" update-id="" class="btn btn-dark afterupdate" />

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- update modal ends --> 

        <h1 class="job-heading">VIEW EMPLOYEES</h1>

        <div class="content-body" style="min-height: 876px;">

            <div class="container-fluid mt-3 job-data">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card ">
                            <div class="card-body">
                                <div class="active-member">
                                    <div class="table-responsive">


                                        <table class="table table-xs mb-0">
                                            <thead>
                                                <tr>
                                                    <th> FIRST NAME</th>
                                                    <th>LAST NAME</th>
                                                    <th>TELEPHONE</th>
                                                    <th>ADDRESS</th>
                                                    <th>E-MAIL</th>
                                                    <th>EMPLOYEE ID</th>
                                                    <th>MODIFY</th>
                                                    <th>DELETE</th>




                                                </tr>
                                            </thead>


                                            <tbody id="employee-list">


                                            </tbody>
                                        </table>

                                        <a href="./addEmp.php">
                                            <button type="button" class="btn btn-primary">ADD EMPLOYEE</button>
                                        </a>
                                    </div>


                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

         <!-- delete modal data -->
         <div id="myDeleteModal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">
                            <i class="material-icons">&#xE5CD;</i>
                        </div>
                        <h4 class="modal-title">Are you sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Do you really want to delete these employee records? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" data-id="" id="btnDelteYes">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- delete modal data ends-->
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

        <script>
            $(() => {
                var baseUrl = "../api-calls.php";
                $.ajax({
                    url: baseUrl,
                    dataType: "json",
                    type: "POST",
                    async: true,
                    data: {endpoint:"/employes/employeAPI-list/"},
                    success: function(data) {
                        console.log(data);
                        if (data) {
                            var output = '';
                            data.forEach(item => {
                                output += `
                    
                    <tr>
                                                    <td>${item.prenomEmploye}</td>
                                                    <td>${item.nomEmploye}</td>
                                                    <td>${item.telEmploye}</td>
                                                    <td>${item.addressEmploye}</td>
                                                    <td>${item.emailEmploye}</td>
                                                    <td>${item.id}</td>
                                                    <td id = "${item.id}"><button type="button" class="btn btn-primary btnupdate updatejobdata" update-id = "${item.id}" >UPDATE</button></td> 
                                                    <td id = "${item.id}"><button type="button" class="btn btn-danger btndelete deletejobdata"  data-id = "${item.id}">DELETE</button></td> 
                                                 


                                                </tr>
                    `;
                            });
                            $('#employee-list').html(output);
                        } else {
                            $('#employee-list').html("<tr><td colspan = '6'>No data found</td></tr>");

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

                      //open modal for delete 
                    $(document).on('click', '.deletejobdata', function() {
                    console.log("i reached delete step");
                    var delid = $(this).attr('data-id');
                    console.log(delid, " i am delete id");
                    $('#btnDelteYes').attr('data-id', delid)

                    $('#myDeleteModal').modal('show');

                });

                $(document).on('click', '#btnDelteYes', function() {
                    let id = $(this).attr('data-id');
                    let role_id = 2;
                    console.log(id, "i am the job id that is to be deleted");
                    $('#' + id).parents("tr").remove();
                    console.log("delete is done");
                    $('#myDeleteModal').modal('hide');
                    $.ajax({
                        url: baseUrl,
                                type: 'POST',
                                dataType: "json",
                                data:{endpoint:"/employes/employeeDeleteJobs",id:id},
                                success: function(data){
                                    console.log("success");
                                },
                    });
                    $.ajax({
                        url: baseUrl,
                        type: 'POST',
                        async: true,
                        data: {endpoint:"/employes/deleteEmploye",id:id},
                        success: function(data) {
                            console.log(data, "i am the data after ajax call is completed");
                            $('#timeoutmsg').html("Deleted Successfully");
                            $.ajax({
                                url: baseUrl,
                                type: 'POST',
                                dataType: "json",
                                data: {endpoint:"/authentication/delete",id:id,role_id:role_id },
                                success: function(data){
                                    console.log("success");
                                },
                            });
                            setTimeout(() => {
                                $('#timeoutmsg').html("");
                            }, 2000)

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

                // close modal for delete

            //open modal for update
            $(document).on('click', '.updatejobdata', function() {
                    console.log("i reached update step");
                    var upid = $(this).attr('update-id');
                    console.log(upid, " i am update id");
                    $('.afterupdate').attr('update-id', upid)
                    $('#myUpdateModal').modal('show');
                    $.ajax({
                        url: baseUrl,
                        type: 'POST',
                        dataType: "json",
                        data: {endpoint:"/employes/employeAPI-detail",id:upid},
                        success: function(data){
                            console.log(data);
                            $('input[name="prenomEmploye"]').val(data.prenomEmploye)
                            $('input[name="nomEmploye"]').val(data.nomEmploye)
                            $('input[name="telEmploye"]').val(data.telEmploye)
                            $('input[name="addressEmploye"]').val(data.addressEmploye)
                            $('input[name="emailEmploye"]').val(data.emailEmploye)
                            $('input[name="cpEmployee"]').val(data.cpEmployee)
                        },
                    });
            });
            $('#updateformofEmployedata').submit(function(e) {
                    console.log("i reached inside form of update");
                    e.preventDefault();
                    console.log('modal update button clicked!')
                    var fd = new FormData(this);
                    console.log(fd, "i am form data");
                    var uid = $('#submit').attr('update-id');
                    console.log(uid , "am i working uid even");
                    fd.append("endpoint","/employes/updateEmploye");
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
                            $('#myUpdateModal').modal('hide');
                            $('#timeoutmsg').html("Updated Successfully");
                            $.ajax({
                                url: baseUrl,
                                type: 'POST',
                                data: {
                                    endpoint: "/authentication/updateEmp/2/",
                                    id:uid,
                                    email: fd.get("emailEmploye"),
                                },
                                success: function(data){
                                    console.log("Success");
                                },
                            });
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
                // ajax update ends
            });

           
        </script>

</body>

</html>