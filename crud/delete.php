<?php
if ( !isset($_GET['blog_id']) || empty($_GET['blog_id']) ) {
	echo "Invalid URL";
	exit();
}

require 'config/config.php';

if ( isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] ){   
    if ( (isset($_SESSION["username"]) && !empty($_SESSION["username"])) && (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) ){
        // DB Connection
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ( $mysqli->connect_errno ) {
            echo $mysqli->connect_error;
            exit();
        }

        //blogs
        $blog_sql = "SELECT * FROM blogs
        WHERE user_id =" . (int)$_SESSION['user_id'] . "
        AND blog_id = " . (int)$_GET['blog_id'] .";";

        $blog_results = $mysqli -> query($blog_sql);

        if (!$blog_results){
            echo $mysqli -> error;
            exit();
        }

        //if they're not admin, check if they are deleting their own
        if ($blog_results -> num_rows <= 0){
            if (!isset($_SESSION["admin"]) || !$_SESSION["admin"]){ //this user isn't admin
                echo "You cannot delete other people's blogs";
                exit();
            }
            else{ //this user is admin
                $notadminblog = true;
            }
        }

        //look up user email
        $user_sql = "SELECT users.email, blogs.title
        FROM users
        JOIN blogs
        ON blogs.user_id = users.id
        WHERE blog_id = " . $_GET['blog_id'] . ";";

        $user_results = $mysqli -> query($user_sql);
        $row = $user_results -> fetch_assoc();

        if (!$user_results){
        echo $mysqli -> error;
        exit();
        }

        //delete this blog
        $sql = "DELETE FROM blogs
			    WHERE blog_id = " . $_GET['blog_id'] . ";";

            $results = $mysqli->query($sql);
            if ( !$results ) {
                echo $mysqli->error;
                exit();
            }
        

        $mysqli->set_charset('utf8');

        // Close DB Connection
        $mysqli->close();
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

    <title>Delete Confirmation | Safe Travel Planner</title>
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
            <h3>Delete Confirmation</h3>
            
            <?php if ( isset($error) && !empty($error) ) : ?>
                <div class="text-danger"><?php echo $error; ?></div>
            <?php else : ?>
                <div class="text-success">
                    <span class="font-italic"> <?php echo $row['title']; ?> </span> was successfully deleted!
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
                    <?php if ( (!empty($notadminblog) && isset($notadminblog)) && ($_SESSION["admin"] && $notadminblog) ): ?>
                        <a href="mailto:<?php echo $row['email']; ?>?subject=Your Blog Post was Removed" target="_blank" role="button" class="btn btn-primary">Notify This User</a>
                    <?php else: ?>
                        <a href="add_form.php" role="button" class="btn btn-primary">Write Another Blog</a>
                    <?php endif; ?>
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