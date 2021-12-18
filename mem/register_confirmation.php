<?php
    require 'config/config.php';
    if ( !isset($_POST['email']) || empty($_POST['email'])
        || !isset($_POST['username']) || empty($_POST['username'])
        || !isset($_POST['password']) || empty($_POST['password']) ) {
        $error = "Please fill out all required fields.";
    }
    else{
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($mysqli->connect_errno){
            echo $mysqli->connect_error;
            exit();
        }

        //if the user exists
        $statement_registered = $mysqli->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $statement_registered->bind_param("ss", $_POST["username"], $_POST["email"]);
        $executed_registered = $statement_registered->execute();
        if(!$executed_registered) {
            echo $mysqli->error;
        }

        $statement_registered->store_result();
        $numrows = $statement_registered->num_rows;

        $statement_registered->close();

        // If we get ANY result back, it means this username or email is taken!
        if( $numrows > 0) {
            $error = "Username or email has been already taken. Please choose another one.";
        }
        else {
            //0 indicates that they're NOT admin
            $admin = 0;

            // checking if they got the admin-code right
            $adminCode = "A5wQSkfNn4";
            if ( isset($_POST['admin-code']) || !empty($_POST['admin-code'])) {
                if ($_POST['admin-code'] == $adminCode){
                    //1 indicates that they ARE admin
                    $admin = 1;
                }
            }

            // Hash the password
            $password = hash("sha256", $_POST["password"]);

            // Add this information as a new record into the newly created users table
            $statement = $mysqli->prepare("INSERT INTO users(username, email, password, admin) VALUES(?,?,?,?)");
            $statement->bind_param("sssi", $_POST["username"], $_POST["email"], $password, $admin);
            $executed = $statement->execute();
            if(!$executed) {
                echo $mysqli->error;
            }
            $statement->close();
        }

        $mysqli->close();

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Registeration Confirmation | Safe Travel Planner</title>
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
            <h3>User Registeration</h3>

            <?php if ( isset($error) && !empty($error) ) : ?>
                <div class="text-danger"><?php echo $error; ?></div>
            <?php else : ?>
                <div class="text-success"><?php echo $_POST['username']; ?> was successfully registered!</div>
            <?php endif; ?>

        </div>
        <br>

        <div class="container">

            <!-- <div class="row mt-4">
                <div class="col-12"> -->
                <!-- </div>  -->
                <!-- .col -->
                <!-- </div>  -->
                <!-- .row -->

            <div class="row mt-4 mb-4">
                <div class="col-12">
                    <?php if ( isset($error) && !empty($error) ) : ?>
                        <a href="register_form.php" role="button" class="btn btn-primary">Register</a>
                    <?php else : ?>
                        <a href="login.php" role="button" class="btn btn-primary">Login</a>
                    <?php endif; ?>
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