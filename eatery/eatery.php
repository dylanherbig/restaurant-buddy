<?php
require("../connect-db.php");
require("eatery-db.php");

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
                                <label class="form-label">Eatery Phone number</label>
                                <input type="text" name="email" class="form-control" required />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">Eatery description</label>
                                <input type="text" name="description" class="form-control" required />
                            </div>
                            <button type="submit" style="background-color: hsl(158, 39%, 34%);" class="btn w-100 btn-primary btn-block mb-4">
                                Add Eatery
                            </button>
                            <p style="color: red;"><?php echo $_SESSION['error'] ?></p>
                        </form>
                        <p>Back to Eateries <a href="index.php" style="color: hsl(158, 39%, 34%);"></a>Eateries</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<body>
</html>