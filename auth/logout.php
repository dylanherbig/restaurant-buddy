<?php

// import packages
require("../connect-db.php");
require("user-db.php");

// remove user and password cookies
setcookie("user", "", time() - 0); 
setcookie("password", "", time() - 0);

// Redirect the browser to another page using the header() function to specify the target URL
header('Location: https://www.cs.virginia.edu/~dch6auf/project/auth/login.php');
?>