<?php
/**
 * 
 * User: 
 * Date: 01/07/2021
 * Time: 08:26
 */

$servername = "localhost";
$dbname='stockproper';
$username = "root";
$password = "";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
// echo "success";