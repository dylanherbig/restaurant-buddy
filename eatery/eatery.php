<?php
require("../connect-db.php");
require("eatery-db.php");

$eatery = getEatery_byID($_GET['id']);

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

        <div>
            <h4>Rating: </h4>
            <input type="number" name="rating" min=1 max=5 value="<?php echo $rating;?>">
            <br>
            <h4>Review: </h4>
            <textarea name="review" rows="5" cols="40"><?php echo $review;?></textarea>
        </div>



        <!-- CDN for JS bootstrap -->
        <!-- you may also use JS bootstrap to make the page dynamic -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

        <!-- for local -->
        <!-- <script src="your-js-file.js"></script> -->

    </div>
</body>