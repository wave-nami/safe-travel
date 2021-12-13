<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ffffff;">
        <div class="container-fluid" id="nav-container">
            <a class="navbar-brand" href="#">
                <img id="nav-img" src="img/logo.jpeg" alt="" class="d-inline-block align-text-top">
                Safe Travel Planner
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="main.php">Main</a>
                <?php if(!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) :?>
                    <a class="nav-link" href="register_form.php">Register</a>
                    <a class="nav-link" href="login.php">Log In</a>
                <?php else: ?>
                    <a class="nav-link" href="user_home.php">User Home</a>
                    <a class="nav-link" href="logout.php">Log Out</a>

                <?php endif;?>
                    
                </div>
            </div>
        </div>
    </nav>