<?php
require("connect-db.php");
require("eatery/eatery-db.php");
require("auth/user-db.php");
include("header.html");

// check if user is logged in, if not redirect to login.php
$user = $_COOKIE["user"];
$password = $_COOKIE["password"];

if (strlen($password) == 0 or strlen($user) == 0 or !checkUserPassword($user, $password)) {
    echo("something");
    // Redirect the browser to another page using the header() function to specify the target URL
    header('Location: https://www.cs.virginia.edu/~dch6auf/project/auth/login.php');
}

// fetch all eateries
$list_of_eateries = getAllEateries();


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
    <title>Restaurant Buddy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
</head>

<body>
    <div id="header"></div>
    <div class="container">
        <h1>Restaurant Buddy</h1>

        <!-- <form name="mainForm" action="index.php" method="post">
            <div class="row mb-3 mx-3">
                Your name:
                <input type="text" class="form-control" name="friendname" required value="<?php echo $_POST['friendname_to_update']; ?>" />
            </div>
            <div class="row mb-3 mx-3">
                Major:
                <input type="text" class="form-control" name="major" required value="<?php echo $_POST['major_to_update']; ?>" />
            </div>
            <div class="row mb-3 mx-3">
                Year:
                <input type="text" class="form-control" name="year" required value="<?php echo $_POST['year_to_update']; ?>" />
            </div>
            <div class="row mb-3 mx-3">
                <input type="submit" value="Add friend" name="addBtn" class="btn btn-primary" title="Insert a friend into a friends table" />
            </div>
            <div class="row mb-3 mx-3">
                <input type="submit" value="Confirm update" name="confirmUpdateBtn" class="btn btn-secondary" title="Update a friend into a friends table" />
            </div>
        </form> -->

        <hr />
        <h3>List of eateries</h3>
        <div class="row justify-content-center">
            <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
                <thead>
                    <tr style="background-color:#B0B0B0">
                        <th width="30%">Name
                        <th width="30%">Email
                        <th width="30%">Description
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>


                <?php foreach ($list_of_eateries as $eatery) : ?>
                    <a href="/eatery.php?id=<?php echo $eatery['ID']; ?>">
                        <tr>
                            <td><?php echo $eatery['name']; ?></td> <!-- column name -->
                            <td><?php echo $eatery['email']; ?></td>
                            <td><?php echo $eatery['description']; ?></td>
                            <!-- <td>
                            <form action="simpleform.php" method="post">
                                <input type="submit" value="Update" name="updateBtn" class="btn btn-secondary" />
                                <input type="hidden" name="friendname_to_update" value="<?php echo $friend['name']; ?>" />
                                <input type="hidden" name="major_to_update" value="<?php echo $friend['major']; ?>" />
                                <input type="hidden" name="year_to_update" value="<?php echo $friend['year']; ?>" />
                            </form>
                        </td>
                        <td>
                            <form action="simpleform.php" method="post">
                                <input type="submit" name="deleteBtn" value="Delete" class="btn btn-danger" />
                                <input type="hidden" name="friendname_to_delete" value="<?php echo $friend['name']; ?>" />


                            </form>
                        </td> -->

                        </tr>
                    </a>
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