# Product Catalog API

This is a RESTful API built with Laravel to manage a product catalog. The API allows for managing products, categories, and retrieving product information with filtering and pagination options.

## Features
- CRUD operations for products (Create, Read, Update, Delete)
- CRUD operations for categories
- Request validation for all inputs
- Pagination for product lists
- Filtering by category ID for products
- API versioning
- Basic error handling
- Unit tests for core logic
- API Documentation (using Postman)

## Requirements
- PHP >= 7.4
- Composer
- Laravel >= 8.x
- MySQL database

## Installation

Follow the steps below to set up the project locally.

### 1. Clone the repository
Clone this repository to your local machine using Git:

```bash
git clone https://github.com/mukeshua/ProductCatalog.git
cd ProductCatalog

composer install
composer require mockery/mockery --dev
php artisan key:generate
Ensure you have a MySQL database set up. Update the .env file with your database credentials (change file rename.env to .env)
php artisan migrate
php artisan serve

Refer this for API Documentation

https://documenter.getpostman.com/view/10176132/2sAYdhKqZc

Note:Set the {{baseUrl}} under Enviroments in Postman
like in Variable  baseUrl and in values enter http://127.0.0.1:8000/api/v1
