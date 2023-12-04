<?php
require("../connect-db.php");
require("eatery-db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['name']) > 0 && strlen($_POST['email']) > 0) {

    if (isset($_POST['name'])) {

        $email = trim($_POST['email']);
        $name = $_POST['name'];

        #Extract all the new attributes. As of now, we replace every value based on the extracted value below
        $new_description = $_POST['new_description'];
        $new_cuisine = $_POST['new_cuisine'];
        $new_street_address = $_POST['new_street_address'];
        $new_city = $_POST['new_city'];
        $new_state = $_POST['new_state'];
        $new_zip_code = $_POST['new_zip_code'];
        $new_phone = $_POST['new_phone'];


        updateEatery($name, $email, $new_description, $new_cuisine, $new_street_address, $new_city, $new_state, $new_zip_code, $new_phone); 
        // echo ("got there4");
        // header('Location: https://www.cs.virginia.edu/~yte9fbr/restaurant-buddy/index.php');

    }
}

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
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <div class="row gx-lg-5 align-items-center mb-5">
            <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">

                <h1>Update an Eatery<br />
                    <span style="color: hsl(218, 81%, 75%)">Restaurant Buddy</span>
                </h1>
                <p class="mb-4 opacity-70" style="color: hsl(158, 39%, 34%)">
                    Need to update an eatery on Restaurant Buddy?
                    Update it here!
                </p>

            </div>
            <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                <div class="card bg-glass">
                    <div class="card-body px-4 py-5 px-md-5">
                        <form action="update-eatery.php" method="post">
                            <div class="form-outline mb-4">
                                <label class="form-label">Eatery name</label>
                                <input type="text" name="name" class="form-control" required />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">Eatery email address</label>
                                <input type="text" name="email" class="form-control" required />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">New eatery description</label>
                                <input type="text" name="new_description" class="form-control" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">New cuisine</label>
                                <input type="text" name="new_cuisine" class="form-control" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">New street address</label>
                                <input type="text" name="new_street_address" class="form-control" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">New city</label>
                                <input type="text" name="new_city" class="form-control" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">New state</label>
                                <input type="text" name="new_state" class="form-control" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">New zip code</label>
                                <input type="text" name="new_zip_code" class="form-control" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">New phone</label>
                                <input type="text" name="new_phone" class="form-control" />
                            </div>
                            <button type="submit" style="background-color: hsl(158, 39%, 34%);" class="btn w-100 btn-primary btn-block mb-4">
                                Add Eatery
                            </button>
                            <p style="color: red;"><?php echo $_SESSION['error'] ?></p>
                        </form>
                        <p><a href="../index.php" style="color: hsl(158, 39%, 34%);">Back to Eateries</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<body>
</html>