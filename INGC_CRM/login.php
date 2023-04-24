<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">

<link href="css/style.css" rel="stylesheet">
<link rel="stylesheet" href="index.css?v=<?php echo time(); ?>">

    <title>Formulaire de connexion</title>
</head>
<body>



<div class="w-50 col-lg-12 mx-auto mt-5">
    <h2 class="text-center text-primary">Login Portal</h2>
                        <div class="card">
                            <div class="card-body">
                                <!-- <div class="d-flex justify-content-between"> -->
                                <h4 class="card-title">CONNEXION</h4>
                                <!-- <div class="d-flex justify-content-end ">
                                
                                    <p>Please Select the Type of User</p>
                                   
                                        <select class="form-select" id="sel1" name="sellist1">
                                            <option value="">Admin</option>
                                            <option value="">Employee</option>
                                            <option value="">Client</option>
                                        </select>
                                </div>
                                </div> -->
                                <?php

                                    session_start();


                                    if(isset($_SESSION['invalid']))
                                    {
                                    echo "<p style='color:red;'>".$_SESSION['invalid']."</p>";
                                    unset($_SESSION['invalid']);
                                    }
                                    if(isset($_SESSION["Success"])){
                                        echo "<p style='color:green;'>".$_SESSION['Success']."</p>";
                                        unset($_SESSION['Success']);
                                    }
                                    ?>
                                <div class="basic-form">
                                    <form action="login-logic.php" method="post">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input name="email" id="email" type="email" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input name="password" id="password" type="password" class="form-control" placeholder="Password">
                                            </div>
                                        </div>
                                       
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary">LOGIN</button>
                                            </div class="col-sm-10">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
    
</body>
</html>