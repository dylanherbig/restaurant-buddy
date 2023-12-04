<?php
require("../connect-db.php");
require("../auth/user-db.php");
require("eatery-db.php");
require("../header.php");

// check if user is logged in, if not redirect to login.php
$user = $_COOKIE["user"];
$password = $_COOKIE["password"];

if (strlen($password) == 0 or strlen($user) == 0 or !checkUserPassword($user, $password)) {
    // Redirect the browser to another page using the header() function to specify the target URL
    header('Location: https://www.cs.virginia.edu/~dch6auf/project/auth/login.php');
}

$eatery = getEatery_byID($_GET['id']);
$eateryReviews = fetchCreatedReviews_byEateryID($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['name']) > 0 && strlen($_POST['email']) > 0) {

//     if (isset($_POST['name'])) {

//         $email = trim($_POST['email']);
//         $name = $_POST['name'];
//         $description = $_POST['description'];
//         $cuisine = $_POST['cuisine'];
//         $street_address = $_POST['street_address'];
//         $city = $_POST['city'];
//         $state = $_POST['state'];
//         $zip_code = $_POST['zip_code'];
//         $phone = $_POST['phone'];
//         $price = $_POST['price'];

//         #Generate a new unique ID for the eatery to be added
//         $max_id = getMaxIDFromEatery();
//         $new_id = 0;
//         foreach ($max_id as $curr_id){
//             $new_id = $curr_id['MAX(ID)'] + 1;
//         }
//         // echo($new_id); 

//         // echo ("got here3");

//         addEatery($new_id, $name, $email, $description, $cuisine, $street_address, $city, $state, $zip_code, $phone, $price); 
//         // echo ("got there4");
//         header('Location: https://www.cs.virginia.edu/~yte9fbr/restaurant-buddy/index.php');

//     }
// }



    // If username contains only alphanumeric data, proceed to verify the password;
    // otherwise, reject the username and force re-login.
    

    // // If password is entered and contains only alphanumeric data, set cookies and redirect the user to survey instruction page;
    // // otherwise, reject the password and force re-login.
    // if (isset($_POST['name'])) {

    //     $email = trim($_POST['email']);
    //     $name = $_POST['name'];
    //     $description = $_POST['description'];

    //     // if (getEatery($name, $email)) {
    //     //     $_SESSION["error"] = "Eatery has already been added";
    //     } else {
    //         addEatery($name, $email, $description);  
    //             // Redirect the browser to another page using the header() function to specify the target URL
    //             header('Location: https://www.cs.virginia.edu/~yte9fbr/restaurant-buddy/index.php');
    //     }
    // }
// }
}
?>

<?php

#Generate a new unique ID for the review to be added
$max_id = getMaxIDFromReview();
$new_id = 0;
foreach ($max_id as $curr_id){
    $new_id = $curr_id['MAX(ID)'] + 1;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
   if (!empty($_POST['addBtn']))
   {
      addReview($new_id, $_POST['reviewer_username'], $_POST['eateryID'], $_POST['createdAt'], $_POST['comment'], $_POST['number_rating']);
      $eateryReviews = fetchCreatedReviews_byEateryID($_GET['id']);

   }
}



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="your name">
    <meta name="description" content="include some description about your page">
    <title>Restaurant Buddy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
</head>

<body>
    <div id="header"></div>
    <div class="container">
    <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
        <thead>
            <tr style="background-color:#B0B0B0"></tr>
        </thead>
        <h1>Restaurant Buddy</h1>

        <!-- <form name="mainForm" action="index.php" method="post">
            <div class="row mb-3 mx-3">
                Your name:
                <input type="text" class="form-control" name="friendname" required value="<?php //echo $_POST['friendname_to_update']; ?>" />
            </div>
            <div class="row mb-3 mx-3">
                Major:
                <input type="text" class="form-control" name="major" required value="<?php //echo $_POST['major_to_update']; ?>" />
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <div class="row gx-lg-5 align-items-center mb-5">
            <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                <h1>Add an Eatery<br />
                    <span style="color: hsl(218, 81%, 75%)">Restaurant Buddy</span>
                </h1>
                <p class="mb-4 opacity-70" style="color: hsl(158, 39%, 34%)">
                    Do you know of an eatery that isn't already on our site?
                    Add it here - All you need are the eatery's name, email, and a short description!
                </p>
            </div>
            <div class="col-lg-6 mb-5 mb-lg-0 position-relative">

                <div class="card bg-glass">
                    <div class="card-body px-4 py-5 px-md-5">
                        <form action="eatery.php" method="post">
                            <div class="form-outline mb-4">
                                <label class="form-label">Eatery name</label>
                                <input type="text" name="name" class="form-control" required />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">Eatery email address</label>
                                <input type="text" name="email" class="form-control" required />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">Eatery description</label>
                                <input type="text" name="description" class="form-control" required />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">Category (cafe_bakery, bar, restaurant, eatery)</label>
                                <input type="text" name="category" class="form-control"/>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">Cuisine</label>
                                <input type="text" name="cuisine" class="form-control" required/>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">Street address</label>
                                <input type="text" name="street_address" class="form-control" required/>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" required/>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">State</label>
                                <input type="text" name="state" class="form-control" required/>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">Zip code</label>
                                <input type="text" name="zip_code" class="form-control" required/>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" required/>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">Price</label>
                                <input type="text" name="price" class="form-control" required/>
                            </div>
                            <button type="submit" style="background-color: hsl(158, 39%, 34%);" class="btn w-100 btn-primary btn-block mb-4">
                                Add Eatery
                            </button>
                            <p style="color: red;"><?php //echo $_SESSION['error'] ?></p>
                        </form>
                        <p>Want to update an existing Eatery? <a href="update-eatery.php" style="color: hsl(158, 39%, 34%);">Click here!</a></p>
                        <p><a href="../index.php" style="color: hsl(158, 39%, 34%);">Back to Eateries</a></p>
                    </div>
                </div>
            </div>
            <div class="row mb-3 mx-3">
                Year:
                <input type="text" class="form-control" name="year" required value="<?php //echo $_POST['year_to_update']; ?>" />
            </div>
            <div class="row mb-3 mx-3">
                <input type="submit" value="Add friend" name="addBtn" class="btn btn-primary" title="Insert a friend into a friends table" />
            </div>
            <div class="row mb-3 mx-3">
                <input type="submit" value="Confirm update" name="confirmUpdateBtn" class="btn btn-secondary" title="Update a friend into a friends table" />
            </div>
        </form> -->

        <hr />
        <h3><?php echo $eatery[0]['name']; ?></h3>
        <div class="row justify-content-center">
            <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
                    <tr><?php //echo count($eatery); ?></tr>
                    <?php //print_r(array_values($eatery)); ?>
                    <tr><?php //echo $eatery[0]['cuisine']; ?></tr>

                    <tr><td><?php //echo $eatery[0]['name']; ?></td></tr>
                    <tr><td><?php echo $eatery[0]['cuisine']; ?></td></tr>
                    <tr><td><?php echo $eatery[0]['price']; ?></td></tr>
                    <tr><td><?php echo $eatery[0]['street_address']; ?></td></tr>
                    <tr><td><?php echo $eatery[0]['city']; ?></td></tr>
                    <tr><td><?php echo $eatery[0]['state']; ?></td></tr>
                    <tr><td><?php echo $eatery[0]['zip_code']; ?></td></tr>
                    <tr><td><?php echo $eatery[0]['phone']; ?></td></tr>
                    <tr><td><?php echo $eatery[0]['total_reviews']; ?></td></tr>
            </table>
        <br><br>

        <!-- <div>
            <h4>Rating: </h4>
            <input type="number" name="rating" min=1 max=5 value="<?php //echo $rating;?>">
            <br>
            <h4>Review: </h4>
            <textarea name="review" rows="5" cols="40"><?php //echo $review;?></textarea>
        </div> -->

        <form name="addReview" action="eatery.php?id=<?php echo $_GET['id']; ?>" method="post">
            <div class="row mb-3 mx-3">
                Reviewer Username:
                <input type="text" class="form-control" name="reviewer_username" value="<?php echo $_COOKIE["user"];?>">        
            </div>
            <div class="row mb-3 mx-3">
                Eatery ID:
                <input type="number" class="form-control" name="eateryID" value="<?php echo $_GET['id']; ?>">        
            </div>
            <div class="row mb-3 mx-3">
                Created At:
                <input type="text" class="form-control" name="createdAt" value="<?php $t=time(); echo(date("Y-m-d",$t));?>">        
            </div>
            <div class="row mb-3 mx-3">
                Dined Here?:
                <input type="checkbox" name="dinesAt" value="">
            </div>
            <div class="row mb-3 mx-3">
                Rating:
                <input type="number" class="form-control" name="number_rating" min=1 max=5 value="<?php //echo $rating;?>">        
            </div>  

            <div class="row mb-3 mx-3">
                Review:
                <textarea type="text" class="form-control" name="comment" required ></textarea>        
            </div>    
            <div class="row mb-3 mx-3">
                <input type="submit" value="Add Review" name="addBtn" 
                        class="btn btn-primary" title="insert into reviews table" />
            </div>
        </form>
        
<!-- dined here y/n. insert into dinesAt table  dines_at(eateryID, username)-->

        <h3>My Reviews</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Eatery</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Written By</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($eateryReviews as $review) {
                    //echo $eatery['id']; // extract id 

                    echo "<tr>";
                    echo "<td>{$review['name']}</td>";
                    echo "<td>{$review['comment']}</td>";
                    echo "<td>{$review['number_rating']}/5</td>";
                    echo "<td><a href='/~dch6auf/project/auth/account.php?username={$review['reviewer_username']}'>{$review['reviewer_username']}</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>




        <!-- CDN for JS bootstrap -->
        <!-- you may also use JS bootstrap to make the page dynamic -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

        <!-- for local -->
        <!-- <script src="your-js-file.js"></script> -->

    </div>
</body>