# Documentation

## Pre-requisites
- Composer >= 2.0
- PHP >= 8.1
- MySql >= 8.0
- NodeJs >= 20.18
- npm >= 10.8

## Getting start

### Once you're sure you have all the project pre-requisites installed
1. Run the composer with the command "composer install" to download and manage all dependecies related to PHP
2. Run the command "npm install" to download and install all dependencies related to Node
3. Use "cp .env.example .env" to create your env file
4. Set your env variables to make sure your DB will connect with any trouble (Check)
5. Run php artisan key:generate to generate the application key

### With the environment set up, you're ready to run the application
- Check that the initial database has been created, and if so you can run the command "php artisan migrate --seed" to create the tables and populate them with the test data
- Run the "npm run build" command so that the front-end code and assets are compiled and optimized when you run the application.
- After, run the command "npm run dev" or "npm run watch" to start the application.

## Use the login "admin@test.com" and password "password" to access the system

Note: The system was focused on doing only what was described in the read.me of the tenico case, not worrying about other functions
