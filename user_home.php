<?php
    require 'config/config.php';
    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <title>User Home</title>

    <!--CSS stylesheet and bootstrap-->
    <link rel="stylesheet" href="main.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>


<body>

    <!--Navbar-->
    
    
<div id="background">

        <div id="description">
            <div class="card text-center border-secondary">
                <h3 class="card-header">Welcome Home, username!</h3>
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

        
            <div class="col-md-4">
                <div class="card h-100 border-secondary">
                    <div class="card-body">
                        <h5 class="card-title"> title </h5>
                        <h6 class="card-subtitle mb-2"> country </h6>
                        <h6 class="card-subtitle mb-2 text-primary"> username </h6>

                        <div class="card-text">
                            
                            <p> summary </p>
                            <p>
                                <button class="btn btn-md btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#ofs<?php echo ID; ?>" aria-controls="offcanvasScrolling">
                                    Read more
                                </button>
                            </p>
                            <p class="mb0"><a href="edit_form.php?blog_id=<?php echo ID;?>" class="card-link">Edit this blog</a></p>
                            <p><a href="delete.php?blog_id=<?php echo ID;?>" class="card-link" onclick="return confirm('You are about to delete <?php echo TITLE; ?>.');">Delete this blog</a></p>
                        </div>

                        <div class="offcanvas offcanvas-bottom" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="ofs<?php echo ID;?>" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel"> title </h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <p> text </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- col end -->
        

        </div>  <!-- row end -->
    </div>  <!-- container-fluid end -->

    <div class="container-fluid" id="otherblog">

        <br>
        <br>

        <h3>Read Other Blogs</h3>

        <div class="row row-cols-1 row-cols-md-3 g-3">

        
            <div class="col-md-4">
                <div class="card h-100 border-secondary">
                    <div class="card-body">
                        <h5 class="card-title"> title </h5>
                        <h6 class="card-subtitle mb-2"> country </h6>
                        <h6 class="card-subtitle mb-2 text-primary"> username </h6>

                        <div class="card-text">
                            
                            <p> summary </p>
                            <p>
                                <button class="btn btn-md btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#ofs<?php echo ID;?>" aria-controls="offcanvasScrolling">
                                    Read more
                                </button>
                            </p>
                            
                        </div>

                        <div class="offcanvas offcanvas-bottom" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="ofs<?php echo ID;?>" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel"> <?php echo TITLE; ?> </h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <p> text </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- col end -->
        


        </div>  <!-- row end -->
    </div>  <!-- container-fluid end -->

</div>  <!-- background end -->



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>