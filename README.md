# Matrix Multiplication 
## this is basic implementation for multiply two metrices
### Features
- [x] Create user
- [x] Login
- [x] Authnitecated users can multiply metrics 
- [x] Reduce complexity 
- [] Ability to add any converter we need easily 

### Validations
* First array columns is equal to the second rows
* All items are numeric values 

**tests** 

* it test that service return the right char against specific number according excel columns
* it test it multiply two matrix correctly
* it can handle large matrix
* it will throw exception if there's a non suported type called



**postman collection**

* Doc: https://documenter.getpostman.com/view/3539387/TVsrE9D8
* Json:  https://documenter.getpostman.com/view/3539387/TVeta5Yj

#### Setup & installation
* git clone git@github.com:mohammedabdallah/MatrixMultiply.git
* cd MatrixMultiply
* composer install
* create database and update .env with it's name and database password
* php artisan migrate
* php artisan passport:install
* php artisan serve

###usage 
* Open post man the hit the following  respectively
    * Create user
    * Login (the token will stored in access token and will automatically set into header multiply request )
    * Multiply any metrics u want  
