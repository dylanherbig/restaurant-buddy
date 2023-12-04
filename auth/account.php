<?php

// import packages
require("../connect-db.php");
require("user-db.php");
require("../eatery/eatery-db.php");
include("../header.html");

// check if user is logged in, if not redirect to login.php
$user = $_COOKIE["user"];
$password = $_COOKIE["password"];

if (strlen($password) == 0 or strlen($user) == 0 or !checkUserPassword($user, $password)) {
    // Redirect the browser to another page using the header() function to specify the target URL
    header('Location: https://www.cs.virginia.edu/~dch6auf/project/auth/login.php');
}

// fetch created eateries and reviews 
$createdEateries = fetchCreatedEateries($user);
$createdReviews = fetchCreatedReviews($user);

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../static/css/auth.css" rel="stylesheet" crossorigin="anonymous" />

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>Restaurant Buddy - Account</title>
</head>

<body>
    <div id="header"></div>

    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <div class="card bg-glass">
            <div class="card-body px-4 py-5 px-md-5">
                <h3>My Eateries</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">E-Mail</th>
                            <th scope="col">Cuisine</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($createdEateries as $eatery) {
                            $id = $eatery['id']; // extract id 

                            echo "<tr>";
                            echo "<td>{$eatery['name']}</td>";
                            echo "<td>{$eatery['email']}</td>";
                            echo "<td>{$eatery['cuisine']}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <h3>My Reviews</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Eatery</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Rating</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($createdReviews as $review) {
                            $id = $eatery['id']; // extract id 

                            echo "<tr>";
                            echo "<td>{$review['name']}</td>";
                            echo "<td>{$review['comment']}</td>";
                            echo "<td>{$review['number_rating']}/5</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>

</html>