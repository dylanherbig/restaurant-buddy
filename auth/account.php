<?php

// import packages
require("../connect-db.php");
require("user-db.php");
require("../eatery/eatery-db.php");
include("../header.php");

// check if user is logged in, if not redirect to login.php
$user = $_COOKIE["user"];
$password = $_COOKIE["password"];

if (strlen($password) == 0 or strlen($user) == 0 or !checkUserPassword($user, $password)) {
    // Redirect the browser to another page using the header() function to specify the target URL
    header('Location: https://www.cs.virginia.edu/~dch6auf/project/auth/login.php');
}

// profile
$profile_username = $_GET['username'];

// fetch created eateries and reviews 
$createdEateries = fetchCreatedEateries($profile_username);
$createdReviews = fetchCreatedReviews($profile_username);

// fetch user and reviewer profile
$user_profile = fetchUserProfile($profile_username);

// fetch average rating
$avg_rating = round(fetchAvgRating($profile_username)[0], 2);

// handle post requests
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $expertise = $_POST['expertise'];
    $bio = $_POST['bio'];

    updateUserProfile($profile_username, $full_name, $email, $expertise, $bio); // call function to update user profile

    // Redirect the browser to another page using the header() function to specify the target URL
    // header('Location: http://www.cs.virginia.edu/~dch6auf/project/auth/account.php?username=' + $profile_username);
}

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

    <title>Restaurant Buddy - Profile</title>
</head>

<body>
    <div id="header"></div>

    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <img src="https://cdn-icons-png.flaticon.com/512/3276/3276535.png" alt="Admin" class="rounded-circle align-self-center" width="150">
                        <div class="mt-3">
                            <?php
                                $full_name = $user_profile['full_name'];
                                $expertise = $user_profile["expertise"];
                                $reviewer_level = $user_profile["reviewer_level"];
                                $email = $user_profile["email"];
                                $bio = htmlentities($user_profile["bio"]);

                                if ($user == $profile_username) {
                                    echo "<form action='account.php' class='align-self-start' method='post'>
                                            <div class='form-outline mb-4 align-self-start'>
                                                <label class='form-label'>Full Name</label>
                                                <input type='text' name='full_name' class='form-control' value='$full_name' autofocus required />
                                            </div>
                                            <div class='form-outline mb-4'>
                                                <label class='form-label'>Email address</label>
                                                <input type='text' name='email' class='form-control' value='$email' required />
                                            </div>
                                            <div class='form-outline mb-4'>
                                                <label class='form-label'>Expertise</label>
                                                <input type='text' name='expertise' class='form-control' value='$expertise' required />
                                            </div>
                                            <div class='form-outline mb-4'>
                                                <label class='form-label'>Bio</label>
                                                <textarea name='bio' class='form-control' required />$bio</textarea>
                                            </div>
                                            <button type='submit' style='background-color: hsl(158, 39%, 34%);' class='btn w-100 btn-primary btn-block mb-4'>
                                                Save Changes
                                            </button>                            
                                    </form>";
                                } else {
                                    echo "<h4>$full_name</h4>";
                                    echo "<p class='text-secondary mb-1'>Expertise: $expertise</p>";
                                    echo "<p class='text-muted font-size-sm'>Average Rating: $avg_rating / 5</p>";
                                    echo "<p class='text-muted font-size-sm'>Reviewer Level: $reviewer_level</p>";
                                    echo "<p class='text-secondary mb-1' style='margin-top: -12px;'>$bio</p>";

                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <!-- <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5"> -->
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

        </div>
    </div>

</body>

</html>