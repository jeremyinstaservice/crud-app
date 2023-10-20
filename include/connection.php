<?php

function connectToDB()
{
    $con = mysqli_connect("127.0.0.1:3306", "u261292273_jeremy", "P*d8xCF?", "u261292273_crud_site");

    if (!$con) {

        die("Connection failed: " . mysqli_connect_error());

    }

    return $con;
}

$con = connectToDB();

// echo "Connected to database successfully";

?>
