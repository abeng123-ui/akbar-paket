## Setup
- Set your environment at file .env
- Create DB

# Try run the command below at Terminal

## Running Unit Test
- ./vendor/bin/phpunit tests

## Running migration table and fill data into table
- php artisan migrate
- php artisan db:seed

## TEST RESTAPI
- Import file "AKBAR-PRICEBOOK.postman_collection.json" into Postman
- Hit API localhost/akbar-pricebook/public/product [POST]
