## About Project

This project is based on Laravel 8. This project is made for admission test on Inosoft Transistem. The expected results for this project are as stated below:
- Show available vehicles
- Vehicles sales
- The selling summary for each type

## What to prepare

Please make sure to install these before opening the projects:
- Studio 3T
- Mongodb, minimum v4.4.x
- PHP, minimum v8.0
- Postman

## How to open the project

You can download the project via terminal or by downloading the zip file.
Upon finishing the download open the project via terminal and type `php artisan serve` to open the project.
If you encounter error, try running `composer update` to update the package.

## How to test the project

Postman is used to test the HTTP Request so please make sure to install this application. The Postman collection can be found in folder "Postman". New collections might be added so please check and use the latest version.
Import the collection to Postman and try running it.
Database can be found in folder "DB". Please import the database before running the project. New files might be added, please check regularly and read the notice at Readme file for some updates.
This project can be tested with PHP Test Unit. However this test unit is yet to be done. For the time being the test units that can be checked are: login, logout, see all records, see detail of certain record, delete record, update record and add new record. More advanced test is yet to be made.
Type `php artisan serve` on your terminal to see the unit tests.

## Activity Log
- 2022-01-06
    * Upload base projects
- 2022-01-07
    * Simple CRUD for vehicle collection
- 2022-01-08
    * CRUD for Vehicle Collection (Car and Motor Sub) finished
    * CRUD for Selling Collection finished
    * Authentication using JWT finished
- 2022-01-09
    * Attempting to make PHP test unit.