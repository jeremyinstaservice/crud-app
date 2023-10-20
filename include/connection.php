<?php

function connectToDB()
{
    $con = mysqli_connect("sql105.infinityfree.com", "if0_34958315", "QbfygG4HsaPpf6x", "if0_34958315_crud_site");

    if (!$con) {

        die("Connection failed: " . mysqli_connect_error());

    }

    return $con;
}

$con = connectToDB();

// echo "Connected to database successfully";

?>