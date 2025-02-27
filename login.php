<?php

function login()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "default";

    // Vytvoření připojení
    $connection = new mysqli($servername, $username, $password, $dbname);

    // Kontrola připojení
    if ($connection->connect_error) {
        die("Připojení selhalo: " . $connection->connect_error);
    }
    return $connection;
}