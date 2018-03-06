<?php
    /**
     *  Config database
     */
    DEFINE('DB_USERNAME', 'root');
    DEFINE('DB_PASSWORD', 'root');
    DEFINE('DB_HOST', 'localhost');
    DEFINE('DB_DATABASE', 'shareboard');
 
    $db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
 
    $table_cat = 'categories';
    $table_posts = 'posts';

    // Check table existence
    // $sql = "DROP TABLE IF EXISTS {$table_name};";
    // mysqli_query($db, $sql);

    // Create table
    $sql = "CREATE TABLE {$table_cat} (cat_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY, cat_title VARCHAR(255) NOT NULL);";
    mysqli_query($db, $sql);

    $sql = "CREATE TABLE {$table_posts} (post_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY, post_cat_id INT(8) UNSIGNED, post_title VARCHAR(255) NOT NULL, post_author VARCHAR(255) NOT NULL, post_date DATETIME DEFAULT CURRENT_TIMESTAMP, post_img TEXT, post_content TEXT NOT NULL, post_tags VARCHAR(255), post_comment_count INT(11), post_status VARCHAR(255), post_views_count INT(11), FOREIGN KEY (post_cat_id) REFERENCES {$table_cat}(id));";
    mysqli_query($db, $sql);

    // Connect to database
    // ob_start();
    $con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if (!$con) {
        echo "Database connection failed!";
    }

?>