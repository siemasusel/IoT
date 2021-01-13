<?php
include ("../config.php");
session_start();

   if(strcmp($_SESSION['username'],'admin')!==0){
      header("location: ../login.php");
      die();
   }

$spc_id = $_GET["id"];
$query = mysqli_query($db, "SELECT * FROM species where spc_id='$spc_id'");

$row = mysqli_fetch_array($query);
$name = $row['spc_name'];
$mintmp = $row['spc_min_tmp'];
$maxtmp = $row['spc_max_tmp'];
$minph = $row['spc_min_ph'];
$maxph = $row['spc_max_ph'];
$minhmd = $row['spc_min_hmd'];
$maxhmd = $row['spc_max_hmd'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Smartarrium - Species Details</title>
    <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="../resources/css/fontawesome.min.css"/>
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="../resources/jquery-ui-datepicker/jquery-ui.min.css" type="text/css"/>
    <!-- http://api.jqueryui.com/datepicker/ -->
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css"/>
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="../resources/css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
</head>

<body>
<nav class="navbar navbar-expand-xl">
    <div class="container h-100">
        <a class="navbar-brand" href="index.php">
		<img src="../resources/img/logo.png" alt="Logo image" class="img-fluid">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto h-100">
                <li class="nav-item">
                    <a class="nav-link" href="list-accounts.php">
                        <i class="fas fa-user"></i> Accounts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="list-species.php">
                        <i class="fas fa-frog"></i> Species
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="help-center.php">
                        <i class="fas fa-question-circle"></i> Help Center
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link d-block" href="../logout.php">
                        Admin, <b>Logout</b>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container tm-mt-big tm-mb-big">
    <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row">
                    <div class="col-12">
                        <h2 class="tm-block-title d-inline-block">Species Details</h2>
                    </div>
                </div>
                <div class="row tm-edit-product-row">
				<div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
					<div class="form-group mb-3">
                                <label
                                        for="name"
                                ><b>Species Name</b>
                                </label>
                            </div>
							<div class="form-group mb-3">
                                <textarea class="output" readonly><?php echo $name;?></textarea>
                            </div>
                        <div class="tm-product-img-edit mx-auto">
                            <img src="../resources/img/animal.jpg" alt="Species image" class="img-fluid d-block mx-auto">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <form action="" method="post" class="tm-edit-product-form">
                            
                            <div class="row">
								<div class="form-group mb-3">
									<label>
									<b>Temperature [°C]</b>
									</label>
								</div>
							</div>
                            <div class="row">
                                <div class="form-group mb-3 col-xs-12 col-sm-6">
                                    <label
                                            for="description"
                                    >Minimum
                                    </label>
                                    <textarea class="output" readonly><?php echo $mintmp;?></textarea>
                                </div>
                                <div class="form-group mb-3 col-xs-12 col-sm-6">
                                    <label
                                            for="stock"
                                    >Maximum
                                    </label>
                                    <textarea class="output" readonly><?php echo $maxtmp;?></textarea>
                                </div>
                            </div>
							<div class="row">
								<div class="form-group mb-3">
									<label>
									<b>Air humidity [%]</b>
									</label>
								</div>
							</div>
							<div class="row">
                                <div class="form-group mb-3 col-xs-12 col-sm-6">
                                    <label
                                            for="description"
                                    >Minimum
                                    </label>
                                    <textarea class="output" readonly><?php echo $minhmd;?></textarea>
                                </div>
                                <div class="form-group mb-3 col-xs-12 col-sm-6">
                                    <label
                                            for="stock"
                                    >Maximum
                                    </label>
                                    <textarea class="output" readonly><?php echo $maxhmd;?></textarea>
                                </div>
                            </div>
							<div class="row">
								<div class="form-group mb-3">
									<label>
									<b>PH</b>
									</label>
								</div>
							</div>
							<div class="row">
								<br>
                                <div class="form-group mb-3 col-xs-12 col-sm-6">
                                    <label
                                            for="description"
                                    >Minimum
                                    </label>
                                    <textarea class="output" readonly><?php echo $minph;?></textarea>
                                </div>
                                <div class="form-group mb-3 col-xs-12 col-sm-6">
                                    <label
                                            for="stock"
                                    >Maximum
                                    </label>
                                    <textarea class="output" readonly><?php echo $maxph;?></textarea>
                                </div>
                            </div>

                    </div>
                    <div class="col-12">
						<a class="btn btn-primary btn-block" href="edit-species.php?id=<?php echo $spc_id; ?>">Edit</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="tm-footer row tm-mt-small">
    <div class="col-12 font-weight-light">
        <p class="text-center text-white mb-0 px-4 small">
            Copyright &copy; <b>2018</b> All rights reserved.

            Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link">Template Mo</a>
        </p>
    </div>
</footer>

<script src="js/jquery-3.3.1.min.js"></script>
<!-- https://jquery.com/download/ -->
<script src="jquery-ui-datepicker/jquery-ui.min.js"></script>
<!-- https://jqueryui.com/download/ -->
<script src="js/bootstrap.min.js"></script>
<!-- https://getbootstrap.com/ -->
</body>
</html>
