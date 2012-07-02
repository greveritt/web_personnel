-- We are using the database name "OPUS", because why not?
CREATE DATABASE IF NOT EXISTS OPUS;
USE OPUS;
CREATE TABLE employees (id INT(30), 
    first_name VARCHAR(10), 
    last_name VARCHAR(10), 
    phone_number INT(10), 
    location ENUM("New Jersey", "New York", "California"), 
    PRIMARY KEY(id));
