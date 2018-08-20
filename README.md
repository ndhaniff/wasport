# wasport

## Technology use

  ### Backend
  * PHP
  * Laravel / Framework  laravel docs: https://laravel.com/docs/5.6/

  ### Front End
  * Jquery
  * React

  ## Development Dependencies
  * Mysql
  * Node

### Step to start
* clone this repo 
* create .env file from .env.example

#### Command
npm update  
composer update  
php artisan key:generate //for first time only  
php artisan migrate:fresh --seed //migrate db with db seed  
npm run watch or npm run dev //compile front end like sass/etc  
php artisan serve //start local server  

##admin access //make run `php artisan migrate:fresh --seed` first  
http://localhost:8000/admin/login  
admin@admin.com  
admin123  

