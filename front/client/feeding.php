<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Smartarrium - Feeding</title>
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
                            <b>Logout</b>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <!div class="row tm-content-row">
		<div class="tm-block-col tm-col-feeding-history">
		<div class="tm-bg-primary-dark tm-block tm-feeding-settings">
            <h2 class="tm-block-title">Time to next feeding</h2>
			<div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                        <div class="tm-product-img-edit mx-auto">
                    <p class="text-white">Select name</p>
                    <select class="custom-select">
                        <option value="0">Select name</option>
                        <option value="1">Name 1</option>
                        <option value="2">Name 2</option>
                        <option value="3">Name 3</option>
                        <option value="4">Name 4</option>
                    </select>
                        </div>
                    </div>
                <div class="form-group col-lg-12">
                    <input
                            id="date"
                            name="date"
                            type="text"
							value="2 days 3 hours"
                            class="form-control validate"
                            readonly
                    />
                </div>
        </div>
		</div>
        <div class="tm-block-col tm-col-feeding-history">
            <div class="tm-bg-primary-dark tm-block tm-block-history">
                <h2 class="tm-block-title">History</h2>
                <div class="tm-product-table-container">
                    <table class="table table-hover tm-table-small tm-product-table">
                        <thead>
                        <tr>
                            <th scope="col">&nbsp;</th>
                            <th scope="col">NAME</th>
                            <th scope="col">DATE</th>
                            <th scope="col">FOOD</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row"><input type="checkbox"/></th>
                            <td class="tm-product-name">Lorem Ipsum Species 1</td>
                            <td>28 March 2019</td>
                            <td>Food 1</td>
                            <td>
                                <a href="#" class="tm-product-delete-link">
                                    <i class="far fa-trash-alt tm-product-delete-icon"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><input type="checkbox"/></th>
                            <td class="tm-product-name">Lorem Ipsum Species 2</td>
                            <td>21 March 2019</td>
                            <td>Food 2</td>
                            <td>
                                <a href="#" class="tm-product-delete-link">
                                    <i class="far fa-trash-alt tm-product-delete-icon"></i>
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!div class="tm-block-col tm-col-feeding-settings">
        <div class="tm-bg-primary-dark tm-block tm-feeding-settings">
            <h2 class="tm-block-title">Feeding Information</h2>
            <form action="" class="tm-signup-form row">
                <div class="form-group col-lg-12">
                    <label for="name">Name</label>
                    <input
                            id="name"
                            name="name"
                            type="name"
                            class="form-control validate"
                    />
                </div>
                <div class="form-group col-lg-12">
                    <label for="date">Next feeding</label>
                    <input
                            id="date"
                            name="date"
                            type="date"
                            class="form-control validate"
                    />
                </div>
                <div class="form-group col-lg-12">
                    <label for="food">Food</label>
                    <input
                            id="food"
                            name="food"
                            type="name"
                            class="form-control validate"
                    />
                </div>
                <div class="form-group col-lg-12">
                    <label class="tm-hide-sm">&nbsp;</label>
                    <button
                            type="submit"
                            class="btn btn-primary btn-block"
                    >
                        Add
                    </button>
                </div>
            </form>
        </div>
        <!/div>
        <!/div>
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
