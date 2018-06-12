<?php 
    include "config.php"; 

    session_start();

    if (isset($_POST['login'])) {
        $login_username = mysqli_real_escape_string($con, $_POST['username']);
        $login_password = mysqli_real_escape_string($con, $_POST['password']);
        $md5_login = md5($login_password);
        $hash = password_hash($md5_login, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM $table_users WHERE username = '$login_username';";
        $query = mysqli_query($con, $sql);
        if (!$query) {
            die("Query failed : " . mysqli_error($con));
        }

        while ($row = mysqli_fetch_array($query)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $password = $row['password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_role = $row['user_role'];
        }

        // Check authentication
        if ($login_username === $username && password_verify($password, $hash)) {
            // Session
            $_SESSION['username'] = $username;
            $_SESSION['user_firstname'] = $user_firstname;
            $_SESSION['user_lastname'] = $user_lastname;
            $_SESSION['user_role'] = $user_role;

            // Redirect
            header("Location: ../index.php"); 
            
        } else {
            header("Location: ../index.php");
            echo "<p class='bg-warning'>Username or password is incorrect!</p>";
            // var_dump(die($md5_login . "___________________" . $password));
        }
    }
?>