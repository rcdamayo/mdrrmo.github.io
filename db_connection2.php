<?php
$mysqli = new mysqli('localhost', 'root', '', 'edr_db');

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>