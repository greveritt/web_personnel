<?php
// connect to MySQL server and create database 'daedalus', selects 'daedalus'
$our_db = new mysqli('localhost', 'INSERT_LOGIN_NAME_HERE', 'INSERT_PASSWD_HERE');

/*check connection for errors */
if ($our_db->connect_errno) {
    printf("Connection failed: %s\n", $our_db->connect_errno);
    exit();
}

$our_db->query('CREATE DATABASE daedalus;');
$our_db->select_db('daedalus');

//create employee table
$our_db->query('CREATE TABLE employees (
    id INT(30), 
    first_name VARCHAR(10), 
    last_name VARCHAR(10), 
    phone_number INT(10), 
    location ENUM("New Jersey", "New York", "California"), 
    PRIMARY KEY(id));');
//close database connection
$our_db->close()
?>
    
