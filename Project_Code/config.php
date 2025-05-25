<?php
define("DB_HOST", "localhost");
define("DB_NAME", "hospital_management_system");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// Establish connection
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Check connection
if (!$connection) {
    throw new \mysql_xdevapi\Exception("Cant connect to database");
}



