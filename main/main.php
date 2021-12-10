<?php

	require 'config/config.php';

	// DB Connection.
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');

	//countries
	$sql = "SELECT * FROM countries;";
	$results = $mysqli -> query($sql);
	if (!$results){
		echo $mysqli -> error;
		exit();
	}

	// Close DB Connection
	$mysqli->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <title>Safe Travel Planner</title>

    <!--CSS stylesheet and bootstrap-->
    <link rel="stylesheet" href="main.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>


<body>

    <!--Navbar-->

        
    
    <div id="background">

        <div id="description">
            <div class="card text-center border-secondary">
                <h3 class="card-header">Welcome to Safe Travel Planner!</h3>
                <div class="card-body">
                    <h5 class="card-title">What is Safe Travel Planner?</h5>
                    <p class="card-text">-proj description-</p>
                    <a href="register_form.php" class="btn btn-primary">Create Your Account Here</a>
                </div>
            </div>
        </div>

        <!-- country select button? thingy here-->
        <div id ="select">
            <select class="form-select form-select-md" id="country-select">
                <option disabled>Select a country</option>
                <?php while( $row = $results->fetch_assoc() ): ?>
                    <?php if ($row['code'] == "US") : ?>
                        <option selected value="<?php echo $row['code']; ?>">
                            <?php echo $row['name']; ?>
                        </option>

                    <?php else: ?>
                        <option value="<?php echo $row['code']; ?>">
                            <?php echo $row['name']; ?>
                        </option>
                    <?php endif; ?>
                <?php endwhile; ?>
            </select>
        </div>


        <!-- Container starts -->

        <div class="container-fluid" id="covid_stats">
        <br>

            <h3>General Information Related to COVID-19</h3>
            
            <div class="row row-cols-1 row-cols-md-4 g-3">
                <div class="col-md-12">
                    <div class="card h-100 border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Summary</h5>
                            <div class="card-text" id="summary">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="row row-cols-1 row-cols-md-2 g-3">
                <div class="col-md-6">
                    <div class="card h-100 border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Fully Vaccinated</h5>
                            <div class="progress" id="fully">
                            </div>
                            <small class="text-muted" id="fully-date"></small>
                        </div>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="card h-100 border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Confirmed</h5>
                            <div class="card-text">
                                <p id="confirmed" class= "mb0"></p>
                                <small class="text-muted" id="confirmed-date"></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card h-100 border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Deaths</h5>
                            <div class="card-text">
                                <p id="deaths" class= "mb0"></p>
                                <small class="text-muted" id="deaths-date"></small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <br>

            <div class="row row-cols-1 row-cols-md-2 g-3">

                <div class="col-md-3">
                    <div class="card h-100 border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Infection Level</h5>
                            <div class="card-text">
                                <p id="infection-level" class= "mb0"></p>
                                <small class="text-muted" id="infection-date"></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Infection Rate</h5>
                            <p id="ratenum"></p>
                            <div class="progress" id="infection-rate">
                            </div>
                            <small class="text-muted" id="infection-date2"></small>
                        </div>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="card h-100 border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Disease Risk Level</h5>
                            <div class="card-text">
                                <p id="risklevel" class= "mb0"></p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <br>

            <div class="row row-cols-1 row-cols-md-2 g-3">

                <div class="col-md-12">
                    <div class="card h-100 border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Hotspot</h5>
                            <div class="card-text" id="hotspot">
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>
        <br>
        <br>
        </div> <!-- Covid stats container ends-->

        <div class="container-fluid" id="travel_restriction">

            <h3>Travel Restrictions</h3>
            <div class="row row-cols-1 row-cols-md-2 g-3">

            <div class="col-md-3">
                <div class="card h-100 border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Entry</h5>
                            <div class="card-text">
                                <p id="ban" class= "mb0"></p>
                                <p id="ban-maritime" class= "mb0"></p>
                                <p id="ban-land" class= "mb0"></p>
                                <p id="ban-air" class= "mb0"></p>
                                <p id="ban-enddate"></p>
                                <p class= "mb0 button">
                                    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling1" aria-controls="offcanvasScrolling">
                                        Read more
                                    </button>
                                </p>
                                <small class="text-muted" id="ban-date"></small>
                            </div>

                        <div class="offcanvas offcanvas-start" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="offcanvasScrolling1" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Entry</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body" id="ban-text">
                            </div>
                        </div>

                        

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Exit</h5>
                            <div class="card-text">
                                <p id="ban-type" class= "mb0"></p>
                                <p id="ban-spReq"></p>
                                <p class= "mb0 button">
                                    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling2" aria-controls="offcanvasScrolling">
                                        Read more
                                    </button>
                                </p>
                                <small class="text-muted" id="ban-date2"></small>
                            </div>


                        <div class="offcanvas offcanvas-start" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="offcanvasScrolling2" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Exit</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body" id="ban-text2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Disease Testing</h5>
                            <div class="card-text">
                                <p id="testing" class= "mb0"></p>
                                <p id="testing-age" class= "mb0"></p>
                                <p id="testing-when" class= "mb0"></p>
                                <p id="testing-type"></p>
                                <p class= "mb0 button">
                                    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#testing-scrolling" aria-controls="offcanvasScrolling">
                                        Read more
                                    </button>
                                </p>
                                <small class="text-muted" id="testing-date"></small>
                            </div>

                        <div class="offcanvas offcanvas-start" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="testing-scrolling" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Disease Testing</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body" id="ban-text3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card h-100 border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Declaration Documents</h5>
                            <div class="card-text">
                                <p id="doc" class= "mb0"></p>
                                <p id="doc-link1" class= "mb0"></p>
                                <p id="doc-link2"></p>
                                <p class= "mb0 button">
                                    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#doc-scrolling" aria-controls="offcanvasScrolling">
                                        Read more
                                    </button>
                                </p>
                                <small class="text-muted" id="doc-date"></small>
                            </div>

                        <div class="offcanvas offcanvas-start" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="doc-scrolling" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Declaration Documents</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body" id="doc-text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div> <!-- row ends here -->

        <br>

        <div class="row row-cols-1 row-cols-md-2 g-3">

            <div class="col-md-3">
                <div class="card h-100 border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Mask</h5>
                            <div class="card-text">
                                <p id="mask"></p>
                                <p class= "mb0 button">
                                    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#maskScrolling" aria-controls="offcanvasScrolling">
                                        Read more
                                    </button>
                                </p>
                                <small class="text-muted" id="mask-date"></small>
                            </div>

                        <div class="offcanvas offcanvas-start" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="maskScrolling" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Mask</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body" id="mask-text">
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Vaccination</h5>
                            <div class="card-text">
                                <p id="vax" class= "mb0"></p>
                                <p id="vax-policy" class= "mb0"></p>
                                <p>

                                    <div class="accordion" id="vax-accordion">

                                        <div class="accordion-item">
                                          <h6 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" style="padding: 7px; font-size: 15px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                              Qualified Vaccines 
                                            </button>
                                        </h6>
                                          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#vax-accordion">
                                            <div class="accordion-body" style="padding: 7px; font-size: 14px;">
                                                <ul style="padding-left: 20px; margin: 0;" id="vax-qual">
                                                </ul>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h6 class="accordion-header" id="headingTwo">
                                              <button class="accordion-button collapsed" style="padding: 7px; font-size: 15px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Accepted Certificates 
                                              </button>
                                          </h6>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#vax-accordion">
                                              <div class="accordion-body" style="padding: 7px; font-size: 14px;">
                                                  <ul style="padding-left: 20px; margin: 0;" id="vax-acce">
                                                  </ul>
                                              </div>
                                            </div>
                                          </div>

                                    </div>
                                </p>
                                <p class= "mb0 button">
                                    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#vaxScrolling" aria-controls="offcanvasScrolling">
                                        Read more
                                    </button>
                                </p>
                                <small class="text-muted" id="vax-date"></small>
                            </div>

                        <div class="offcanvas offcanvas-start" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="vaxScrolling" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Vaccination</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body" id="vax-text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Quarantine Modality</h5>
                            <div class="card-text">
                                <p id="qua-who" class= "mb0"></p>
                                <p id="qua-type" class= "mb0"></p>
                                <p id="qua-duration" class= "mb0"></p>
                                <p id="qua-link"></p>
                                <p class= "mb0 button">
                                    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#qua-scrolling" aria-controls="offcanvasScrolling">
                                        Read more
                                    </button>
                                </p>
                                <small class="text-muted" id="qua-date"></small>
                            </div>

                        <div class="offcanvas offcanvas-start" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="qua-scrolling" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Quarantine Modality</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body" id="qua-text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card h-100 border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Tracing Application</h5>
                            <div class="card-text">
                                <p id="trac" class= "mb0"></p>
                                <p>

                                    <div class="accordion" id="trac-accordion">

                                        <div class="accordion-item" id="trac-ios">
                                          <h6 class="accordion-header" id="heading1">
                                            <button class="accordion-button collapsed" style="padding: 7px; font-size: 15px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                              iOS URL
                                            </button>
                                        </h6>
                                          <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#trac-accordion">
                                            <div class="accordion-body" style="padding: 7px; font-size: 14px;">
                                                <ol style="padding-left: 20px; margin: 0;" id="ios-ul">
                                                </ol>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="accordion-item" id="trac-android">
                                            <h6 class="accordion-header" id="heading2">
                                              <button class="accordion-button collapsed" style="padding: 7px; font-size: 15px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                                Android URL 
                                              </button>
                                          </h6>
                                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#trac-accordion">
                                              <div class="accordion-body" style="padding: 7px; font-size: 14px;">
                                                  <ol style="padding-left: 20px; margin: 0;" id="and-ul">
                                                  </ol>
                                              </div>
                                            </div>
                                          </div>
                                    </div>
                                </p>
                                <p class= "mb0 button">
                                    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#trac-scrolling" aria-controls="offcanvasScrolling">
                                        Read more
                                    </button>
                                </p>
                                <small class="text-muted" id="trac-date"></small>
                            </div>

                        <div class="offcanvas offcanvas-start" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="trac-scrolling" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Tracing Application</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body" id="trac-text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div> <!-- row ends here -->
    <br>
    <br>
    </div> <!-- container-fluid travel_restriction ends here -->


    <div class="container-fluid" id="local_regulation">

        <!-- HERE -->
            <h3>Local Regulation</h3>

            <div class="row row-cols-1 row-cols-md-4 g-3">

                <div class="col-md-12">
                    <div class="card h-100 border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Local Area Policy</h5>
                                <div class="card-text">
                                    <p id="loc" class= "mb0"></p>
                                    <p id="loc-enddate" class= "mb0"></p>
                                    <p id="loc-link"></p>
                                    <div id="loc-text">
                                    </div>

                                    <small class="text-muted" id="loc-date"></small>
                                </div>
    
                        </div>
                    </div>
                </div>

            </div>

            <br>

            <!-- LOCAL REG CARDS START -->
            <div class="row row-cols-1 row-cols-md-4 g-3" id="local_reg_cards">
            </div>
            <!-- LOCAL REG CARDS END -->

        </div> <!--other container-fluid ends-->

        <div class="container-fluid" id="unavailable">
            <br>
            
            <div class="row row-cols-1 row-cols-md-4 g-3">
                <div class="col-md-12">
                    <div class="card h-100 border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">there is no information available for the country you selected.</h5>
                            <div class="card-text" id="summary">
                                <p>apologies for the inconvinience.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="container-fluid" id="share">
            <div class="row" id="r1_share">
                share!
            </div> 
        </div> <!--#share container-fluid ends-->
    </div>

    <script src="main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>