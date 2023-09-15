# System requirements

DBMS: MySql
___
PHP 8.1 or PHP last
___
Install Composer
___
composer install
___
composer update
___
___

# Other settings (Commands in the project folder)

php artisan migrate --seed (Runs the database migrations)

___
___
# Users Crud

## List:

GET /api/v1/users
___
## Create:

POST /api/v1/users

FormData:

name - Name of user

surname - Surname of user

phone - Phone of User

avatar_path - Avatar of User
___
## Update:

POST /api/v1/users/2

FormData:

name - Name of user

surname - Surname of user

phone - Phone of User

avatar_path - Avatar of User

_method - PUT
___
## Show:

GET /api/v1/users/2
___
## Delete
DELETE /api/v1/users/2
___
___

# Company Crud
## List:

GET /api/v1/companies
___
## Create:

POST /api/v1/companies

FormData:

name - Name of Company

description - Some text min:150 , max:400

logo - Logo of Company

___
## Update:

POST /api/v1/companies/5

FormData:

name - Name of Company

description - Some text min:150 , max:400

logo - Logo of Company

_method - PUT
___
## Show:

GET /api/v1/companies/5
___
## Delete
DELETE /api/v1/companies/5
___
___
# Comment Crud

## List:

GET /api/v1/comments
___
## Create:

POST /api/v1/companies

raw:

{

"user_id": 3,

"company_id": 1,

"comment": "some text min:150, max:550 ",

"rating": 2      //min:1 , max:10

}

___
## Update:

PUT /api/v1/comments/10

raw:

{

"user_id": 3,

"company_id": 1,

"comment": "some text min:150, max:550 ",

"rating": 5      //min:1 , max:10

}
___
## Show:

GET /api/v1/comments/10
___
## Delete
DELETE /api/v1/comments/1
___
___

# Top Companies

GET /api/v1/companies/top
___
___
# Сompany Valuation

GET /api/v1/company_valuation/2
___
___
# Company Comment

GET /api/v1/company_comments/3
___
___
