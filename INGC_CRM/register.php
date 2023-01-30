<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">

    <link href="css/style.css" rel="stylesheet">
<link rel="stylesheet" href="index.css?v=<?php echo time(); ?>">

    <title>Connexion</title>
</head>
<body>
<div class="col-lg-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">S'INSCRIRE</h4>
                                <?php 
                                session_start();
                                if(isset($_SESSION["error"])){
                                    echo '<p style="color:red">'.$_SESSION["error"].'</p>';
                                    unset($_SESSION["error"]);
                                }
                                ?>
                                
                                <div class="basic-form">
                                    <form action="register-logic.php" method="post">
                                    <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nom</label>
                                            <div class="col-sm-10">
                                                <input name="name" id="name" type="text" class="form-control" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input name="email" id="email" type="email" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Mot de passe</label>
                                            <div class="col-sm-10">
                                                <input name="password" id="password" type="password" class="form-control" placeholder="Password">
                                            </div>
                                        </div>
                                       
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary">S'inscire</button>
                                            </div>
                                        </div>
                                        <div class="loginlink">
                                               <p>Déja inscrit?</p> <a  href="login.php">CONNECTEZ-VOUS ICI</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
</body>
</html>