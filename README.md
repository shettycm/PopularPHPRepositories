*Most Popular Public GitHib PHP Projects Based on Stars*

This project is built on WAMP(Windows, Apache, MySQL, PHP) stack. It allows you to browse through top 150 public PHP git hub repositories based on number of stars. 
It has two components. 
1. Running PHP script as cron job to update the database with most popular github PHP repository details based on number of stars using GitHub API. It uses Guzzle client to make REST call to GitHub API.
Useful links from the GitHub API documentation:
    
    https://developer.github.com/v3/
    https://developer.github.com/v3/search/
2. Graphical User interface to browse through the list to view details like repository ID, name, URL, created date, last push date, description and number of stars. Details are displayed in the form of data tables, which provides many features like sorting based on columns, limit number of records to see per page etc. Front end is built using Jquery data table, CSS, HTML and ajax call to PHP file to get the data for table from database.

**Getting Started**

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

***Prerequisites***

What things you need to install the software and how to install them
1. First Install WAMP stack. I followed URL https://bitnami.com/stack/wamp. You can download stack based on your local OS.
2. You can download project code to either apache2\htdocs folder in wamp stack folder or any other folder and create symlink so that apache can access it.
3. Install composer for dependency management. 

***Project Setup***

1. Create config.ini file at the project directory with below details. This will be used by PHP script to connect to MySQL database to perform operations.  
    HOST = "localhost"
    USERNAME = <Enter Username>
    PASSWORD = <Enter the MYSQL password>
    DBNAME = "repository"
2. Run 'sql/CreatePopularPHPRepo.sql' in phpmyadmin console to create the database and table.
3. Run 'Composer install' in the project folder to install the dependencies.
4. Run 'src/GetPopularPHPRepo.php' to get data from REST API and insert to database table. It can be scheduled as cron job to run repeatedly on Linux system.
    */10 * * * * /usr/bin/php  GetPopularPHPRepo.php
5. Open 'templates/popular-repository.html' on your preferred browser to view the list of most populat git hub PHP repository based on stars.

***Test***

Currently there are no automated tests.
