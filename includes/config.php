<?php
    /**
     *  Config database
     */
    DEFINE('DB_USERNAME', 'root');
    DEFINE('DB_PASSWORD', 'root');
    DEFINE('DB_HOST', 'localhost');
    DEFINE('DB_DATABASE', 'shareboard');
 
    $db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
 
    $table_name = 'categories';
    // Check table existence
    // $sql = "DROP TABLE IF EXISTS {$table_name};";
    // mysqli_query($db, $sql);
    // Create table
    $sql = "CREATE TABLE {$table_name} (id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY, cat_title VARCHAR(255) NOT NULL);";
    mysqli_query($db, $sql);

    // Connect to database
    // ob_start();
    $con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if (!$con) {
        echo "Database connection failed!";
    }

?>