<?php

// import packages
require("../connect-db.php");
require("user-db.php");

// remove user and password cookies
setcookie("user", "", time() - 3600, "/", ".virginia.edu"); 
setcookie("password", "", time() - 3600, "/", ".virginia.edu");

// Redirect the browser to another page using the header() function to specify the target URL
header('Location: http://www.cs.virginia.edu/~dch6auf/project/auth/login.php');
?>