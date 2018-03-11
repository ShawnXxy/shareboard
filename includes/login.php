<?php 
    include "config.php"; 

    session_start();

    if (isset($_POST['login'])) {
        $login_username = mysqli_real_escape_string($con, $_POST['username']);
        $login_password = md5(mysqli_real_escape_string($con, $_POST['password']));

        $sql = "SELECT * FROM {$table_users} WHERE username = '{$login_username}';";
        $query = mysqli_query($con, $sql);
        if (!$query) {
            die("Query failed : " . mysqli_error($con));
        }

        while ($row = mysqli_fetch_assoc($query)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $password = $row['password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_role = $row['user_role'];
        }

        // Check authentication
        if ($login_username === $username && $login_password === $password ) {
            // Session
            $_SESSION['username'] = $username;
            $_SESSION['user_firstname'] = $user_firstname;
            $_SESSION['user_lastname'] = $user_lastname;
            $_SESSION['user_role'] = $user_role;

            // Redirect
            header("Location: ../admin"); 
            // echo "<p class='bg-warning'>Username or password is incorrect!</p>";

        } else {
            header("Location: ../index.php");
        }
    }
?>