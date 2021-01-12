<?php
include ("../config.php");
session_start();
if (!isset($_SESSION['username']) or (strcmp($_SESSION['username'], 'admin') == 0))
{
    header("location: ../login.php");
    die();
}

$usr_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

    $spt_00 = mysqli_real_escape_string($db, $_REQUEST['spt_00']);
    $spt_01 = mysqli_real_escape_string($db, $_REQUEST['spt_01']);
    $spt_02 = mysqli_real_escape_string($db, $_REQUEST['spt_02']);
    $spt_03 = mysqli_real_escape_string($db, $_REQUEST['spt_03']);
    $spt_04 = mysqli_real_escape_string($db, $_REQUEST['spt_04']);
    $spt_05 = mysqli_real_escape_string($db, $_REQUEST['spt_05']);
    $spt_06 = mysqli_real_escape_string($db, $_REQUEST['spt_06']);
    $spt_07 = mysqli_real_escape_string($db, $_REQUEST['spt_07']);
    $spt_08 = mysqli_real_escape_string($db, $_REQUEST['spt_08']);
    $spt_09 = mysqli_real_escape_string($db, $_REQUEST['spt_09']);
    $spt_10 = mysqli_real_escape_string($db, $_REQUEST['spt_10']);
    $spt_11 = mysqli_real_escape_string($db, $_REQUEST['spt_11']);
    $spt_12 = mysqli_real_escape_string($db, $_REQUEST['spt_12']);
    $spt_13 = mysqli_real_escape_string($db, $_REQUEST['spt_13']);
    $spt_14 = mysqli_real_escape_string($db, $_REQUEST['spt_14']);
    $spt_15 = mysqli_real_escape_string($db, $_REQUEST['spt_15']);
    $spt_16 = mysqli_real_escape_string($db, $_REQUEST['spt_16']);
    $spt_17 = mysqli_real_escape_string($db, $_REQUEST['spt_17']);
    $spt_18 = mysqli_real_escape_string($db, $_REQUEST['spt_18']);
    $spt_19 = mysqli_real_escape_string($db, $_REQUEST['spt_19']);
    $spt_20 = mysqli_real_escape_string($db, $_REQUEST['spt_20']);
    $spt_21 = mysqli_real_escape_string($db, $_REQUEST['spt_21']);
    $spt_22 = mysqli_real_escape_string($db, $_REQUEST['spt_22']);
    $spt_23 = mysqli_real_escape_string($db, $_REQUEST['spt_23']);

    // Attempt insert query execution
    $sql = "UPDATE spotlight SET 
spt_00 = (CASE WHEN '$spt_00'='on' THEN 1 ELSE 0 END),  
spt_01 = (CASE WHEN '$spt_01'='on' THEN 1 ELSE 0 END), 
spt_02 = (CASE WHEN '$spt_02'='on' THEN 1 ELSE 0 END), 
spt_03 = (CASE WHEN '$spt_03'='on' THEN 1 ELSE 0 END), 
spt_04 = (CASE WHEN '$spt_04'='on' THEN 1 ELSE 0 END), 
spt_05 = (CASE WHEN '$spt_05'='on' THEN 1 ELSE 0 END), 
spt_06 = (CASE WHEN '$spt_06'='on' THEN 1 ELSE 0 END), 
spt_07 = (CASE WHEN '$spt_07'='on' THEN 1 ELSE 0 END), 
spt_08 = (CASE WHEN '$spt_08'='on' THEN 1 ELSE 0 END), 
spt_09 = (CASE WHEN '$spt_09'='on' THEN 1 ELSE 0 END), 
spt_10 = (CASE WHEN '$spt_10'='on' THEN 1 ELSE 0 END), 
spt_11 = (CASE WHEN '$spt_11'='on' THEN 1 ELSE 0 END), 
spt_12 = (CASE WHEN '$spt_12'='on' THEN 1 ELSE 0 END), 
spt_13 = (CASE WHEN '$spt_13'='on' THEN 1 ELSE 0 END), 
spt_14 = (CASE WHEN '$spt_14'='on' THEN 1 ELSE 0 END), 
spt_15 = (CASE WHEN '$spt_15'='on' THEN 1 ELSE 0 END), 
spt_16 = (CASE WHEN '$spt_16'='on' THEN 1 ELSE 0 END), 
spt_17 = (CASE WHEN '$spt_17'='on' THEN 1 ELSE 0 END), 
spt_18 = (CASE WHEN '$spt_18'='on' THEN 1 ELSE 0 END), 
spt_19 = (CASE WHEN '$spt_19'='on' THEN 1 ELSE 0 END), 
spt_20 = (CASE WHEN '$spt_20'='on' THEN 1 ELSE 0 END), 
spt_21 = (CASE WHEN '$spt_21'='on' THEN 1 ELSE 0 END), 
spt_22 = (CASE WHEN '$spt_22'='on' THEN 1 ELSE 0 END), 
spt_23 = (CASE WHEN '$spt_23'='on' THEN 1 ELSE 0 END) 
where spt_usr_id='$usr_id'";
    mysqli_query($db, $sql);

}

$query = mysqli_query($db, "SELECT * FROM spotlight where spt_usr_id='$usr_id'");

if (mysqli_num_rows($query) == 0)
{
    $insert = "INSERT INTO spotlight (spt_usr_id) VALUES ('$usr_id')";
    mysqli_query($db, $insert);
}

$row = mysqli_fetch_array($query);
$spt_00 = $row['spt_00'];
$spt_01 = $row['spt_01'];
$spt_02 = $row['spt_02'];
$spt_03 = $row['spt_03'];
$spt_04 = $row['spt_04'];
$spt_05 = $row['spt_05'];
$spt_06 = $row['spt_06'];
$spt_07 = $row['spt_07'];
$spt_08 = $row['spt_08'];
$spt_09 = $row['spt_09'];
$spt_10 = $row['spt_10'];
$spt_11 = $row['spt_11'];
$spt_12 = $row['spt_12'];
$spt_13 = $row['spt_13'];
$spt_14 = $row['spt_14'];
$spt_15 = $row['spt_15'];
$spt_16 = $row['spt_16'];
$spt_17 = $row['spt_17'];
$spt_18 = $row['spt_18'];
$spt_19 = $row['spt_19'];
$spt_20 = $row['spt_20'];
$spt_21 = $row['spt_21'];
$spt_22 = $row['spt_22'];
$spt_23 = $row['spt_23'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Smartarrium - Spotlight</title>
    <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="../resources/css/fontawesome.min.css"/>
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css"/>
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
            <button
                    class="navbar-toggler ml-auto mr-0"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
            >
                <i class="fas fa-bars tm-nav-icon"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto h-100">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="account.php">
                            <i class="far fa-user"></i> Account
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
                            <b> <?php echo $_SESSION['username'] ?>, Logout</b>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
	<form action="spotlight.php" method="post" class="tm-signup-form row">
    <div class="container mt-5">

        <div class="row tm-content-row">
		
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
			
                <div class="tm-bg-primary-dark tm-block tm-block-products">
				
                    <div class="tm-product-table-container">
                        <table class="table table-hover tm-table-small tm-product-table">
                            <thead>
                            <tr>
                                <th scope="col">&nbsp;</th>
                                <th scope="col">TIMETABLE - HOURS</th> 
                            </tr>
                            </thead>
                            <tbody>
                            <tr>


                                <th scope="row"><input id="00" type="checkbox" name="spt_00" <?php if ($spt_00 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">00</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_01" <?php if ($spt_01 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">01</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_02" <?php if ($spt_02 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">02</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_03" <?php if ($spt_03 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">03</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_04" <?php if ($spt_04 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">04</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_05" <?php if ($spt_05 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">05</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_06" <?php if ($spt_06 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">06</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_07" <?php if ($spt_07 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">07</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_08" <?php if ($spt_08 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">08</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_09" <?php if ($spt_09 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">09</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_10" <?php if ($spt_10 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">10</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_11" <?php if ($spt_11 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">11</td>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_12" <?php if ($spt_12 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">12</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_13" <?php if ($spt_13 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">13</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_14" <?php if ($spt_14 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">14</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_15" <?php if ($spt_15 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">15</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_16" <?php if ($spt_16 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">16</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_17" <?php if ($spt_17 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">17</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_18" <?php if ($spt_18 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">18</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_19" <?php if ($spt_19 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">19</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_20" <?php if ($spt_20 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">20</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_21" <?php if ($spt_21 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">21</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_22" <?php if ($spt_22 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">22</td>
                            </tr>
                            <tr>
                                <th scope="row"><input type="checkbox" name="spt_23" <?php if ($spt_23 == "1") echo "checked"; ?> class="hour-cb"/></th>
                                <td class="tm-product-name">23</td>
                            </tr> 
                            </tbody>
                        </table> 
						
                    </div>
					
                    <!-- table container -->
                </div>
				
            </div>
			
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-product-categories">
                    <h2 class="tm-block-title">Options</h2>						
                    <button type="button" class="btn btn-primary btn-block mb-3" onclick="selectAll()">
                        Select all
                    </button>
                    <button type="button" class="btn btn-primary btn-block mb-3" onclick="deselectAll()">
                        Deselect all
                    </button>
					<button type="submit" class="btn btn-primary btn-block mb-3">
                        Update
                    </button>
					
                </div>
            </div>
			
	
        </div>

    </div>
	</form>
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
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script>
      function selectAll() {
	  var items = document.getElementsByClassName('hour-cb');
        for (var i = 0; i < items.length; i++) {
            if (items[i].type == 'checkbox')
                items[i].checked = true;
        }
}
function deselectAll() {
var items = document.getElementsByClassName('hour-cb');
        for (var i = 0; i < items.length; i++) {
            if (items[i].type == 'checkbox')
                items[i].checked = false;
        }
} 

    </script>
</body>
</html>
