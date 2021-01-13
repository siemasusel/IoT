<?php
include("../config.php");
session_start();

   if(strcmp($_SESSION['username'],'admin')!==0){
      header("location: ../login.php");
      die();
   }

$usr_id = $_GET["id"];
$query  = mysqli_query($db, "SELECT * FROM users where usr_id='$usr_id'");

$row      = mysqli_fetch_array($query);
$name     = $row['usr_name'];
$lastname = $row['usr_last_name'];
$email    = $row['usr_email'];
$premium  = $row['usr_premium'];
$terrarium  = $row['usr_trm_id'];
$end_date     = $row['usr_premium_end_date'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Smartarrium - Edit Account</title>
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
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto h-100">
                <li class="nav-item">
                    <a class="nav-link active" href="list-accounts.php">
                        <i class="fas fa-user"></i> Accounts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="list-species.php">
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
      <div class="container mt-5">
        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Account Settings</h2>
              <form action="update-account.php?id=<?php echo $usr_id; ?>" method="post" class="tm-signup-form row">
                <div class="form-group col-lg-6">
                  <label for="name">First Name</label>
                  <input
                    id="name"
                    name="name"
value="<?php
echo $name;
?>"

                    type="text"
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="name">Last Name</label>
                  <input
                    id="lastname"
                    name="last_name"
value="<?php
echo $lastname;
?>"

                    type="text"
                    class="form-control validate"
                  />
                </div>
                <div class="form-group col-lg-6">
                  <label for="email">Account Email</label>
                  <input
                    id="email"
                    name="email"
value="<?php
echo $email;
?>"

                    type="email"
                    class="form-control validate"
                  />
                </div>
  <div class="form-group col-lg-6">
                  <label for="terrarium">Terrarium ID</label>
                  <input
                    id="animal"
                    name="terrarium"
                    class="form-control validate"
value="<?php
echo $terrarium;
?>"

                  />
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
                   />
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
                  />
</div>
<?php
}
?>


                <div class="form-group col-lg-12">
                  <label class="tm-hide-sm">&nbsp;</label>
                  <button
                    type="submit"
                    class="btn btn-primary btn-block"
                  >
                    Save Changes
                  </button>
                </div>
                <div class="col-12">
                  <a class="btn btn-primary btn-block" href="account.php?id=<?php echo $usr_id; ?>"> Go Back </a>
                </div>
              </form>
<form action="change-password.php?id=<?php echo $usr_id; ?>" method="post" class="tm-signup-form row">
               <div class="form-group mt-3">
                    <label for="password">Change password</label>
                    <input
                      name="password"
                      type="password"
                      class="form-control validate"
                      id="password"
                      value=""
                      required 
                    />
                  </div> 

                <div class="form-group col-lg-12">
                  <label class="tm-hide-sm">&nbsp;</label>
                  <button
                    type="submit"
                    class="btn btn-primary btn-block"
                  >
                    Submit New Password
                  </button>
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
