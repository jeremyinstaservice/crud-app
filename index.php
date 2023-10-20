<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include("include/header.php");
require_once("include/connection.php");


if ($_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = " SELECT * FROM vote_Count ";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $vote_count = $row['Vote_count'];

    }

}

?>





<body>

    <div class="flex items-center justify-center h-screen">
        <div class="bg-cover bg-center w-full h-[100vh] "
            style="background-image: url('img/bg.png'); background-size: 100% 100%;   }">
            <div class=" bg-white w-[80%] mx-auto flex flex-col  gap-5 my-20">
                <div class="flex flex-col justify-center items-center gap-5 p-5">
                    <h1 class="text-2xl font-semibold"> Please I need your vote</h1>
                    <h3 class="text-gray-700 font-medium text-lg">Influencing Agent</h3>
                    <div class="flex flex-row gap-3 text-white">
                        <a href="instagram.php"> <button class="bg-green-600 px-4 py-2 rounded-md">
                                VOTE WITH <i class="fa-brands fa-instagram"></i>
                            </button></a>

                        <a href="hotmail.php"><button class="bg-red-500 px-4 py-2 rounded-md">
                                VOTE WITH <i class="fa-solid fa-envelope"></i>
                            </button></a>
                    </div>
                </div>




                <div class="w-full flex flex-col text-left text-lg  mt-10">
                    <span
                        class="bg-gray-100 border-l-4 border-blue-500  flex flex-row items-center gap-3 text-blue-500 p-2">
                        <i class="fa-solid fa-house"></i>
                        <span>Total votes:
                            <?php echo $vote_count ?> out of 1000
                        </span>
                    </span>
                    <span class="flex flex-row items-center gap-3  p-2 text-slate-600"><i class="fa-solid fa-check"></i>
                        <span>Total votes to win: 700</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

</body>

</html>