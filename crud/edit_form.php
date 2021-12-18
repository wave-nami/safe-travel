<?php
if ( !isset($_GET['blog_id']) || empty($_GET['blog_id']) ) {
	echo "Invalid URL";
	exit();
}

require 'config/config.php';
    // var_dump($_GET);
    // var_dump($_SESSION);

if ( isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] ){   
    if ( (isset($_SESSION["username"]) && !empty($_SESSION["username"])) && (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) ){
        // DB Connection
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ( $mysqli->connect_errno ) {
            echo $mysqli->connect_error;
            exit();
        }

        //countries
        $country_sql = "SELECT * FROM countries;";
        $country_results = $mysqli -> query($country_sql);
        if (!$country_results){
            echo $mysqli -> error;
            exit();
        }

        //blogs
        // "AND user_id = " . (int)$_SESSION['user_id'] . 

        $blog_sql = "SELECT * FROM blogs
                    WHERE user_id =" . (int)$_SESSION['user_id'] . "
                    AND blog_id = " . (int)$_GET['blog_id'] .";";


        $blog_results = $mysqli -> query($blog_sql);
        
        
        if (!$blog_results){
            echo $mysqli -> error;
            exit();
        }

        $blog_row = $blog_results->fetch_assoc();
        // var_dump($blog_row);

        if ($blog_results -> num_rows <= 0){
            echo "You cannot edit other people's blogs";
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
    
    <title>Edit Your Blog | Safe Travel Planner</title>
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
            <h3>Edit Your Blog</h3>
            <p>Please fill out all required fields</p>
        </div>
        <br>

		<form action="edit_confirmation.php" method="POST">

            <div class="col-mb-3 form-group input">
                <label for="title-id" class="form-label">Title<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title-id" aria-describedby="titleHelp" name="title" value="<?php echo $blog_row['title']; ?>">
                <small id="title-error" class="invalid-feedback">Title is required.</small>
            </div>

            <div class="col-mb-3 form-group input">
                <label for="country-id" class="form-label">Country<span class="text-danger">*</span></label>
                <select class="form-control form-select" id="country-id" aria-describedby="countryHelp" name="country">
                    <option disabled>Select a country</option>
                    <?php while( $row = $country_results->fetch_assoc() ): ?>

                        <?php if ( $row['code'] == $blog_row['country_id'] ) : ?>

                        <option selected value="<?php echo $row['code']; ?>">
                            <?php echo $row['name']; ?>
                        </option>

                        <?php else : ?>

                        <option value="<?php echo $row['code']; ?>">
                            <?php echo $row['name']; ?>
                        </option>

                        <?php endif; ?>
                    
                    <?php endwhile; ?>
                </select>
                <small id="country-error" class="invalid-feedback">Country is required.</small>
            </div>

            <div class="col-mb-3 form-group input">
                <label for="summary-id" class="form-label">Summary<span class="text-danger">*</span></label>
                <textarea type="text" class="form-control" id="summary-id" aria-describedby="summaryHelp" name="summary" rows="3"><?php echo $blog_row['summary']; ?></textarea>
                <small id="summary-error" class="invalid-feedback">Summary is required.</small>
            </div>

            <div class="col-mb-3 form-group input">
                <label for="text-id" class="form-label">Text<span class="text-danger">*</span></label>
                <textarea type="text" class="form-control" id="text-id" aria-describedby="textHelp" name="text" rows="6"><?php echo $blog_row['text']; ?></textarea>
                <small id="text-error" class="invalid-feedback">Text is required.</small>
            </div>

            <div class="row">
				<div class="ml-auto col-sm-9">
					<span class="text-danger font-italic">* Required</span>
				</div>
			</div> 

            <br>

            <button type="submit" class="btn btn-primary">Confirm Changes</button>

            <div class="row">
				<div class="col-sm-9 ml-sm-auto">
					<a href="main.php">Go back to the main page</a>
				</div>
			</div> 

            <div class="row">
				<div class="col-sm-9 ml-sm-auto">
					<a href="user_home.php">Go back to the user home page</a>
				</div>
			</div>
            
            <input type="hidden" name="blog_id" value="<?php echo $_GET['blog_id']; ?>">

        </form>

	</div> 

    <script>
		document.querySelector('form').onsubmit = function(){

			if ( document.querySelector('#title-id').value.trim().length == 0 ) {
				document.querySelector('#title-id').classList.add('is-invalid');
			} else {
				document.querySelector('#title-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#country-id').value.trim().length == 0 ) {
				document.querySelector('#country-id').classList.add('is-invalid');
			} else {
				document.querySelector('#country-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#summary-id').value.trim().length == 0 ) {
				document.querySelector('#summary-id').classList.add('is-invalid');
            }
            else {
				document.querySelector('#summary-id').classList.remove('is-invalid');
			}

            if ( document.querySelector('#text-id').value.trim().length == 0 ) {
				document.querySelector('#text-id').classList.add('is-invalid');
            }
            else {
				document.querySelector('#text-id').classList.remove('is-invalid');
			}

			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>