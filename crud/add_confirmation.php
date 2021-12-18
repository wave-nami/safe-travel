<?php
    require 'config/config.php';


    if ( isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] ){   
        if ( (isset($_SESSION["username"]) && !empty($_SESSION["username"])) && (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) ){

            if ( !isset($_POST['title']) || empty($_POST['title'])
                || !isset($_POST['country']) || empty($_POST['country'])
                || !isset($_POST['summary']) || empty($_POST['summary']) 
                || !isset($_POST['text']) || empty($_POST['text']) ) {
                $error = "Please fill out all required fields.";
            }
            else{
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                if($mysqli->connect_errno){
                    echo $mysqli->connect_error;
                    exit();
                }

                // Add this information as a new record into the newly created users table
                $statement = $mysqli->prepare("INSERT INTO blogs (title, summary, text, country_id, user_id) VALUES(?,?,?,?,?)");
                $statement->bind_param("ssssi", $_POST["title"], $_POST["summary"], $_POST["text"], $_POST["country"], $_SESSION["user_id"]);
                $executed = $statement->execute();
                if(!$executed) {
                    echo $mysqli->error;
                }
                $statement->close();

                $mysqli -> close();
            }
        }
        else{
            session_destroy();
            header("Location: login.php");
        }
    }
    else{
        session_destroy();
        header("Location: login.php");
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <title>Add Confirmation | Safe Travel Planner</title>
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
            <h3>Add Confirmation</h3>
            
            <?php if ( isset($error) && !empty($error) ) : ?>
                <div class="text-danger"><?php echo $error; ?></div>
            <?php else : ?>
                <div class="text-success">
                    <span class="font-italic"><?php echo $_POST['title']; ?></span> was successfully added!
                </div>
            <?php endif; ?>

        </div>
        <br>

        <div class="container">

            <div class="row mt-4">
                <div class="col-12">
                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row mt-4 mb-4">
                <div class="col-12">
                    <a href="add_form.php" role="button" class="btn btn-primary">Write another Blog</a>
                </div> <!-- .col -->
                <div class="col-sm-9 ml-sm-auto">
                    <a href="main.php">Go back to the main page</a>
                </div> <!-- .col -->
                <div class="col-sm-9 ml-sm-auto">
                    <a href="user_home.php">Go back to the user home page</a>
                </div> <!-- .col -->
            </div> <!-- .row -->

        </div> <!-- .container -->


	</div> 


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>