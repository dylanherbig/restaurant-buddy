<?php
require("connect-db.php");
require("eatery/eatery-db.php");
require("auth/user-db.php");
require("header.php");

// check if user is logged in, if not redirect to login.php
$user = $_COOKIE["user"];
$password = $_COOKIE["password"];

if (strlen($password) == 0 or strlen($user) == 0 or !checkUserPassword($user, $password)) {
    // Redirect the browser to another page using the header() function to specify the target URL
    header('Location: https://www.cs.virginia.edu/~dch6auf/project/auth/login.php');
}

// fetch all eateries
$list_of_eateries = fetchAllEateries();

// filter by cuisine type function 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filterCuisineBtn'])) {

    $selectedCuisine = $_POST['cuisineDropdown'];

    if ($selectedCuisine === "All") {
        $list_of_eateries = fetchAllEateries();
    } else {
        $list_of_eateries = filterCuisine($selectedCuisine);
    }
}

// filter by price function 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filterPriceBtn'])) {

    $selectedPrice = $_POST['priceDropdown'];

    if ($selectedPrice === "All") {
        $list_of_eateries = fetchAllEateries();
    } else {
        $list_of_eateries = filterPrice($selectedPrice);
    }
}

$cafeJoinClicked = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cafeJoinBtn'])) {

    $list_of_eateries = cafeJoin();
    $cafeJoinClicked = true;

}

$restaurantJoinClicked = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['restaurantJoinBtn'])) {

    $list_of_eateries = restaurantJoin();
    $restaurantJoinClicked = true;
    
}

$barJoinClicked = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['barJoinBtn'])) {

    $list_of_eateries = barJoin();
    $barJoinClicked = true;
    
}

$topTenClicked = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['topTenBtn'])) {

    $list_of_eateries = findTopTen();
    $topTenClicked = true;
    
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['resetBtn'])) {
    $list_of_eateries = fetchAllEateries();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['updateBtn'])) {
        echo $_POST['friendname_to_update'];
    } else if (!empty($_POST['confirmUpdateBtn'])) {
        updateFriendByName($_POST['friendname'], $_POST['major'], $_POST['year']);
        $list_of_friends = getAllFriends();    // name, major, year
    } else if (!empty($_POST['deleteBtn'])) {
        deleteFriend($_POST['friendname_to_delete']);
        $list_of_friends = getAllFriends();    // name, major, year
    } else if (!empty($_POST['addBtn'])) {
        addFriend($_POST['friendname'], $_POST['major'], $_POST['year']);
        $list_of_friends = getAllFriends();    // name, major, year
        // var_dump($list_of_friends);
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
    <title>Restaurant Buddy - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
</head>

<body>
    <div id="header"></div>
    <div class="container">
        <h1>Restaurant Buddy</h1>

        <div class="filter-container">
            <form method="post" action="index.php">
                <label for="cuisineDropdown">Filter by Cuisine:</label>
                <select name="cuisineDropdown" id="cuisineDropdown">
                    <option value="All">All</option>
                    <option value="American">American</option>
                    <option value="Italian">Italian</option>
                    <option value="Chinese">Chinese</option>
                    <option value="Indian">Korean</option>
                    <option value="Japanese">Japanese</option>
                    <option value="Thai">Thai</option>
                    <option value="Mediterranean">Mediterranean</option>
                    <option value="Mexican">Mexican</option>
                    <option value="Fast Food">Fast Food</option>

                </select>
                <button type="submit" name="filterCuisineBtn" class="btn btn-primary">Filter</button>
            </form>
        </div>

        <div class="filter-container">
            <form method="post" action="index.php">
                <label for="priceDropdown">Filter by Price:</label>
                <select name="priceDropdown" id="priceDropdown">
                    <option value="All">All</option>
                    <option value="$">$</option>
                    <option value="$$">$$</option>
                    <option value="$$$">$$$</option>

                </select>
                <button type="submit" name="filterPriceBtn" class="btn btn-primary">Filter</button>
            </form>
        </div>
        
        <div class="d-flex">
            <form method="post" action="index.php" class="mx-1">
                <button type="submit" name="cafeJoinBtn" class="btn btn-info"">Show Cafes</button>
            </form>

            <form method="post" action="index.php" class="mx-1">
                <button type="submit" name="restaurantJoinBtn" class="btn btn-info">Show Restaurants</button>
            </form>

            <form method="post" action="index.php" class="mx-1">
                <button type="submit" name="barJoinBtn" class="btn btn-info">Show Bars</button>
            </form>

            <form method="post" action="index.php" class="mx-1">
                <button type="submit" name="topTenBtn" class="btn btn-info">Top 10 Most Visited</button>
            </form>

            <form method="post" action="index.php" class="mx-1">
                <button type="submit" name="resetBtn" class="btn btn-secondary">Reset</button>
            </form>

        </div>
            

        <hr/>
        <h3>List of eateries</h3>
        <div class="row justify-content-center">
            <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
                <thead>
                    <tr style="background-color:#B0B0B0">
                        <th width="30%">Name
                        <th width="30%">Email
                        <th width="30%">Description
                        <th width="30%">Cuisine
                        <th width="30%">Price
                    
                        <?php if ($cafeJoinClicked) : ?>
                        <th width="30%">Wifi Available</th>
                        <?php endif; ?>

                        <?php if ($barJoinClicked) : ?>
                        <th width="30%">Happy Hour Time</th>
                        <?php endif; ?>

                        <?php if ($restaurantJoinClicked) : ?>
                        <th width="30%">Reservation Policy</th>
                        <th width="30%">Dress Code</th>
                        <?php endif; ?>

                        <?php if ($topTenClicked) : ?>
                        <th width="30%">Total Visitor Count </th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <style>
                        a:link {
                        color: blue;
                        text-decoration-line: underline;
                        }

                        /* visited link */
                        a:visited {
                        color: purple;
                        }

                </style>

                <?php foreach ($list_of_eateries as $eatery) : ?>
                        <tr>
                            <td>
                            <a href="eatery/eatery.php?id=<?php echo $eatery['ID']; ?>">
                                <?php echo $eatery['name']; ?>
                            </a>
                            </td> <!-- column name -->
                            <td><?php echo $eatery['email']; ?></td>
                            <td><?php echo $eatery['description']; ?></td>
                            <td><?php echo $eatery['cuisine']; ?></td>
                            <td><?php echo $eatery['price']; ?></td>

                            <?php if ($cafeJoinClicked) : ?>
                            <td><?php echo isset($eatery['wifi_available']) && $eatery['wifi_available'] == 1 ? 'Yes' : 'No'; ?></td>
                            <?php endif; ?>  

                            <?php if ($barJoinClicked) : ?>
                            <td><?php echo $eatery['happy_hour'] ?></td>
                            <?php endif; ?>  

                            <?php if ($restaurantJoinClicked) : ?>
                            <td><?php echo $eatery['reservation_policy'] ?></td>
                            <td><?php echo $eatery['dress_code'] ?></td>
                            <?php endif; ?>  

                            <?php if ($topTenClicked) : ?>
                            <td><?php echo $eatery['visits'] ?></td>
                            <?php endif; ?> 

                        </tr>
                    
                <?php endforeach; ?>
            </table>
        </div>



        <!-- CDN for JS bootstrap -->
        <!-- you may also use JS bootstrap to make the page dynamic -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

        <!-- for local -->
        <!-- <script src="your-js-file.js"></script> -->

    </div>

</body>

</html>