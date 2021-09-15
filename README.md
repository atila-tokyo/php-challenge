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

`DB_HOST=<ip_address>`<br>
`DB_PORT=<port_number>`<br>
`DB_DATABASE=<dbname>`<br>
`DB_USERNAME=<username>`<br>
`DB_PASSWORD=<password>`<br>

Script for table creation

`CREATE DATABASE address CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`<br>
`CREATE USER '<username>'@'%' identified by '<password>';`<br>
`GRANT ALL on address.* to 'address'@'localhost';`<br>

 `CREATE TABLE address (`<br>
   `id INT NOT NULL AUTO_INCREMENT,`<br>
   `cep VARCHAR(255) NOT NULL,`<br>
   `logradouro VARCHAR(255),`<br>    
   `complemento VARCHAR(255),`<br>    
   `bairro VARCHAR(255),`<br>    
   `localidade VARCHAR(255),`<br>    
   `uf VARCHAR(255),`<br>    
   `ibge VARCHAR(255),`<br>    
   `gia VARCHAR(255),`<br>    
   `ddd VARCHAR(255),`<br>    
   `siafi VARCHAR(255),`<br>    
   `PRIMARY KEY (id)`<br>    
`) ENGINE=INNODB;`<br>


Now you can test the app! Use the command  `php -S 127.0.0.1:8000 -t public` to  run a PHP server on `http://localhost:8000/`

