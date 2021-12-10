//FUNCTION for displaying results
function display(results){
    let converted = JSON.parse(results);
    let i = converted.data;

    console.log(i);

    

} //FUNCTION END



//FUNCTION for error display
function errordisplay(){
    
}


//FUNCTION for running API 
function runAPI(countrycode){
    // getting acess token

        var apiKey = "MeAqoFPA7fwUA7KkCQbyQ89ohze1XAYg";
        var apiSec = "VOMwuGhrDcE7ZlZW";

        var url = "https://test.api.amadeus.com/v1/security/oauth2/token";
    
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url);
    
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
        var data = "grant_type=client_credentials&client_id="+apiKey+"&client_secret="+apiSec+"";
        console.log(apiKey);
        console.log(apiSec);
        console.log(data);

        xhr.send(data);
    
        xhr.onreadystatechange = function () {
            // console.log("Got a response for acess token!");
            // console.log(xhr.readyState);
    
            if (xhr.readyState === 4) {
    
                // got access token
                // console.log(xhr.status);
                if(xhr.status == 200) {
                    
                    // console.log("success!");
                    // console.log(xhr.responseText);
                    let convertedResults = JSON.parse(xhr.responseText);
                    // console.log(convertedResults);
                    // console.log(convertedResults.access_token);
    
                    // creating url
                    var url = "https://test.api.amadeus.com/v1/duty-of-care/diseases/covid19-area-report?countryCode=" +encodeURIComponent(countrycode);
                    var ht = new XMLHttpRequest();
                    ht.open("GET", url);
    
                    // createing request header
                    var at = "Bearer "+convertedResults.access_token;
                    // console.log(at);
                    ht.setRequestHeader("Authorization", at);
                    ht.send();
    
                    ht.onreadystatechange = function () {
                        // console.log("Got a response for API!");
                        // console.log(ht.readyState);
                        if (ht.readyState === 4) {
                            // console.log(ht.status);
                            if (ht.status == 200){
                                // console.log(ht.responseText);
                                // function to display results
                                display(ht.responseText);                            
                            }
                            else{
                                // console.log("AJAX Error for API!");
                                // function that displays an error message
                                errordisplay();
                            }
                    }};
    
                }
                else {
                    // console.log("AJAX Error for token!");
                    // console.log(httpRequest.status);
                    // function that displays an error message
                    errordisplay();
                }
            }
        };
} //FUNCTION END
  


runAPI("US");

// what happens when you change the select
document.querySelector("#country-select").onchange = function(){
    let cCode = document.querySelector("#country-select").value;
    console.log(cCode);
    runAPI(cCode);
    }