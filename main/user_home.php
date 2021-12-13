<?php
    require 'config/config.php';
    //0 means they're not admin, and 1 means they are
    // echo $_SESSION["logged_in"];
    // echo $_SESSION["admin"];
    // echo $_SESSION["username"];
    //0 means they're not logged in, and 1 means they are
    // echo $_SESSION["logged_in"];
    // echo $_SESSION["user_id"];
    if ( isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] ){
        
        if ( (isset($_SESSION["username"]) && !empty($_SESSION["username"])) && (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) ){

            // DB Connection.
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if ( $mysqli->connect_errno ) {
                echo $mysqli->connect_error;
                exit();
            }

            $mysqli->set_charset('utf8');

            // my blog
            $myblog_sql = "SELECT blogs.title, countries.name AS country, users.username, blogs.summary, blogs.text, blogs.blog_id AS id
            FROM blogs
            JOIN countries
            ON countries.code = blogs.country_id
            JOIN users
            ON users.id = blogs.user_id
            WHERE 1=1
            AND users.id = " . $_SESSION["user_id"] . "; ";
            $myblog_results = $mysqli -> query($myblog_sql);
            if (!$myblog_results){
                echo $mysqli -> error;
                exit();
            }
            

            $otherblog_sql = "SELECT blogs.title, countries.name AS country, users.username, blogs.summary, blogs.text, blogs.blog_id AS id
            FROM blogs
            JOIN countries
            ON countries.code = blogs.country_id
            JOIN users
            ON users.id = blogs.user_id
            WHERE 1=1
            AND users.id != " . $_SESSION["user_id"] . "; ";
            $otherblog_results = $mysqli -> query($otherblog_sql);
            if (!$otherblog_results){
                echo $mysqli -> error;
                exit();
            }

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>User Home | Safe Travel Planner</title>
    <link rel="icon" type="image/x-icon" href="img/logo.jpeg">

    <!--CSS stylesheet and bootstrap-->
    <link rel="stylesheet" href="main.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>


<body>

    <!--Navbar-->
    <?php include 'config/nav.php'; ?>
    
<div id="background">

        <div id="description">
            <div class="card text-center border-secondary">
                <h3 class="card-header">Welcome Home, <?php echo $_SESSION["username"]; ?>!</h3>
                <div class="card-body">
                    <h5 class="card-title">Travel Blogs</h5>
                    <p class="card-text">Read / Write / Edit your experiences overseas.</p>
                    <a href="add_form.php" class="btn btn-primary">Write a New Blog</a>
                </div>
            </div>
        </div>

    <div class="container-fluid" id="userblog">

        <br>
        <br>

        <h3>Your Blogs</h3>

        <div class="row row-cols-1 row-cols-md-3 g-3">

        <?php while ($row_myblog = $myblog_results -> fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card h-100 border-secondary">
                    <div class="card-body">
                        <h5 class="card-title"> <?php echo $row_myblog['title']; ?> </h5>
                        <h6 class="card-subtitle mb-2"> <?php echo $row_myblog['country']; ?> </h6>
                        <h6 class="card-subtitle mb-2 text-primary"> <?php echo $row_myblog['username']; ?> </h6>

                        <div class="card-text">
                            
                            <p> <?php echo $row_myblog['summary']; ?> </p>
                            <p>
                                <button class="btn btn-md btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#ofs<?php echo $row_myblog['id'];?>" aria-controls="offcanvasScrolling">
                                    Read more
                                </button>
                            </p>
                            <p class="mb0"><a href="edit_form.php?blog_id=<?php echo $row_myblog['id'];?>" class="card-link">Edit this blog</a></p>
                            <p><a href="delete.php?blog_id=<?php echo $row_myblog['id'];?>" class="card-link" onclick="return confirm('You are about to delete <?php echo $row_myblog['title']; ?>.');">Delete this blog</a></p>
                        </div>

                        <div class="offcanvas offcanvas-bottom" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="ofs<?php echo $row_myblog['id'];?>" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel"> <?php echo $row_myblog['title']; ?> </h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <p> <?php echo $row_myblog['text']; ?> </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- col end -->
        <?php endwhile; ?>

        </div>  <!-- row end -->
    </div>  <!-- container-fluid end -->

    <div class="container-fluid" id="otherblog">

        <br>
        <br>

        <h3>Read Other Blogs</h3>

        <div class="row row-cols-1 row-cols-md-3 g-3">

        <?php while ($row_otherblog = $otherblog_results -> fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card h-100 border-secondary">
                    <div class="card-body">
                        <h5 class="card-title"> <?php echo $row_otherblog['title']; ?> </h5>
                        <h6 class="card-subtitle mb-2"> <?php echo $row_otherblog['country']; ?> </h6>
                        <h6 class="card-subtitle mb-2 text-primary"> <?php echo $row_otherblog['username']; ?> </h6>

                        <div class="card-text">
                            
                            <p> <?php echo $row_otherblog['summary']; ?> </p>
                            <p>
                                <button class="btn btn-md btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#ofs<?php echo $row_otherblog['id'];?>" aria-controls="offcanvasScrolling">
                                    Read more
                                </button>
                            </p>
                            <?php if ($_SESSION["admin"]): ?>
                                <p><a href="delete.php?blog_id=<?php echo $row_otherblog['id'];?>" class="card-link" onclick="return confirm('You are about to delete <?php echo $row_otherblog['title']; ?>.');" >Delete this blog</a></p>
                            <?php endif; ?>
                        </div>

                        <div class="offcanvas offcanvas-bottom" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="ofs<?php echo $row_otherblog['id'];?>" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel"> <?php echo $row_otherblog['title']; ?> </h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <p> <?php echo $row_otherblog['text']; ?> </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- col end -->
        <?php endwhile; ?>


        </div>  <!-- row end -->
    </div>  <!-- container-fluid end -->

</div>  <!-- background end -->



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>