<?php
	session_start(); // Still need to start a session to destory session
	session_destroy(); // Destroys all existing session variables

	// Typically if you want to store when a user logged out, you would insert a record in the database the time they logged out
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Log Out | Safe Travel Planner</title>
    <link rel="icon" type="image/x-icon" href="img/logo.jpeg">

    <!--CSS stylesheet and bootstrap-->
    <link rel="stylesheet" href="main.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>


<body>
	<div class="container-fluid" id="page">

        <div class ="logo">
            <img src="img/logo.jpeg" id = "mem-img" alt="logo">
        </div>
        <br>
        <div class = "welcome">
            <h3>Log Out</h3>
            <p>You're now logged out.</p>

        </div>

        <div class="container">

            <div class="row mt-4 mb-4">
                <div class="col-sm-9 ml-sm-auto">
                    <a href="login.php">Log in again</a>
                </div> <!-- .col -->
                <div class="col-sm-9 ml-sm-auto">
                    <a href="main.php">Go back to the main page</a>
                </div> <!-- .col -->
            </div> <!-- .row -->

        </div> <!-- .container -->


	</div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>