<?php?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Registeration | Safe Travel Planner</title>
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
            <h3>Welcome!</h3>
            <p>Enter your credentials to create your account</p>
        </div>
        <br>

		<form action="register_confirmation.php" method="POST">

            <div class="col-mb-3 form-group input">
                <label for="email-id" class="form-label">Email address<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email-id" aria-describedby="emailHelp" name="email">
                <small id="email-error" class="invalid-feedback">Email is required.</small>
            </div>

            <div class="col-mb-3 form-group input">
                <label for="username-id" class="form-label">Username<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="username-id" aria-describedby="usernameHelp" name="username">
                <small id="username-error" class="invalid-feedback">Username is required.</small>
            </div>

            <div class="col-mb-3 form-group input">
                <label for="password-id" class="form-label">Password<span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password-id" name="password">
                <div class="col-auto">
                    <!-- <span id="passwordHelpInline" class="form-text">
                        Must be 8-20 characters long.
                    </span> -->
                </div>
                <small id="password-error" class="invalid-feedback">Password is required.</small>
            </div>

            <div class="col-mb-3 form-group input">
                <label for="admin-id" class="form-label">Admin Code</label>
                <input type="text" class="form-control" id="admin-id" aria-describedby="usernameHelp" name="admin-code">
            </div>

            <div class="row">
				<div class="ml-auto col-sm-9">
					<span class="text-danger font-italic">* Required</span>
				</div>
			</div> 

            <br>

            <button type="submit" class="btn btn-primary">Register</button>

            <div class="row">
				<div class="col-sm-9 ml-sm-auto">
					<a href="login.php">Log In instead</a>
				</div>
			</div> 

            <div class="row">
				<div class="col-sm-9 ml-sm-auto">
					<a href="main.php">Go back to the main page</a>
				</div>
			</div> 
        </form>

	</div> 

    <script>
		document.querySelector('form').onsubmit = function(){

			if ( document.querySelector('#username-id').value.trim().length == 0 ) {
				document.querySelector('#username-id').classList.add('is-invalid');
			} else {
				document.querySelector('#username-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#email-id').value.trim().length == 0 ) {
				document.querySelector('#email-id').classList.add('is-invalid');
			} else {
				document.querySelector('#email-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#password-id').value.trim().length == 0 ) {
				document.querySelector('#password-id').classList.add('is-invalid');
            }
            else {
				document.querySelector('#password-id').classList.remove('is-invalid');
			}

			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>