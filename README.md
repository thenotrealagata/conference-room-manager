# Office managemenent tool
Developed for the 2024 winter semester as an assignment for a backend development class at ELTE.

## Set up project
First create the database as database.sqlite in the database  and create a .env file based on the .env.example file in the root. Then, to run the project, run the following commands:
composer install
php artisan migrate:fresh --seed
php artisan key:generate
npm install
npm run dev
php artisan serve

## Introduction
This application allows for the handling of employees, conference rooms and rights. The rights of an employee determine whether or not an employee can enter a conference room.