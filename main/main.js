//FUNCTION for displaying results
function display(results){
    let converted = JSON.parse(results);
    let i = converted.data;

    console.log(i);

    document.querySelector("#covid_stats").style.display= "block";
    document.querySelector("#travel_restriction").style.display= "block";
    document.querySelector("#local_regulation").style.display= "block";
    document.querySelector("#unavailable").style.display= "none";

    let ina = "unavailable infomation";

    //   COVID info
    console.log("COVID INFO");

    //summary
    // console.log(i.summary); 
    if (i.summary != undefined){
        document.querySelector("#summary").innerHTML = i.summary;
    }
    else{
        document.querySelector("#summary").innerHTML = ina;
    }
    

    //areaVaccinated -Fully vaccinated
        //percentage
        //date
    // console.log(i.areaVaccinated[1].percentage); 
    // console.log(i.areaVaccinated[1].date); 
    if (i.areaVaccinated[1].percentage != undefined){
        fullyString = `
        <div class="progress-bar" role="progressbar" style="width: ${i.areaVaccinated[1].percentage}%;" aria-valuenow="${i.areaVaccinated[1].percentage}" aria-valuemin="0" aria-valuemax="100"> 
            ${i.areaVaccinated[1].percentage}%
        </div>
        `;
        document.querySelector("#fully").innerHTML = fullyString;
    }
    else{
        document.querySelector("#fully").innerHTML = ina;
    }

    if (i.areaVaccinated[1].date != undefined){
        document.querySelector("#fully-date").innerHTML = `Last updated: ${i.areaVaccinated[1].date}`;
    }
    else{
        document.querySelector("#fully-date").innerHTML = "";
    }
        

    //diseaseCases -
        //confirmed
        //deaths
        //date
    // console.log(i.diseaseCases.confirmed);
    // console.log(i.diseaseCases.death);
    // console.log(i.diseaseCases.date);
    if (i.diseaseCases.confirmed != undefined){
        document.querySelector("#confirmed").innerHTML = i.diseaseCases.confirmed;
    }
    else{
        document.querySelector("#confirmed").innerHTML = ina;
    }

    if (i.diseaseCases.deaths != undefined){
        document.querySelector("#deaths").innerHTML = i.diseaseCases.deaths;
    }
    else{
        document.querySelector("#deaths").innerHTML = ina;
    }

    if (i.diseaseCases.date != undefined){
        document.querySelector("#confirmed-date").innerHTML = `Last updated: ${i.diseaseCases.date}`;
        document.querySelector("#deaths-date").innerHTML = `Last updated: ${i.diseaseCases.date}`;
    }
    else{
        document.querySelector("#confirmed-date").innerHTML = "";
        document.querySelector("#deaths-date").innerHTML = "";
    }
    

    //diseaseInfection
        //level -Extreme, 
        //rate -
        //date
    //diseaseRiskLevel
    // console.log(i.diseaseInfection.level);
    // console.log(i.diseaseInfection.rate);
    // console.log(i.diseaseInfection.date);
    // console.log(i.diseaseRiskLevel);

    if (i.diseaseInfection.level != undefined){
        document.querySelector("#infection-level").innerHTML = i.diseaseInfection.level;
    }
    else{
        document.querySelector("#infection-level").innerHTML = ina;
    }

    if (i.diseaseInfection.rate != undefined){
        let rate = i.diseaseInfection.rate/(100000)*(100);
        // console.log(rate);
        ratenumString = `
            ${i.diseaseInfection.rate} cases per 100,000 reported in 14 days
        `;
        rateString = `
        <div class="progress-bar" role="progressbar" style="width: ${rate}%;" aria-valuenow="${rate}" aria-valuemin="0" aria-valuemax="100"></div>
        `;
        document.querySelector("#infection-rate").innerHTML = rateString;
        document.querySelector("#ratenum").innerHTML = ratenumString;
    }
    else{
        document.querySelector("#infection-rate").innerHTML = ina;
        document.querySelector("#ratenum").innerHTML = ina;
    }

    if (i.diseaseInfection.date != undefined){
        document.querySelector("#infection-date").innerHTML = `Last updated: ${i.diseaseInfection.date}`;
        document.querySelector("#infection-date2").innerHTML = `Last updated: ${i.diseaseInfection.date}`;
    }
    else{
        document.querySelector("#infection-date").innerHTML = "";
        document.querySelector("#infection-date2").innerHTML = "";
    }

    if (i.diseaseRiskLevel != undefined){
        document.querySelector("#risklevel").innerHTML = i.diseaseRiskLevel;
    }
    else{
        document.querySelector("#risklevel").innerHTML = ina;
    }


    //hotspots
    // console.log(i.hotspots);
    if (i.hotspots != undefined){
        document.querySelector("#hotspot").innerHTML = i.hotspots;
    }
    else{
        document.querySelector("#hotspot").innerHTML = ina;
    }

    //   Travel restriction
    console.log("TRAVEL RESTRICTION");

    //entry 1
        //ban
            //text -show with offcanvas
            //borderban -array
                //borderType -Land or Maritime or Air
                //status -Open or Partially open or Closed
            //bannedArea -array, uses "iataCode" so would have to convert to country. could add during winter break
            //throughDate
            //date
    // console.log(i.areaAccessRestriction.entry.ban);
    // console.log(i.areaAccessRestriction.entry.text);
    // console.log(i.areaAccessRestriction.entry.borderBan[0].borderType);
    // console.log(i.areaAccessRestriction.entry.borderBan[0].status);
    // console.log(i.areaAccessRestriction.entry.throughDate);
    // console.log(i.areaAccessRestriction.entry.date);

    if (i.areaAccessRestriction.entry.ban != undefined){
        document.querySelector("#ban").innerHTML = `<u>Ban Type</u>: ${i.areaAccessRestriction.entry.ban}`;
    }
    else{
        document.querySelector("#ban").innerHTML = `<u>Ban Type</u>: ${ina}`;
    }

    if (i.areaAccessRestriction.entry.text != undefined){
        document.querySelector("#ban-text").innerHTML = i.areaAccessRestriction.entry.text;
    }
    else{
        document.querySelector("#ban-text").innerHTML = ina;
    }

    document.querySelector("#ban-maritime").innerHTML = "";
    document.querySelector("#ban-land").innerHTML = "";
    document.querySelector("#ban-air").innerHTML = "";
    if (i.areaAccessRestriction.entry.borderBan != undefined){
        for (let a=0; a<(i.areaAccessRestriction.entry.borderBan.length); a++){
            if (i.areaAccessRestriction.entry.borderBan[a].borderType == "maritimeBorderBan"){
                document.querySelector("#ban-maritime").innerHTML = `<u>Maritime Border</u>: ${i.areaAccessRestriction.entry.borderBan[a].status}`;
            }
            else if (i.areaAccessRestriction.entry.borderBan[a].borderType == "landBorderBan"){
                document.querySelector("#ban-land").innerHTML = `<u>Land Border:</u> ${i.areaAccessRestriction.entry.borderBan[a].status}`;
            }
            else if (i.areaAccessRestriction.entry.borderBan[a].borderType == "airBorderBan"){
                document.querySelector("#ban-air").innerHTML = `<u>Air Border:</u> ${i.areaAccessRestriction.entry.borderBan[a].status}`;
            }
        }
    }
    if (i.areaAccessRestriction.entry.throughDate != undefined){
        if (i.areaAccessRestriction.entry.throughDate == "indef"){
            document.querySelector("#ban-enddate").innerHTML = `<u>End Date:</u> None (indefinite)`;
        }
        else{
            document.querySelector("#ban-enddate").innerHTML = `<u>End Date:</u> ${i.areaAccessRestriction.entry.throughDate}`;
        }
    }
    else{
        document.querySelector("#ban-enddate").innerHTML = "";
    }

    // I MAY OR MAY NOT DO THROUGHDATE LOL

    if (i.areaAccessRestriction.entry.date != undefined){
        document.querySelector("#ban-date").innerHTML = `Last updated: ${i.areaAccessRestriction.entry.date}`;
    }
    else{
        document.querySelector("#ban-date").innerHTML = "";
    }



    //exit 2
        //isBanned -Yes or No
        //specialRequirements -Yes or No
        //text- offcanvas
        //rulesLink -winter break.
        //date
    // console.log(i.areaAccessRestriction.exit.isBanned);
    // console.log(i.areaAccessRestriction.exit.specialRequirements);
    // console.log(i.areaAccessRestriction.exit.text);
    // console.log(i.areaAccessRestriction.exit.date);

    let isBanned = i.areaAccessRestriction.exit.isBanned;
    if (isBanned != undefined){
        if (isBanned == "Yes"){
            document.querySelector("#ban-type").innerHTML = `<u>Banned:</u> all travellers are banned from leaving`;
        }
        else if (isBanned == "Recommended"){
            document.querySelector("#ban-type").innerHTML = `<u>Recommended Not to Exit:</u> travellers should not leave, but are mostly free to do so`;
        }
        else if (isBanned == "Partial"){
            document.querySelector("#ban-type").innerHTML = `<u>Partial Ban:</u> some travellers may leave, but others are prevented`;
        }
        else if (isBanned == "No"){
            document.querySelector("#ban-type").innerHTML = `<u>No Ban:</u> all travellers are free to leave`;
        }
    }
    else{
        document.querySelector("#ban-type").innerHTML = `<u>Ban Type:</u> ${ina}`;
    }

    let spReq = i.areaAccessRestriction.exit.specialRequirements;
    if (spReq != undefined){
        document.querySelector("#ban-spReq").innerHTML = `<u>Special Requirement:</u> ${spReq}`;
    }
    else{
        document.querySelector("#ban-spReq").innerHTML = "";
    }

    if (i.areaAccessRestriction.exit.text != undefined){
        document.querySelector("#ban-text2").innerHTML = i.areaAccessRestriction.exit.text;
    }
    else{
        document.querySelector("#ban-text2").innerHTML = ina;
    }

    if (i.areaAccessRestriction.exit.date != undefined){
        document.querySelector("#ban-date2").innerHTML = `Last updated: ${i.areaAccessRestriction.exit.date}`;
    }
    else{
        document.querySelector("#ban-date2").innerHTML = "";
    }
    


    //diseaseTesting 3
        //isRequired -Yes or No or Yes, conditional
        //minimumAge -number
        //when
        //testType
        //text -show with offcanvas
        //date
    // console.log(i.areaAccessRestriction.diseaseTesting.isRequired); 
    // console.log(i.areaAccessRestriction.diseaseTesting.minimumAge);
    // console.log(i.areaAccessRestriction.diseaseTesting.when);
    // console.log(i.areaAccessRestriction.diseaseTesting.testType);
    // console.log(i.areaAccessRestriction.diseaseTesting.text);
    // console.log(i.areaAccessRestriction.diseaseTesting.date);

    let isReq = i.areaAccessRestriction.diseaseTesting.isRequired;
    if (isReq != undefined){
        if (isBanned == "Yes"){
            document.querySelector("#testing").innerHTML = `<u>Testing:</u> Required`;
        }
        else if (isBanned == "No"){
            document.querySelector("#testing").innerHTML = `<u>Testing:</u> Not Required`;
        }
        else if (isBanned == "Yes, conditional"){
            document.querySelector("#testing").innerHTML = `<u>Testing:</u> Conditionally Required`;
        }
    }
    else {
        document.querySelector("#testing").innerHTML = `<u>Testing:</u> ${ina}`;
    }

    let testAge = i.areaAccessRestriction.diseaseTesting.minimumAge;
    if (testAge != undefined){
        document.querySelector("#testing-age").innerHTML = `<u>Minimum Age:</u> ${testAge}`;
    }
    else{
        document.querySelector("#testing-age").innerHTML = "";
    }

    let testWhen = i.areaAccessRestriction.diseaseTesting.when;
    if (testWhen != undefined){
        document.querySelector("#testing-when").innerHTML = `<u>When:</u> ${testWhen}`;
    }
    else{
        document.querySelector("#testing-when").innerHTML = "";
    }

    let testType = i.areaAccessRestriction.diseaseTesting.testType;
    if (testType != undefined){
        document.querySelector("#testing-type").innerHTML = `<u>Test Type:</u> ${testType}`;
    }
    else{
        document.querySelector("#testing-type").innerHTML = "";
    }

    if (i.areaAccessRestriction.diseaseTesting.text != undefined){
        document.querySelector("#ban-text3").innerHTML = i.areaAccessRestriction.diseaseTesting.text;
    }
    else{
        document.querySelector("#ban-text3").innerHTML = ina;
    }

    if (i.areaAccessRestriction.diseaseTesting.date != undefined){
        document.querySelector("#testing-date").innerHTML = `Last updated: ${i.areaAccessRestriction.diseaseTesting.date}`;
    }
    else{
        document.querySelector("#testing-date").innerHTML = "";
    }



    //declarationDocuments 4
        //documentRequired -Yes or No
            //travelDocumentationLink -do during winter break
            //healthDocumentationLink -do during winter break
        //text -show with offcanvas
        //date
    // console.log(i.areaAccessRestriction.declarationDocuments.documentRequired);
    // console.log(i.areaAccessRestriction.declarationDocuments.text);
    // console.log(i.areaAccessRestriction.declarationDocuments.date);

    let docReq = i.areaAccessRestriction.declarationDocuments.documentRequired;
    if (docReq != undefined){
        if (docReq == "Yes"){
            document.querySelector("#doc").innerHTML = `<u>Document:</u> Required`;
        }
        else if (docReq == "No"){
            document.querySelector("#doc").innerHTML = `<u>Document:</u> Not Required`;
        }
        else if (docReq == "Yes, conditional"){
            document.querySelector("#doc").innerHTML = `<u>Document:</u> Conditionally Required`;
        }
    }
    else{
        document.querySelector("#doc").innerHTML = `<u>Document:</u> ${ina}`;
    }

    let travelLink = i.areaAccessRestriction.declarationDocuments.travelDocumentationLink;
    if (travelLink != undefined){
        document.querySelector("#doc-link1").innerHTML = `<a href="${travelLink}" target="_blank">Travel Documentation</a>`;
    }
    else{
        document.querySelector("#doc-link1").innerHTML = "";
    }

    let healthLink = i.areaAccessRestriction.declarationDocuments.healthDocumentationLink;
    if (healthLink != undefined){
        document.querySelector("#doc-link2").innerHTML = `<a href="${healthLink}" target="_blank">Health Documentation</a>`;
    }
    else{
        document.querySelector("#doc-link2").innerHTML = "";
    }

    if (i.areaAccessRestriction.declarationDocuments.text != undefined){
        document.querySelector("#doc-text").innerHTML = i.areaAccessRestriction.declarationDocuments.text;
    }
    else{
        document.querySelector("#doc-text").innerHTML = ina;
    }

    if (i.areaAccessRestriction.diseaseTesting.date != undefined){
        document.querySelector("#doc-date").innerHTML = `Last updated: ${i.areaAccessRestriction.declarationDocuments.date}`;
    }
    else{
        document.querySelector("#doc-date").innerHTML = "";
    }


    
    //mask 5
        //isRequired -Yes or No
        //text -show with offcanvas
        //date
    // console.log(i.areaAccessRestriction.mask.isRequired);
    // console.log(i.areaAccessRestriction.mask.text);
    // console.log(i.areaAccessRestriction.mask.date);

    let mas = i.areaAccessRestriction.mask.isRequired;
    if (mas != undefined){
        if (mas == "Yes"){
            document.querySelector("#mask").innerHTML = `<u>Mask:</u> Required`;
        }
        else if (mas == "No"){
            document.querySelector("#mask").innerHTML = `<u>Mask:</u> Not Required`;
        }
        else if (mas == "Yes, conditional"){
            document.querySelector("#mask").innerHTML = `<u>Mask:</u> Conditionally Required`;
        }
    }
    else{
        document.querySelector("#mask").innerHTML = `<u>Mask:</u> ${ina}`;
    }

    if (i.areaAccessRestriction.mask.text != undefined){
        document.querySelector("#mask-text").innerHTML = i.areaAccessRestriction.mask.text;
    }
    else{
        document.querySelector("#mask-text").innerHTML = ina;
    }

    if (i.areaAccessRestriction.mask.date != undefined){
        document.querySelector("#mask-date").innerHTML = `Last updated: ${i.areaAccessRestriction.mask.date}`;
    }
    else{
        document.querySelector("#mask-date").innerHTML = "";
    }



    //diseaseVaccination 6
        //isRequired -Yes or No
        //policy -Yes or No, yes indicates fully vaxxed travellers are exempt from some requirements
        //qualifiedVaccines -array, strings
        //acceptedCertificates -array, Not Specified or all the lists
        // text -show with offcanvas, but didn't show up for states
        //date
    // console.log(i.areaAccessRestriction.diseaseVaccination.isRequired);
    // console.log(i.areaAccessRestriction.diseaseVaccination.policy);
    // console.log(i.areaAccessRestriction.diseaseVaccination.qualifiedVaccines);
    // console.log(i.areaAccessRestriction.diseaseVaccination.acceptedCertificates);
    // console.log(i.areaAccessRestriction.diseaseVaccination.date);

    let vaxReq = i.areaAccessRestriction.diseaseVaccination.isRequired;
    vaxBool = false;
    if (vaxReq != undefined){
        if (vaxReq == "Yes"){
            document.querySelector("#vax").innerHTML = `<u>Vaccination:</u> Required`;
            vaxBool = true;
        }
        else if (vaxReq == "No"){
            document.querySelector("#vax").innerHTML = `<u>Vaccination:</u> Not Required`;
            vaxBool = false;
        }
        else if (vaxReq == "Yes, conditional"){
            document.querySelector("#vax").innerHTML = `<u>Vaccination:</u> Conditionally Required`;
            vaxBool = true;
        }
        else{
            document.querySelector("#vax").innerHTML = `<u>Vaccination:</u> ${vaxReq}`;
            vaxBool = true;
        }
    }
    else{
        document.querySelector("#vax").innerHTML = `<u>Vaccination:</u> ${ina}`;
    }

    if (!vaxBool){
        document.querySelector("#vax-accordion").style.display= "none";
    }
    else{
        document.querySelector("#vax-accordion").style.display= "block";
        let vax_ul1 = document.querySelector("#vax-qual");
        while (vax_ul1.hasChildNodes()){
            vax_ul1.removeChild(vax_ul1.lastChild);
        }
        vaxQualString = ``;
        let vaxQual = i.areaAccessRestriction.diseaseVaccination.qualifiedVaccines;
        if (vaxQual != undefined){
            for (let b=0; b<(vaxQual.length); b++){
                vaxQualString += `<li> ${vaxQual[b]} </li>`;
            }
            vax_ul1.innerHTML = vaxQualString;
        }
        else{
            vax_ul1.innerHTML = ina;
        }

        let vax_ul2 = document.querySelector("#vax-acce");
        while (vax_ul2.hasChildNodes()){
            vax_ul2.removeChild(vax_ul2.lastChild);
        }
        vaxAcceString = ``;
        let vaxAcce = i.areaAccessRestriction.diseaseVaccination.acceptedCertificates;
        if (vaxAcce != undefined){
            for (let c=0; c<(vaxAcce.length); c++){
                vaxAcceString += `<li> ${vaxAcce[c]} </li>`;
            }
            vax_ul2.innerHTML = vaxAcceString;
        }
        else{
            vax_ul2.innerHTML = ina;
        }
    }
    
    let vaxP = i.areaAccessRestriction.diseaseVaccination.policy;
    if (vaxP != undefined){
        if (vaxP == "Yes"){
            document.querySelector("#vax-policy").innerHTML = "* Fully vaccinated travellers are exempt from some requirements";
        }
        else if (vaxP == "No"){
            document.querySelector("#vax-policy").innerHTML = "";
        }
    }
    else{
        document.querySelector("#vax-policy").innerHTML = "";
    }

    if (i.areaAccessRestriction.diseaseVaccination.text != undefined){
        document.querySelector("#vax-text").innerHTML = i.areaAccessRestriction.diseaseVaccination.text;
    }
    else{
        document.querySelector("#vax-text").innerHTML = ina;
    }

    if (i.areaAccessRestriction.diseaseVaccination.date != undefined){
        document.querySelector("#vax-date").innerHTML = `Last updated: ${i.areaAccessRestriction.diseaseVaccination.date}`;
    }
    else{
        document.querySelector("#vax-date").innerHTML = "";
    }


    //quarantineModality 7
        //eligiblePerson
        //quarantineType -self/gov
        //duration -int
        //text -show with offcanvas
        //quarantineOnArrivalAreas -fix during winter break
        //date
    // console.log(i.areaAccessRestriction.quarantineModality.eligiblePerson);
    // console.log(i.areaAccessRestriction.quarantineModality.quarantineType);
    // console.log(i.areaAccessRestriction.quarantineModality.duration);
    // console.log(i.areaAccessRestriction.quarantineModality.rules);
    // console.log(i.areaAccessRestriction.quarantineModality.text);
    console.log(i.areaAccessRestriction.quarantineModality.quarantineOnArrivalAreas);
    // console.log(i.areaAccessRestriction.quarantineModality.date);

    let quaWho = i.areaAccessRestriction.quarantineModality.eligiblePerson;
    quaBool = true;
    if (quaWho != undefined){
        document.querySelector("#qua-who").innerHTML = `<u>Who:</u> ${quaWho}`;
        if (quaWho == "None"){
            quaBool = false;
        }
    }
    else{
        document.querySelector("#qua-who").innerHTML = "";
    }
    
    let quaWhat = i.areaAccessRestriction.quarantineModality.quarantineType;
    if (quaWhat != undefined){
        document.querySelector("#qua-type").innerHTML = `<u>Quarantine Type:</u> ${quaWhat}`;
    }
    else{
        if (!quaBool){
            document.querySelector("#qua-type").innerHTML = "";
        }
        else{
            document.querySelector("#qua-type").innerHTML = `<u>Quarantine Type:</u> ${ina}`;
        }
    }

    let quaLong = i.areaAccessRestriction.quarantineModality.duration;
    if (quaLong != undefined){
        document.querySelector("#qua-duration").innerHTML = `<u>Duration:</u> ${quaLong} days`;
    }
    else{
        if (!quaBool){
            document.querySelector("#qua-duration").innerHTML = "";
        }
        else{
            document.querySelector("#qua-duration").innerHTML = `<u>Duration:</u> ${ina}`;
        }
    }

    let ruleLink = i.areaAccessRestriction.quarantineModality.rules;
    if (ruleLink != undefined){
        document.querySelector("#qua-link").innerHTML = `<a href="${ruleLink}" target="_blank">Rules</a>`;
    }
    else{
        if (!quaBool){
            document.querySelector("#qua-link").innerHTML = "";
        }
        else{
            document.querySelector("#qua-link").innerHTML = `<u>Rules:</u> ${ina}`;
        }
    }

    if (i.areaAccessRestriction.quarantineModality.text != undefined){
        document.querySelector("#qua-text").innerHTML = i.areaAccessRestriction.quarantineModality.text;
    }
    else{
        document.querySelector("#qua-text").innerHTML = ina;
    }

    if (i.areaAccessRestriction.quarantineModality.date != undefined){
        document.querySelector("#qua-date").innerHTML = `Last updated: ${i.areaAccessRestriction.quarantineModality.date}`;
    }
    else{
        document.querySelector("#qua-date").innerHTML = "";
    }



    //tracingApplication 8
        //isRequired -Yes or No, no means it doesn't have urls? 
        //iosUrl
        //androidUrl
        //text
        //date
    // console.log(i.areaAccessRestriction.tracingApplication.isRequired);
    // console.log(i.areaAccessRestriction.tracingApplication.iosUrl);
    // console.log(i.areaAccessRestriction.tracingApplication.androidUrl);
    // console.log(i.areaAccessRestriction.tracingApplication.text);
    // console.log(i.areaAccessRestriction.tracingApplication.date);

    let tracReq = i.areaAccessRestriction.tracingApplication.isRequired;
    tracBool = false;
    if (tracReq != undefined){
        if (tracReq == "No"){
            document.querySelector("#trac").innerHTML = `<u>Tracing Application:</u> Not Required`;
            tracBool = false;
        }
        else if (tracReq == "Yes"){
            document.querySelector("#trac").innerHTML = `<u>Tracing Application:</u> Required`;
            tracBool = true;
        }
        else{
            document.querySelector("#trac").innerHTML = `<u>Tracing Application:</u> ${tracReq}`;
            tracBool = true;
        }
    }
    else{
        document.querySelector("#trac").innerHTML = "";
    }


    if (!tracBool){
        document.querySelector("#trac-accordion").style.display= "none";
    }
    else{
        document.querySelector("#trac-accordion").style.display= "block";
        let trac_ul1 = document.querySelector("#ios-ul");
        while (trac_ul1.hasChildNodes()){
            trac_ul1.removeChild(trac_ul1.lastChild);
        }
        let iosLinks = i.areaAccessRestriction.tracingApplication.iosUrl;
        if (iosLinks != undefined){
            iosString = ``;
            for (let d=0; d<(iosLinks.length); d++){
                iosString += `<li> <a href="${iosLinks[d]}" target="_blank">download</a> </li>`;
            }
            trac_ul1.innerHTML = iosString;
        }
        else{
            trac_ul1.innerHTML = "no iOS link";
        }

        let trac_ul2 = document.querySelector("#and-ul");
        while (trac_ul2.hasChildNodes()){
            trac_ul2.removeChild(trac_ul2.lastChild);
        }
        let andLinks = i.areaAccessRestriction.tracingApplication.androidUrl;
        if (andLinks != undefined){
            andString = ``;
            for (let e=0; e<(andLinks.length); e++){
                andString += `<li> <a href="${andLinks[e]}" target="_blank">download</a> </li>`;
            }
            trac_ul2.innerHTML = andString;
        }
        else{
            trac_ul2.innerHTML = "no andoroid link";
        }

    }

    if (i.areaAccessRestriction.tracingApplication.text != undefined){
        document.querySelector("#trac-text").innerHTML = i.areaAccessRestriction.tracingApplication.text;
    }
    else{
        document.querySelector("#trac-text").innerHTML = ina;
    }

    if (i.areaAccessRestriction.tracingApplication.date != undefined){
        document.querySelector("#trac-date").innerHTML = `Last updated: ${i.areaAccessRestriction.tracingApplication.date}`;
    }
    else{
        document.querySelector("#trac-date").innerHTML = "";
    }


    //   Local regulation

    //areaPolicy
        //status -Current level of regional movement control. 
        //       -Can be de jure or de facto control. "Lockdown" | "Curfew" | "Distancing" | "None" | "Partial Measures" | "Opening" | "Closing" | "Open"
        //endDate (indef or black would say none)
        //text -show with offcanvas
        //referenceLink? -winter break, can attach the link to the card title? 
        //date
    // console.log(i.areaPolicy.status);
    // console.log(i.areaPolicy.endDate);
    // console.log(i.areaPolicy.text);
    // console.log(i.areaPolicy.date);

    if (i.areaPolicy.status != undefined){
        document.querySelector("#loc").innerHTML = `<u>Status:</u> ${i.areaPolicy.status}`;
    }
    else{
        document.querySelector("#loc").innerHTML = `<u>Status:</u> ${ina}`;
    }
    
    if (i.areaPolicy.endDate != undefined){
        if (i.areaPolicy.endDate == "indef"){
            document.querySelector("#loc-enddate").innerHTML = `<u>End Date:</u> None (indefinite)`;
        }
        else{
            document.querySelector("#loc-enddate").innerHTML = `<u>End Date:</u> ${i.areaPolicy.endDate}`;
        }
    }
    else{
        document.querySelector("#loc-enddate").innerHTML = "";
    }

    if (i.areaPolicy.text != undefined){
        document.querySelector("#loc-text").innerHTML = i.areaPolicy.text;
    }
    else{
        document.querySelector("#loc-text").innerHTML = ina;
    }

    if (i.areaPolicy.referenceLink != undefined){
        document.querySelector("#loc-link").innerHTML = `<a href="${i.areaPolicy.referenceLink}" target="_blank">Reference Link</a>`;
    }
    else{
        document.querySelector("#loc-link").innerHTML = "";
    }

    if (i.areaPolicy.date != undefined){
        document.querySelector("#loc-date").innerHTML = `Last updated: ${i.areaPolicy.date}`;
    }
    else{
        document.querySelector("#loc-date").innerHTML = "";
    }


    //areaRestrictions -array
            //restrictionType
            //text -offcanvas? or we could do accordion with this one
            //date
    let cards = document.querySelector("#local_reg_cards");
    while (cards.hasChildNodes()){
        cards.removeChild(cards.lastChild);
    }
    areaString = ``;

    if (i.areaRestrictions != undefined)
    {
        for (let f = 0; f<(i.areaRestrictions.length); f++){
            areaString += `
            <div class="col-md-3">
                <div class="card h-100 border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Area Restriction ${f+1}</h5>
                            <div class="card-text">
                                <p>${i.areaRestrictions[f].restrictionType}</p>
                                <p class= "mb0 button">
                                    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#localScrolling${f}" aria-controls="offcanvasScrolling">
                                        Read more
                                    </button>
                                </p>
                                <small class="text-muted"> Last updated: ${i.areaRestrictions[f].date} </small>
                            </div>

                        <div class="offcanvas offcanvas-start" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="localScrolling${f}" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Area Restriction ${f+1}</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                ${i.areaRestrictions[f].text}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;
        }
    }

    cards.innerHTML = areaString;

} //FUNCTION END



//FUNCTION for error display
function errordisplay(){
    document.querySelector("#covid_stats").style.display= "none";
    document.querySelector("#travel_restriction").style.display= "none";
    document.querySelector("#local_regulation").style.display= "none";
    document.querySelector("#unavailable").style.display= "block";
}


//FUNCTION for running API 
function runAPI(countrycode){
    // getting acess token

        var apiKey = "vAD2H6F8AoGlNk7ZJGVGjxIYvdiGj9hm";
        var apiSec = "cDZhCEG4ECQuYeE2";

        var url = "https://api.amadeus.com/v1/security/oauth2/token";
    
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
                    var url = "https://api.amadeus.com/v1/duty-of-care/diseases/covid19-area-report?countryCode=" +encodeURIComponent(countrycode);
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