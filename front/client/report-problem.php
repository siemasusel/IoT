<?php
include("../config.php");
session_start();

  if(!isset($_SESSION['username']) or (strcmp($_SESSION['username'],'admin')==0)){
      header("location: ../login.php");
      die();
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Smartarrium - Help Center </title>
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
<nav class="navbar navbar-expand-xl">
    <div class="container h-100">
        <a class="navbar-brand" href="index.php">
            <h1 class="tm-site-title mb-0">SMARTARRIUM</h1>
        </a>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto h-100">
                <li class="nav-item">
                    <a class="nav-link" href="account.php">
                        <i class="fas fa-user"></i> Account
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
                    <a class="nav-link active" href="help-center.php">
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
<div class="container mt-5">
   <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Report a problem</h2>
		<form action="create-problem.php" method="post" class="tm-signup-form row">                
		<div class="form-group col-lg-12">
                  <label for="name">Topic</label>
				  <input
                    id="topic"
                    name="topic"
                    type="text"
                    class="form-control validate"
                  />
                </div>
		<div class="form-group col-lg-12">
                  <label for="desc">Description</label> 
                  <textarea name="desc" id="desc" class="form-control validate" rows="8"></textarea>
                </div>
                <!/div>
                <div class="form-group col-lg-12">
                  <label class="tm-hide-sm">&nbsp;</label>
                  <button
                    type="submit"
                    class="btn btn-primary btn-block text-uppercase"
                  > Send </a>
                  </button>
                </div>
              </form>
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
<script src="js/bootstrap.min.js"></script>
<!-- https://getbootstrap.com/ -->
</body>
</html>