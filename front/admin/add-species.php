<?php
session_start();

   if(strcmp($_SESSION['username'],'admin')!==0){
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
    <title>Smartarrium - Edit Species</title>
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
                        <h2 class="tm-block-title d-inline-block">Add Species</h2>
                    </div>
                </div>
                <div class="row tm-edit-product-row">
<form action="insert-species.php" method="post" class="tm-signup-form row">
				<div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
					<div class="form-group mb-3">
                                <label
                                        for="name"
                                >Species Name
                                </label>
                                <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        class="form-control validate input-text"
                                />
                    </div>
                        <div class="tm-product-img-dummy mx-auto">
                  <i
                    class="fas fa-cloud-upload-alt tm-upload-icon"
                    onclick="document.getElementById('fileInput').click();"
                  ></i>
                </div>
                <div class="custom-file mt-3 mb-3">
                  <input id="fileInput" type="file" style="display:none;" />
                  <input
                    type="button"
                    class="btn btn-primary btn-block mx-auto"
                    value="Upload Image"
                    onclick="document.getElementById('fileInput').click();"
                  />
                </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                       
                            
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
                                    <textarea name="mintmp" class="input-text"></textarea>
                                </div>
                                <div class="form-group mb-3 col-xs-12 col-sm-6">
                                    <label
                                            for="stock"
                                    >Maximum
                                    </label>
                                    <textarea name="maxtmp" class="input-text"></textarea>
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
                                    <textarea name="minhmd" class="input-text"></textarea>
                                </div>
                                <div class="form-group mb-3 col-xs-12 col-sm-6">
                                    <label
                                            for="stock"
                                    >Maximum
                                    </label>
                                    <textarea name="maxhmd" class="input-text"></textarea>
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
                                    <textarea name="minph" class="input-text"></textarea>
                                </div>
                                <div class="form-group mb-3 col-xs-12 col-sm-6">
                                    <label
                                            for="stock"
                                    >Maximum
                                    </label>
                                    <textarea name="maxph" class="input-text"></textarea>
                                </div>
                            </div>

                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Add</button>
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
<script>
      $(function() {
        $("#expire_date").datepicker({
          defaultDate: "10/22/2020"
        });
      });

</script>
</body>
</html>
