<?php

function connect() {
    $db = new mysqli('HOST', 'USERNAME', 'PASSWORD', 'DATABASE');
    return $db;
}

?>
