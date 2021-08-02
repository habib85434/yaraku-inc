### Requirement 
```
    - php 7.3
    - mysql 5.7|8.0   
```
# Installing the project in localhost
Step-1 : Clone the project 
```
    - git clone https://github.com/habib85434/yaraku-inc.git
```
Step-2 : Setup laravel (API) <br />
- Go to the src folder and rename .env.example to .env <br />
- Create database and put database fill the created database credentials in the .env file
- Run the following commands in the terminal in the src directory
```
    - composer install
    - php artisan key:generate 
    - php artisan config:cache
    - php artisan migrate --seed
    - php artisan serve
```
Step-3 : Setup Vue (Frontend) <br />
- Go to front-end directory and run the following commands
````
    - npm install
    - npm audit fix
    - npm run serve
````
Step-4 : Run the project in the browser <br />
- If all ports are default then copy the following URL and paste it into your browser
```
    http://localhost:8080/
```
![alt Application](full_.png)


# APIs List with postman collection
- Open your postman and import the collection from ```project root``` directory
- There are 7 APIs in the ```Yaraku-inc/Books``` 
- Create an environment variable with the variable ```baseUrl``` and put the value ```http://127.0.0.1:8000/api/v1``` (if you do not change the port)
- Now it is ready to check all APIs with the postman


### Unit Test
There are unit tests are available in the ```tests/Unit/Books/``` directory
<br />
- Run all tests in single command  
```
    - php artisan test
```
or run each test or run all tests in the class by using phpStorm




