<?php
require("../connect-db.php");
require("eatery-db.php");

if (isset($_POST['wifi_available_word'])) {
    session_start();
    $id = $_SESSION['id'];
    $wifi_available_word = $_POST['wifi_available_word'];
    $wifi_available = 0;
    echo($id);
    echo('HEEEELPPP');
    if($wifi_available_word == 'Yes'){
        $wifi_available = 1;
    }
    echo($wifi_available);
    addCafeBakery($id, $wifi_available);
    echo($wifi_available);
    header("Location: https://www.cs.virginia.edu/~yte9fbr/restaurant-buddy/index.php");
    exit();
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
                <h1>Adding a Cafe / Bakery<br />
                    <span style="color: hsl(218, 81%, 75%)">Restaurant Buddy</span>
                </h1>
                <p class="mb-4 opacity-70" style="color: hsl(158, 39%, 34%)">
                    You're almost done!
                </p>
            </div>
            <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                <div class="card bg-glass">
                    <div class="card-body px-4 py-5 px-md-5">
                        <form action="cafe-bakery.php" method="post">
                            <div class="form-outline mb-4"> 
                                <label class="form-label">Wifi Available (Yes/No)</label>
                                <input type="text" name="wifi_available_word" class="form-control" required/>
                            </div>
                            <!-- <form action="cafe-bakery.php" method="post"> -->
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <button type="submit" style="background-color: hsl(158, 39%, 34%);" class="btn w-100 btn-primary btn-block mb-4">
                                Finish
                            </button>
                        </form>
                        <p style="color: red;"><?php echo $_SESSION['error'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<body>
</html>