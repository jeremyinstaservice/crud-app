<?php


require_once("include/connection.php");

if (isset($_POST['update'])) {
    $UserID = $_GET['ID'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $query = " UPDATE signup SET Full_name = '" . $full_name . "', Email = '" . $email . "', Password = '" . $password . "' WHERE USER_ID = '" . $UserID . "' ";

    $result = mysqli_query($con, $query);

    if ($result) {
        header("location:view.php");
    } else {
        echo "Please check your query command";
    }
} else {
    header("location:view.php");
}



?>