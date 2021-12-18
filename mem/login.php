
<?php
    require 'config/config.php';

    if ( !isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"] ){

        if ( isset($_POST['username']) && isset($_POST['password']) ){

            if ( empty($_POST['username']) || empty($_POST['password']) ){

                $error = "Please enter username and password";

            }
            else{
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                if($mysqli->connect_errno) {
                    echo $mysqli->connect_error;
                    exit();
                }
                $passwordInput = hash("sha256", $_POST["password"]);
			    $sql = "SELECT * FROM users
						WHERE username = '" . $_POST['username'] . "' AND password = '" . $passwordInput . "';";
                $results = $mysqli -> query($sql);

                if (!$results){
                    echo $mysqli -> error;
                    exit();
                }

                if ($results -> num_rows >0){
                    $_SESSION["logged_in"] = true;
				    $_SESSION["username"] = $_POST['username'];
                    $row = $results -> fetch_assoc();
                    //0 means they're not admin, and 1 means they are
                    $_SESSION["admin"] = $row['admin'];
                    $_SESSION["user_id"] = $row['id'];
                    header("Location: user_home.php");
                }
                else{
                    $error = "Invalid username or password.";
                }
            }
        }
    }
    else{
        // This user is logged in so they don't need to see this page. Redirect them to the homage page.
	    header("Location: user_home.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Log In | Safe Travel Planner</title>
    <link rel="icon" type="image/x-icon" href="img/logo.jpeg">

	<link rel="stylesheet" href="main.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>



	<div class="container-fluid" id ="page">

        <!-- logo and welcome message -->


        <div class ="logo">
            <img src="img/logo.jpeg" id = "mem-img" alt="logo">
        </div>

        <br>

        <div class = "welcome">
            <h3>Welcome Back!</h3>
            <p>Enter your credentials to access your account</p>
        </div>

        <br>

        <!-- Form -->

		<form action="login.php" method="POST" id="form">

            <div class="row mb-3">
				<div class="font-italic text-danger col-sm-9 ml-sm-auto">
					<!-- Show errors here. -->
					<?php
						if ( isset($error) && !empty($error) ) {
							echo $error;
						}
					?>
				</div>
			</div> <!-- .row -->

            <div class="col-mb-3 input form-group">
                <label for="username-id" class="form-label">Username<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="username-id" name="username">
                <small id="username-error" class="invalid-feedback">Username is required.</small>
            </div>

            <div class="col-mb-3 input form-group">
                <label for="password-id" class="form-label">Password<span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password-id" name="password">
                <small id="password-error" class="invalid-feedback">Password is required.</small>
            </div>

            <div class="row">
				<div class="ml-auto col-sm-9">
					<span class="text-danger font-italic">* Required</span>
				</div>
			</div> 

            <br>

            <button type="submit" class="btn btn-primary">Log In</button>
        
        </form>

            <div class="row">
				<div class="col-sm-9 ml-sm-auto">
					<a href="register_form.php">Register instead</a>
				</div>
			</div> 
            <div class="row">
				<div class="col-sm-9 ml-sm-auto">
					<a href="main.php">Go back to the main page</a>
				</div>
			</div> 
        

	</div> 

    <!-- <script>
        document.querySelector('#form').onsubmit = function(event){
			if ( document.querySelector('#username-id').value.trim().length == 0 ) {
                event.preventDefault();
				document.querySelector('#username-id').classList.add('is-invalid');
			} else {
				document.querySelector('#username-id').classList.remove('is-invalid');
			}
            if ( document.querySelector('#password-id').value.trim().length == 0 ) {
                event.preventDefault();
				document.querySelector('#password-id').classList.add('is-invalid');
			} else {
				document.querySelector('#password-id').classList.remove('is-invalid');
			}
        }
    </script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
