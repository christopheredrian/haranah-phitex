# Haranah-Phitex
## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software and how to install them

```
PHP 7.0
Composer version 1.0 and onward
Git
WampServer (64-bit)
```

### Installing

A step by step series of examples that tell you have to get a development env running

 Clone/download first the project, then type this command in the root directory of the project
```
composer install
```
Wait until the installation is finished 
Create first a database for the system, name it as "haranah"
Type in this command to fill tables in the database, as well as the data for examples
```
php artisan migrate
php artisan db:seed
```
Type this command to run the project and see the URL to view the project
```
php artisan serve
```

## Test Cases

Here's the link to the test cases that have been done so far on the system:
https://docs.google.com/spreadsheets/d/1tf0y60NYCdVy7a77gCYxtHm1oXN7kF5ho56Fi8HDizc/edit?usp=sharing

And a mind map for you to see the test cases:
https://coggle.it/diagram/Wf7Yd1cFBgABQuVQ/ecef4eacb9663c941ab8b9ca9e8369ffe0bbe842f026ab8283c5045951196942