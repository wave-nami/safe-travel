# [Safe Travel Planner]

## About & Inspiration
Safe Travel Planner is a website that helps users make an informed decision about traveling overseas during the pandemic. For the past 2 years, my mom has been longing to see my 72 year old grandma that lives in Japan by herself. Everyday, she checks on the entry and exit requirements that Japanese and American government put on their website to see if it's safe enough for my family to travel. She told me she wished there was a website that she can check the travel requirements easily, and that was the inspiration for this project idea. Similarly to my family, many people have been unable to see their loved ones that live abroad with the spreading of COVID-19. Today, it's crucial to make an informed decision about traveling so that we can still see our loved ones safely- I hope this website helps people do just that. 

## Features
The main page displays information on travel restrictions for different countries, pulled from Amadeus Travel Restrictions API. Users can also register and log in to read other users' travel plans and experiences, and also share their own by writing a blog. This would help users make a more informed decision than just descriptions of travel requirements. 

## Languages used
### SQL database
- Implemented a 3-tier membership system. Admin users can delete inappropriate blogs posted by registered users. 
- Online database of [ISO 3166-1 country codes] (https://github.com/Svish/iso-3166-country-codes/blob/master/countries.sql) to increase the amount of accessible information.
### JavaScript, AJAX, JSON
- Used to pull information from Amadeus Travel Restrictions API.
### PHP
- Used to implement CRUD functionalities, such as adding new users, getting country codes, editing and deleting blogs, etc.
### HTML, CSS, Bootstrap 
- Used to create informative and user friendly interface.
