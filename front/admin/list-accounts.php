<?php
include("../config.php");
session_start();

   if(strcmp($_SESSION['username'],'admin')!==0){
      header("location: ../login.php");
      die();
   }

$search_name = $_POST["search_name"];
$search_last_name = $_POST["search_last_name"];
$search_email = $_POST["search_email"];
$condition = "";
if(isset($search_name) or isset($search_last_name) or isset($search_email)){
	$condition = " where ";
	$condition1 = " 1 = 1 ";
	$condition2 = " 1 = 1 ";
	$condition3 = " 1 = 1 ";
	if(isset($search_name)){
		$condition1 = " usr_name like '%$search_name%' ";
	}
	if(isset($search_last_name)){
		$condition2 = " usr_last_name like '%$search_last_name%' ";
	}
	if(isset($search_email)){
		$condition3 = " usr_email like '%$search_email%' ";
	}
	$condition = $condition . $condition1 ."AND". $condition2 ."AND". $condition3; 
}
$query = mysqli_query($db, "SELECT * FROM users" . $condition);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Smartarrium - Accounts List</title>
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
    <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-products">
        <form method="post" action="delete-accounts.php">        
				<div class="tm-product-table-container">

                    <table class="table table-hover tm-table-small tm-product-table">
                        <thead>
                        <tr>
                            <th scope="col">&nbsp;</th>
                            <th scope="col">ACCOUNTS LIST</th>                  
                        </tr>
                        </thead>
                        <tbody>
            <?php
while ($row = mysqli_fetch_array($query)) {
?>
 
   <tr>
       <th scope="row"><input type="checkbox" name="delete[]" value="<?php echo $row['usr_id'];?>"/></th>
       <td class="tm-product-name"><a href="/admin/account.php?id=<?php
    echo $row['usr_id'];
?>"> <?php
    echo $row['usr_name'] . " " . $row['usr_last_name'] . " (" . $row['usr_email'] . ")";
?></td>
     </tr>

            <?php
}
?>
                       </tbody>
                    </table>
				
                </div>
                <!-- table container -->
                
               <input type="submit" value="Delete selected user(s)" name="but_delete" class="btn btn-primary btn-block">
			   </form>	
			   <a
                        href="add-account.php"
                        class="btn btn-primary btn-block mb-3">Add new user</a>
            </div>

        </div>
		
         <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-block-col">   
		 <form action="list-accounts.php" method="post" class="tm-edit-product-form">
 <div class="tm-bg-primary-dark tm-block tm-block-product-categories">
            <h2 class="tm-block-title">Find Account</h2>
            <div class="tm-product-table-container">
              <table class="table tm-table-small tm-product-table">
                <tbody>
                  <tr>
                    <td class="filter-field">First Name</td>
                    <td class="text-center">
                        <textarea name="search_name" class="input-text"></textarea>
                    </td>
                  </tr>
                  <tr>
                    <td class="filter-field">Last Name</td>
                    <td class="text-center">
                       <textarea name="search_last_name" class="input-text"></textarea>
                    </td>
                  </tr>
                  <tr>
                    <td class="filter-field">Email</td>
                    <td class="text-center">
                        <textarea name="search_email" class="input-text"></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- table container -->
            <button class="btn btn-primary btn-block mb-3">
             Search
            </button>
          </div>
		 </form> 
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