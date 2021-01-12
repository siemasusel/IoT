<?php
include("../config.php");
session_start();

   if(!isset($_SESSION['username']) or (strcmp($_SESSION['username'],'admin')==0)){
      header("location: ../login.php");
      die();
   }

$search_name = $_POST["search_name"];
if(isset($search_name)){
	$condition = " where spc_name like '%$search_name%'";
}
$query = mysqli_query($db, "SELECT * FROM species" . $condition);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Smartarrium - Species List</title>
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
                        <i class="fas fa-user"></i> Accounts
                    </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="premium.php">
                  <i class="fas fa-crown"></i> Premium
                </a>
                </li>
				<li class="nav-item">
                    <a class="nav-link active" href="list-species.php">
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
    <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-products">

                <div class="tm-product-table-container">
                    <table class="table table-hover tm-table-small tm-product-table">
                        <thead>
                        <tr>
                            <th scope="col">&nbsp;</th>
                            <th scope="col">SPECIES LIST</th>                  
                        </tr>
                        </thead>
                        <tbody>
            <?php
while ($row = mysqli_fetch_array($query)) {
?>
 
   <tr>
       <th scope="row"><input disabled type="checkbox" name="delete[]" value="<?php echo $row['spc_id'];?>"/></th>
       <td class="tm-product-name"><a href="species.php?id=<?php
    echo $row['spc_id'];
?>"> <?php
    echo $row['spc_name'];
?></td>
     </tr>

            <?php
}
?>
                        </tbody>
                    </table>
                </div>
                <!-- table container -->

                           </div>
        </div>
		
		 <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-product-categories">
<form action="list-species.php" method="post" class="tm-edit-product-form">
            <h2 class="tm-block-title">Find Species</h2>
            <div class="tm-product-table-container">
              <table class="table tm-table-small tm-product-table">
                <tbody>
                  <tr>
                    <td class="filter-field">Name</td>
                    <td class="text-center">
                      <textarea name="search_name" class="input-text"></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- table container -->
            <button class="btn btn-primary btn-block mb-3">
             Search
            </button>
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

<script src="js/jquery-3.3.1.min.js"></script>
<!-- https://jquery.com/download/ -->
<script src="js/bootstrap.min.js"></script>
<!-- https://getbootstrap.com/ -->
</body>
</html>