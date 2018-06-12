<?php
    /********************************
     *
     *  Config database
     *
     *********************************/
    DEFINE('DB_USERNAME', 'shawnxxy');
    DEFINE('DB_PASSWORD', 'XXy@4592995');
    DEFINE('DB_HOST', '107.180.12.114');
    DEFINE('DB_DATABASE', 'shawnxxy_shareboard');

    $db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    // Check table existence
    // $sql = "DROP TABLE IF EXISTS {$table_name};";
    // mysqli_query($db, $sql);

    /*****************************
     *
     * Create table
     *
     *********************************/
    $table_cat = 'categories';
    $table_posts = 'posts';
    $table_comments = 'comments';
    $table_users = 'users';
    $table_usersOnline = "users_online";

    // categories
    $sql = "CREATE TABLE $table_cat (
        cat_id INT(8) AUTO_INCREMENT PRIMARY KEY,
        cat_title VARCHAR(255) NOT NULL
    );";
    mysqli_query($db, $sql);

    // blog posts
    $sql = "CREATE TABLE $table_posts (
        post_id INT(8) AUTO_INCREMENT PRIMARY KEY,
        post_cat_id INT(8),
        post_title VARCHAR(255) NOT NULL,
        post_author VARCHAR(255) NOT NULL,
        post_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        post_img TEXT,
        post_content TEXT NOT NULL,
        post_tags VARCHAR(255),
        post_comment_count INT(11),
        post_views_count INT(11)
    );";
    mysqli_query($db, $sql);

    // Comments
    $sql = "CREATE TABLE $table_comments (
        comment_id INT(11) AUTO_INCREMENT PRIMARY KEY,
        comment_post_id INT(8),
        comment_author VARCHAR(255),
        comment_email VARCHAR(255),
        comment_content TEXT,
        comment_date DATETIME DEFAULT CURRENT_TIMESTAMP
    );";
    mysqli_query($db, $sql);

    // USERS
    $sql = "CREATE TABLE $table_users (
        user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        user_firstname VARCHAR(255),
        user_lastname VARCHAR(255),
        user_email VARCHAR(255) NOT NULL,
        user_role INT(3) NOT NULL,
        user_img TEXT,
        user_posts VARCHAR(255),
        reg_time DATETIME DEFAULT CURRENT_TIMESTAMP
    );";
    mysqli_query($db, $sql);

    // Users online
    $sql = "CREATE TABLE $table_usersOnline (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        session VARCHAR(255) NOT NULL,
        time INT(11) NOT NULL
    );";
    mysqli_query($db, $sql);

    /*************************************
     *
     *  Connect to database
     *
     ***********************************/
    // ob_start();
    $con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if (!$con) {
        echo "Database connection failed!";
    }

?>
