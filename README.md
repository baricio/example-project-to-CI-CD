# Example project to test CI/CD

## About

This project has the necessary to implement a test of CI/CD

## Steps of deploy

Install packages

```bash
composer install
npm install
```

Fill database

```bash
php artisan migrate
```

build app.js to run javascript

```bash
npm run prod
```

run tests

```bash
./vendor/bin/phpunit tests/ 
```
