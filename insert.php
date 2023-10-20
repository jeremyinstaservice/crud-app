<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("include/connection.php");

try {

    if (isset($_POST["submit"])) {
        function get_client_ip()
        {
            $ip = '';
            if (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }

        $ip = get_client_ip();
        // echo $ip;

        // $my_ip = $_GET['ip'];

        $url = 'https://api.ip2location.io/?key=2E356E745332DB637417230C7997A646&ip=' . $ip;

        $response = file_get_contents($url);
        echo $response;


        if ($response) {
            $data = json_decode($response, true); // Decode the JSON response into an associative array
            // echo $data;

            if ($data && is_array($data)) {
                foreach ($data as $key => $value) {
                    echo "$key: $value <br >";
                    if ($key == 'ip') {
                        $ip_address = $value;
                    }
                    if ($key == 'country_name') {
                        $country_name = $value;
                    }
                    if ($key == 'region_name') {
                        $region_name = $value;
                    }
                    if ($key == 'city_name') {
                        $city_name = $value;
                    }
                }
            } else {
                echo "Invalid JSON Data";
            }
        } else {
            echo "API Request failed";
        }



        if (empty($_POST['email']) || empty($_POST['password'])) {
            echo "Please fill in the blank fields";
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];
            // $password = password_hash($_POST['password'], PASSWORD_DEFAULT);



            $query = " INSERT INTO signup ( Email, Password, Country_name, Region_name, Ip_address, City_name) VALUES ('$email', '$password', '$country_name', '$region_name', '$ip_address', '$city_name') ";

            $result = mysqli_query($con, $query);

            if ($result) {
                header("location:success.php");
            } else {
                echo " There seems to be something wrong in your query statement. Please check and try again " . mysqli_error($con);
            }

        }
    } else {
        echo "Connection failed" . mysqli_error($con);
        // header("location:index.php");

    }

} catch (Exception $e) {
    echo $e->getMessage();
}

?>