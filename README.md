1. execute composer install
2. cp .env.example as .env
3. configure database credentials in .env file
4. execute the following commands
    a. php artisan key:generate
    b. php artisan jwt:secret
    c. php artisan optimize
5. run migrations "php artisan migrate"
6. open a server "php artisan serve"
7. register user with the following path BASE_URL:PORT/api/auth/register
    a. params: name, email, password (6 characters as min)
8. generate jwt token with the following route BASE_URL:PORT/api/auth/login
9. place token in header as Authentication: Bearer (generated token from login) to get stocks or history
10. Get stocks and save a log route BASE_URL:PORT/api/stock
    a. params: symbol
11. Get current user history route BASE_URL:PORT/api/history
