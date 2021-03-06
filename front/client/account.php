<?php
include("../config.php");
session_start();

   if(!isset($_SESSION['username']) or (strcmp($_SESSION['username'],'admin')==0)){
      header("location: ../login.php");
      die();
   }

$usr_id = $_SESSION['id'];
$query  = mysqli_query($db, "SELECT * FROM users where usr_id='$usr_id'");

$row      = mysqli_fetch_array($query);
$name     = $row['usr_name'];
$lastname = $row['usr_last_name'];
$email    = $row['usr_email'];
$premium  = $row['usr_premium'];
$end_date  = $row['usr_premium_end_date'];
$terrarium  = $row['usr_trm_id'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Smartarrium - Account Details</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="../resources/css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css" />
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
		<img src="../resources/img/logo.png" alt="Logo image" class="img-fluid">
        </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto h-100">
                <li class="nav-item">
                    <a class="nav-link active" href="account.php">
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
                    <a class="nav-link d-block" href="../logout.php">
                        <b>Logout</b>
                    </a>
                </li>
            </ul>
        </div>
            </div>

</nav>
      <div class="container mt-5">
        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Account Settings</h2>
              <form action="" class="tm-signup-form row">
                <div class="form-group col-lg-6">
                  <label for="name">First Name</label>
                  <input
                    id="name"
                    name="name"
                    type="text"
            value="<?php
echo $name;
?>"
                    class="form-control validate"
                  disabled />
                </div>
                <div class="form-group col-lg-6">
                  <label for="name">Last Name</label>
                  <input
                    id="lastname"
                    name="lastname"
                    type="text"
            value="<?php
echo $lastname;
?>"
                    class="form-control validate"
                  disabled />
                </div>
                <div class="form-group col-lg-6">
                  <label for="email">Account Email</label>
                  <input
                    id="email"
                    name="email"
                    type="email"
            value="<?php
echo $email;
?>"
                    class="form-control validate"
                  disabled />
                </div>

                <div class="form-group col-lg-6">
                  <label for="password">Terrarium ID</label>
                  <input
                    id="animal"
                    name="terrarium"
                    type="animal"
value="<?php
echo $terrarium;
?>"
                    class="form-control validate"
                   disabled />
                </div>


        <div class="form-group col-lg-6">
                  <label for="premium">Premium <br></br></label>
                  <input
                    id="premium"
                    name="premium"
                    type="checkbox"
            <?php
if ($premium == "1")
    echo "checked";
?>
                 disabled />
                </div>
<?php
if ($premium == "1"){
?>
<div class="form-group col-lg-6">
<label for="date">Premium End Date</label>
                  <input
                    id="end_date"
                    name="end_date"
value="<?php
echo $end_date;
?>"

                    type="date"
                    class="form-control validate"
                  disabled />
</div>
<?php
}
?>

                <div class="form-group col-lg-12">
                  <label class="tm-hide-sm">&nbsp;</label>
                  <a class="btn btn-primary btn-block" href="edit-account.php"> Update Profile</a>
                </div>
                <div class="col-12">
                  <a class="btn btn-primary btn-block" href="delete-account.php"> Delete Account</a>                
		</div>
              </form>
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
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>