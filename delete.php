<?php

require_once("include/connection.php");

if (isset($_GET['DEL'])) {
    $User_ID = $_GET['DEL'];

    $query = " DELETE FROM signup WHERE USER_ID = '" . $User_ID . "' ";
    $result = mysqli_query($con, $query);


    if ($result) {
        header("location:view.php");
    } else {
        echo "Please check your query command";
    }
}


?>