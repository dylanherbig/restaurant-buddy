<?php

require("../connect-db.php");
require("user-db.php");

// When an HTML form is submitted to the server using the post method,
// its field data are automatically assigned to the implicit $_POST global array variable.
// PHP script can check for the presence of individual submission fields using
// a built-in isset() function to seek an element of a specified HTML field name.
// When this confirms the field is present, its name and value can usually be
// stored in a cookie. This might be used to stored username and password details
// to be used across a website


// Handle form submission.
// If username and passwasd have been entered, perform authentication.
// (for this activity, assume that we just check whether the data are entered, no sophisticated authentication is performed. 
if ($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['username']) > 0) {

   // If password is entered and contains only alphanumeric data, set cookies and redirect the user to survey instruction page;
   // otherwise, reject the password and force re-login.
   if (isset($_POST['password'])) {
      $password = trim($_POST['password']);
      if (!ctype_alnum($password))
         $_SESSION['error'] = "Password can only contain alphanumeric characters";
      else {

         $user = trim($_POST['username']);
         $result = checkCredentials($user, $password);

         if ($result[0]) {
            // setcookie(name, value, expiery-time)
            // setcookie() function stores the submitted fields' name/value pair
            setcookie('user', $user, time() + 3600, '/', '.virginia.edu');
            setcookie('password', $result[1], time() + 3600, '/', '.virginia.edu');   // store the password hash as a cookie

            // Redirect the browser to another page using the header() function to specify the target URL
            //header('Location: http://localhost/cs4750/restaurant-buddy/index.php');
         } else {
            $_SESSION['error'] = "Username or password incorrect";
         }  
      }
   }
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

   <title>Restaurant Buddy - Log In</title>
</head>

<body>

   <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
      <div class="row gx-lg-5 align-items-center mb-5">
         <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">

            <h1>Welcome to Restaurant Buddy<br />
               <span style="color: hsl(218, 81%, 75%)">for your business</span>
            </h1>
            <p class="mb-4 opacity-70" style="color: hsl(158, 39%, 34%)">
               Lorem ipsum dolor, sit amet consectetur adipisicing elit.
               Temporibus, expedita iusto veniam atque, magni tempora mollitia
               dolorum consequatur nulla, neque debitis eos reprehenderit quasi
               ab ipsum nisi dolorem modi. Quos?
            </p>

         </div>
         <div class="col-lg-6 mb-5 mb-lg-0 position-relative">

            <div class="card bg-glass">
               <div class="card-body px-4 py-5 px-md-5">
                  <form action="login.php" method="post">
                     <div class="form-outline mb-4">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" autofocus required />
                     </div>
                     <div class="form-outline mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required />
                        <a style="color: hsl(158, 39%, 34%);" href="">Forgot password?</a>
                     </div>
                     <div class="form-outline mb-4">
                        <button type="submit" style="background-color: hsl(158, 39%, 34%);" class="btn w-100 btn-primary btn-block mb-4">
                           Log In
                        </button>
                        <p style="color: red;"><?php echo $_SESSION['error'] ?></p>
                     </div>
                  </form>
                  <p>Don't have an account yet? <a href="register.php" style="color: hsl(158, 39%, 34%);">Create one now!</a></p>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>

</html>