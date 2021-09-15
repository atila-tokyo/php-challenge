PHP App
==============

This is a simple app that provide detailed address information based on a CEP number


Installation
------------
First, you will need to install [Composer](http://getcomposer.org/) following the instructions on their site.

Afterwards, run `composer install`

Configuration
-------------
Make sure to create a database of your preference in order to store the information

Configure the database on the .env file

`DB_HOST=***.*.*.*
 DB_PORT=***
 DB_DATABASE=dbname
 DB_USERNAME=username
 DB_PASSWORD=*****`

Script for table creation

`CREATE DATABASE address CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`
`CREATE USER 'address'@'%' identified by 'address';`
`GRANT ALL on address.* to 'address'@'%';`

 `CREATE TABLE address (`
    id INT NOT NULL AUTO_INCREMENT,
    cep VARCHAR(255) NOT NULL,
    logradouro VARCHAR(255),    
    complemento VARCHAR(255),    
    bairro VARCHAR(255),    
    localidade VARCHAR(255),    
    uf VARCHAR(255),    
    ibge VARCHAR(255),    
    gia VARCHAR(255),    
    ddd VARCHAR(255),    
    siafi VARCHAR(255),    
    PRIMARY KEY (id)    
) ENGINE=INNODB;`


Now you can test the app! Use the command  `php -S 127.0.0.1:8000 -t public` to  run a PHP server on `http://localhost:8000/`

