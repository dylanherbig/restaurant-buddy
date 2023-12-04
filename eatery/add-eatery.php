<?php
require("../connect-db.php");
require("eatery-db.php");

if (isset($_POST['name'])) {
    echo("1");

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
    $category = $_POST['category'];

    #Generate a new unique ID for the eatery to be added
    $max_id = getMaxIDFromEatery();
    $new_id = 0;
    foreach ($max_id as $curr_id){
        $new_id = $curr_id['MAX(ID)'] + 1;
    }
    
    addEatery($new_id, $name, $email, $description, $cuisine, $street_address, $city, $state, $zip_code, $phone, $price); 
    if ($category == "Bar") {
        session_start();
        $_SESSION['id'] = $new_id;
        header("Location: https://www.cs.virginia.edu/~yte9fbr/restaurant-buddy/eatery/bar.php");
        exit();
    } else if ($category == "Cafe-Bakery") {
        session_start();
        $_SESSION['id'] = $new_id;
        header('Location: https://www.cs.virginia.edu/~yte9fbr/restaurant-buddy/eatery/cafe-bakery.php');
        exit();
    } else if ($category == "Restaurant") {
        session_start();
        $_SESSION['id'] = $new_id;
        header('Location: https://www.cs.virginia.edu/~yte9fbr/restaurant-buddy/eatery/restaurant.php');
        exit();
    } else {
        header('Location: https://www.cs.virginia.edu/~yte9fbr/restaurant-buddy/index.php');
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
                        <form action="add-eatery.php" method="post">
                            <div class="form-outline mb-1">
                                <label class="form-label">Eatery name</label>
                                <input type="text" name="name" class="form-control" required />
                            </div>
                            <div class="form-outline mb-1">
                                <label class="form-label">Eatery email address</label>
                                <input type="text" name="email" class="form-control" required />
                            </div>
                            <div class="form-outline mb-1">
                                <label class="form-label">Eatery description</label>
                                <input type="text" name="description" class="form-control" required />
                            </div>
                            <div class="form-outline mb-1">
                                <label class="form-label">Street address</label>
                                <input type="text" name="street_address" class="form-control" required/>
                            </div>
                            <div class="form-outline mb-1">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" required/>
                            </div>
                            <div class="form-outline mb-1">
                                <label class="form-label">State</label>
                                <input type="text" name="state" class="form-control" required/>
                            </div>
                            <div class="form-outline mb-1">
                                <label class="form-label">Zip code</label>
                                <input type="text" name="zip_code" class="form-control" required/>
                            </div>
                            <div class="form-outline mb-1">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" required/>
                            </div>
                            <div class="form-outline mb-2">
                                <div class="filter-container">
                                    <label for="category">Eatery Type </label>
                                    <select name="category" id="category">
                                        <option value="Eatery">Just an Eatery</option>
                                        <option value="Cafe-Bakery">Cafe or Bakery</option>
                                        <option value="Bar">Bar</option>
                                        <option value="Restaurant">Restaurant</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-outline mb-2">
                                <div class="filter-container">
                                    <label for="cuisine">Cuisine </label>
                                    <select name="cuisine" id="cuisine">
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
                                </div>
                            </div>
                            <div class="form-outline mb-2">
                                <div class="filter-container">
                                    <label for="price">Price </label>
                                    <select name="price" id="price">
                                        <option value="$">$</option>
                                        <option value="$$">$$</option>
                                        <option value="$$$">$$$</option>
                                        <option value="$$$$">$$$$</option>
                                    </select>
                                </div>
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