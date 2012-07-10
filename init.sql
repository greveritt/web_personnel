CREATE DATABASE IF NOT EXISTS OPUS;
USE OPUS;
CREATE TABLE employees (id INT(30), 
    first_name VARCHAR(30), 
    last_name VARCHAR(30), 
    phone_number CHAR(10), 
    location ENUM("New Jersey", "New York", "California"), 
    PRIMARY KEY(id));
