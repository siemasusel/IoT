<?php
include("../influx-config.php");
$dbname = "metrics_test";

$client = new \InfluxDB\Client('127.0.0.1', 8086, '', '');
$database = $client->selectDB($dbname);

// executing a query will yield a resultset object
$result_tmp = $database->query('select value from temperature ORDER BY DESC LIMIT 1');
$points_tmp = $result_tmp->getPoints();
$influx_temperature = $points_tmp[0]['value'];

// executing a query will yield a resultset object
$result_hmd = $database->query('select value from humidity ORDER BY DESC LIMIT 1');
$points_hmd = $result_hmd->getPoints();
$influx_humidity = $points_hmd[0]['value'];

// executing a query will yield a resultset object
$result_ph = $database->query('select value from ph ORDER BY DESC LIMIT 1');
$points_ph = $result_ph->getPoints();
$influx_ph = $points_ph[0]['value'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Smartarrium - Control</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="../resources/css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="../resources/css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
</head>

<body id="reportsPage">
    <div class="" id="home">
        <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
                <a class="navbar-brand" href="index.php">
                    <h1 class="tm-site-title mb-0">SMARTARRIUM</h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto h-100">
                <li class="nav-item">
                    <a class="nav-link" href="account.php">
                        <i class="fas fa-user"></i> Accounts
                    </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="premium.php">
                  <i class="fas fa-crown"></i> Premium
                </a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="list-species.php">
                        <i class="fas fa-frog"></i> Species
                    </a>
                </li>
				<li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="far fa-square"></i>
                <span> Parameters <i class="fas fa-angle-down"></i> </span>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="control.php">Control</a>
                <a class="dropdown-item" href="history.php">History</a>
                <a class="dropdown-item" href="feeding.php">Feeding</a>
				<a class="dropdown-item" href="cleaning.php">Cleaning</a>
                <a class="dropdown-item" href="spotlight.php">Spotlight</a>
              </div>
            </li>
                <li class="nav-item">
                    <a class="nav-link" href="help-center.php">
                        <i class="fas fa-question-circle"></i> Help Center
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link d-block" href="login.php">
                         <b>Logout</b>
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
                        <h2 class="tm-block-title d-inline-block">Change terrarium settings</h2>
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
                                            for="tmp"
                                    >Current Temperature
                                    </label>
                                    <input name="tmp" class="output" readonly
					value="<?php echo $influx_temperature; ?>"
></textarea> 
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
                                            for="hmd"
                                    >Current Humidity
                                    </label>
                                    <input name="hmd" class="output" readonly value="<?php echo $influx_humidity; ?>"
></textarea>
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
                                <div class="form-group mb-6 col-xs-12 col-sm-6">
                                    <label
                                            for="ph"
                                    >Current PH
                                    </label>
                                    <input name="ph" class="output" value="<?php echo $influx_ph; ?>"></textarea>                                
	</div>
                            </div>

                    </div>
                    <div class="col-12">
                        <a class="btn btn-primary btn-block" href="edit-control.php"> Update
 </a>
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
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="js/tooplate-scripts.js"></script>
   
</body>

</html>