<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('session.gc_maxlifetime', 10);
error_reporting(E_ALL);


if (isset($_POST['login'])) {

    session_start();
    // Define the correct password
    $correctPassword = "12345";

    // User is not authenticated, check if the password form is submitted

    $password = $_POST['password'];
    // echo $password;

    // Verify the entered password
    if ($password === $correctPassword) {
        // Password is correct, set session variable to authenticate the user
        $_SESSION['authenticated'] = true;
        // echo "Correct login";
        // Redirect to the protected page
        header("location: view.php");
        exit();
    } else {
        $errorMessage = "Incorrect password. Please try again.";
    }

} else {
    // echo "Failed to authenticate login";
}
?>




<!DOCTYPE html>
<html>

<head>
    <link rel="icon"
        href="https://png.pngtree.com/element_our/png_detail/20181211/libra-icon-design-vector-png_265791.jpg"
        type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/7a1c951b45.js" crossorigin="anonymous"></script>
    <title>Login</title>
    <style>
        body {}

        /* Center the login form vertically and horizontally */
        .form-container {
            height: calc(100vh - 10vh);
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 50px;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Create a pseudo-element for the background overlay */
        .form-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            filter: blur(5px);
            border-radius: 10px;
            z-index: -1;
        }

        form {
            min-width: 700px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            background-color: transparent;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            z-index: 1;
        }

        *:focus {
            outline: 0 none !important;
        }

        input[type="password"] {
            height: 5rem;
            padding: 1rem;
            border: none;
            border-bottom: 1px solid black;
        }

        input:focus {
            outline: tranparent !important;
            border: none;
        }

        input[type="submit"] {
            height: 5rem;
            padding: 1rem;
            background: #419dff;
            padding: .5rem 2rem;
            color: white;
            font-weight: 500;
            outline: none !important;
        }
    </style>
</head>

<body>
    <div class="form-container w-full text-4xl lg:text-lg">
        <h1>Login to access</h1>

        <?php
        if (isset($errorMessage)) {
            echo "<p style='color: red;'>$errorMessage</p>";
        }
        ?>

        <form method="POST" action="">
            <label for="password">Password:</label>
            <input type="password" name="password" class="text-3xl" placeholder="Enter passcode" style="" required>
            <input type="submit" value="Login" name="login">
        </form>

    </div>
</body>

</html>