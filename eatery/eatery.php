<?php
require("../connect-db.php");
require("eatery-db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['name']) > 0 && strlen($_POST['email']) > 0) {

    if (isset($_POST['name'])) {

        $email = trim($_POST['email']);
        $name = $_POST['name'];
        $description = $_POST['description'];
        $cuisine = $_POST['cuisine'];
        $street_address = $_POST['street_address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip_code = $_POST['zip_code'];
        $phone = $_POST['phone'];
        $price = $_POST['price'];

        #Generate a new unique ID for the eatery to be added
        $max_id = getMaxIDFromEatery();
        $new_id = 0;
        foreach ($max_id as $curr_id){
            $new_id = $curr_id['MAX(ID)'] + 1;
        }
        // echo($new_id); 

        // echo ("got here3");

        addEatery($new_id, $name, $email, $description, $cuisine, $street_address, $city, $state, $zip_code, $phone, $price); 
        // echo ("got there4");
        header('Location: https://www.cs.virginia.edu/~yte9fbr/restaurant-buddy/index.php');

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
                            <p style="color: red;"><?php echo $_SESSION['error'] ?></p>
                        </form>
                        <p>Want to update an existing Eatery? <a href="update-eatery.php" style="color: hsl(158, 39%, 34%);">Click here!</a></p>
                        <p><a href="../index.php" style="color: hsl(158, 39%, 34%);">Back to Eateries</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<body>
</html>