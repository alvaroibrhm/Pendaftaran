<?php

include 'connect.php';

if (isset($_POST['signUp'])) {
    $firstName = $_POST['fName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Get the selected role
    $password = md5($password); // Hash the password

    // Check if the email already exists
    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);
    
    if ($result->num_rows > 0) {
        echo "Email Address Already Exists!";
    } else {
        // Insert the new user along with their role
        $insertQuery = "INSERT INTO users (firstName, email, password, role) VALUES ('$firstName', '$email', '$password', '$role')";
        
        if ($conn->query($insertQuery) === TRUE) {
            header("location: index.php"); // Redirect to the login page after registration
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password); // Hash the password

    // Check the email and password
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role']; // Store user role in session

        // Redirect to the respective homepage based on the role
        if ($row['role'] === 'admin') {
            header("location: admin_homepage.php");
        } else {
            header("location: user_homepage.php");
        }
        exit();
    } else {
        echo "Not Found, Incorrect Email or Password";
    }
}

?>