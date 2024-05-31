<?php

    function connectDatabase()
    {
        $server = "localhost";
        $database = "fashionshop";
        $username = "root";
        $password = "";
        $connection = null;

        try
        {
            $connection = new PDO("mysql: host=$server; dbname=$database", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $exception)
        {
            echo "Connection Error: " . $connection->errorCode();
        }

        return $connection;
    }


?>