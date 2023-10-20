<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("include/connection.php");


try {

    if (isset($_POST['vote_update'])) {
        if (empty($_POST['vote_count'])) {
            echo "New Vote number cannot be empty";
        } else if ($_POST['vote_count'] > 1000) {
            echo '"<h1 class="text-5xl">New Vote number cannot be greater than total vote needed </h1>"';
        } else {
            $vote_count = $_POST['vote_count'];

            echo $vote_count;

            $query = " UPDATE vote_Count SET Vote_count = '" . $vote_count . "' ";

            $result = mysqli_query($con, $query);

            if ($result) {
                header("location:view.php");
            } else {
                echo " There seems to be something wrong in your query statement. Please check and try again " . mysqli_error($con);
            }
        }
    }

} catch (Exception $e) {
    echo $e->getMessage();
}




?>