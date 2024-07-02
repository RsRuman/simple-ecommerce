## Project setup/installation guides
Please Follow the guideline to set up locally.

- Laravel 11 (php 8.3/8.2)

### Installation process after cloning from git

1. composer install
2. cp .env.example .env
3. php artisan key:generate
4. set database mysql and update related things in .env (for example your database name, password)
5. php artisan migrate
6. php artisan db:seed

# note:
I also added postman collection name as EcomTest.postman_collection.json in this main directory.
I only completed products get and store functionality because I think it is not necessary for the test.
Because in test question there are no mention.
