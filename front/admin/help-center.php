<?php
include ("../config.php");
session_start();

if (strcmp($_SESSION['username'], 'admin') !== 0)
{
    header("location: ../login.php");
    die();
}

$prb_id = $_GET["id"];

$search_name = $_POST["search_name"];
$search_last_name = $_POST["search_last_name"];
$search_email = $_POST["search_email"];
$search_topic = $_POST["search_topic"];
$search_open = $_POST["search_open"];
$search_closed = $_POST["search_closed"];
$statuses = "Open";
if (isset($search_open) and isset($search_closed) and !strcmp($search_open, 'on') == 0 and strcmp($search_closed, 'on') == 0)
{
    $statuses = "Closed";
}
else if (isset($search_open) and isset($search_closed) and strcmp($search_open, 'on') == 0 and strcmp($search_closed, 'on') == 0)
{
    $statuses = "Open','Closed";
}
$query_prbs = mysqli_query($db, "SELECT * FROM problems left join users on prb_usr_id = usr_id where prb_status in ('" . $statuses . "') and usr_name like '%$search_name%' and usr_last_name like '%$search_last_name%' and prb_topic like '%$search_topic%' and usr_email like '%$search_email%' order by prb_date ");
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
                    <a class="nav-link" href="list-accounts.php">
                        <i class="fas fa-user"></i> Accounts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="list-species.php">
                        <i class="fas fa-frog"></i> Species
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="help-center.php">
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
                <div class="tm-problem-table-container">
                    <table class="table table-hover tm-table-small tm-product-table">
                        <thead>
                        <tr>
                            <th scope="col">&nbsp;</th>
                            <th scope="col">PROBLEMS LIST</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php
while ($row = mysqli_fetch_array($query_prbs))
{
?>
 
   <tr>
       <th scope="row"><input type="checkbox" name="delete[]" value="<?php echo $row['prb_id']; ?>"/></th>
       <td class="tm-product-name"><a href="/admin/help-center.php?id=<?php echo $row['prb_id']; ?>"> 
	   <?php
    echo $row['prb_topic'] . " - " . $row['prb_date'] . " - " . $row['usr_name'] . " " . $row['usr_last_name'] . " (" . $row['usr_email'] . ")";
?></td>
     </tr>

            <?php
}
?>
                        </tbody>
                    </table>
                </div>
 <?php
if (isset($prb_id))
{
    $query_prb = mysqli_query($db, "SELECT * FROM problems join users on prb_usr_id=usr_id where prb_id='$prb_id'");
    $row_p = mysqli_fetch_array($query_prb);
    $email = $row_p['usr_email'];
    $name = $row_p['usr_name'];
    $last_name = $row_p['usr_last_name'];
    $topic = $row_p['prb_topic'];
    $status = $row_p['prb_status'];
    $description = $row_p['prb_description'];
    $date = $row_p['prb_date'];

?>

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
                        <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="tm-block-title d-inline-block text-center">   <?php
    echo $topic . " (" . $date . ")"; ?> <br> <?php echo $name . " " . $last_name;
?></h2>
                                </div>
                            </div>
							<form action="edit-problem.php?id=<?php echo $prb_id; ?>" method="post" class="tm-edit-product-form">
                            <div class="row tm-edit-product-row">
                                <div class="col-6">
                                    
                                        <div class="form-group mb-3">
                                            <label
                                                    for="name"
                                            >Email
                                            </label>
                                            <div class="form-group mb-3">
                                                <textarea class="output" readonly><?php echo $email; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label
                                                    for="name"
                                            >Topic
                                            </label>
                                            <div id="name" class="form-group mb-3">
                                                <textarea class="output" readonly><?php echo $topic; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label
                                                    for="name"
                                            >Status
                                            </label>
                                            <div class="form-group mb-3">
                                                <textarea id="name" class="output" readonly><?php echo $status; ?></textarea>
                                            </div>
                                        </div>
<?php
    if (strcmp($status, 'Open') == 0)
    {
?>

                                        <button type="submit" value="ans" name="edit_problem" class="btn btn-primary btn-block text-uppercase">Send
                                            answer
                                        </button>
                                        <button type="submit" value="cls" name="edit_problem" class="btn btn-primary btn-block text-uppercase">Close
                                        </button>
<?php
    }
?>

                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label
                                                for="description"
                                        >Description</label
                                        >
                                        <div class="form-group mb-3">
                                            <textarea id="description" class="output-max"  readonly><?php echo $description; ?></textarea>
                                        </div>
                                    </div>
            <?php
    $query_ans = mysqli_query($db, "SELECT * FROM answers where ans_prb_id='$prb_id' order by ans_date");
    while ($row_a = mysqli_fetch_array($query_ans))
    {
?>
  				<div class="form-group mb-3">
                                 <textarea id="answer" class="output-max <?php if ($row_a['ans_admin'] == 0)
        {
            echo "client-ans";
        }
        else
        {
            echo "admin-ans";
        }; ?>" readonly> <?php echo $row_a['ans_text']; ?></textarea>
                                    </div>

<?php
    }
    if (strcmp($status, 'Open') == 0)
    {
?>
 				<div class="form-group mb-3">
                                        <label
                                                for="answer"
                                        >Answer</label
                                        >
                                        <textarea name="text" id="answer" class="output-max admin-ans" rows="8"></textarea>
                                    </div>
<?php
    }
?>
                                </div>

                            </div>
							</form>
                        </div>
                    </div>
                </div>
            <?php
}
?>

            </div>

        </div>

        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-block-col">
		<form action="help-center.php" method="post" class="tm-edit-product-form">
            <div class="tm-bg-primary-dark tm-block tm-block-product-categories">
                <h2 class="tm-block-title">Find Problem</h2>
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
                        <tr>
                            <td class="filter-field">Topic</td>
                            <td class="text-center">
                                <textarea name="search_topic" class="input-text"></textarea>
                            </td>
                        </tr>
<tr>
  
<td class="filter-field">Status</td>
                            <td class="text-center">
                               <input type="checkbox" id="status_open" name="search_open" checked>
				<label for="open">Open</label>
				<input type="checkbox" id="status_closed" name="search_closed">
				<label for="closed">Closed</label>

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
