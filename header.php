<?php 

// check if user is logged in, if not redirect to login.php
$user = $_COOKIE["user"];
$password = $_COOKIE["password"];

if (strlen($password) == 0 or strlen($user) == 0 or !checkUserPassword($user, $password)) {
    // Redirect the browser to another page using the header() function to specify the target URL
    header('Location: https://www.cs.virginia.edu/~dch6auf/project/auth/login.php');
}


?>

<header>
    <link href="static/css/header.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <nav class="navbar navbar-expand-md ">
        <div class="container-fluid">
            <a class="navbar-brand" href="/~dch6auf/project/index.php">Restaurant Buddy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar"
                aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/~dch6auf/project/invites.php">Invites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/~dch6auf/project//eatery/add-eatery.php">Add Eateries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/~dch6auf/project/auth/account.php?username=<?php echo $user ?>"><i class="fa fa-fw fa-user"></i> Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary bg-white" href="https://www.cs.virginia.edu/~dch6auf/project/auth/logout.php">
                            Log Out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>