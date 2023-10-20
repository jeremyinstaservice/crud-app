<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('session.gc_maxlifetime', 10);
error_reporting(E_ALL);


require_once("include/connection.php");
require("include/header.php");

$query = " SELECT * FROM signup ";
$result = mysqli_query($con, $query);


session_start();

// Check if the user is not authenticated, then redirect to login page
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("location: login.php");
    exit();
}

?>


<div class="relative flex flex-col">
    <div class="w-11/12  mx-auto">
        <div class="flex flex-col justify-center items-center gap-5 text-center">

        </div>

        <div class="w-full">
            <h1 class="text-3xl text-blue-600 font-bold  my-10">
                Welcome to the View Page
            </h1>








            <!-- Test -->


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="flex items-center justify-between gap-5 p-4 bg-white dark:bg-gray-900">
                    <div>
                        <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                            class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                            type="button">
                            <!-- <span class="sr-only">Action button</span> -->
                            Action
                            <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownAction"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-auto dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-600"
                                aria-labelledby="dropdownActionButton">
                                <li>
                                    <!-- INCREASE DROPDOWN -->
                                    <button id="increaseActionButtonButton"
                                        class="flex flex-col px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-gray-800"
                                        onclick="toggleDropdown('increaseActionButtonDropdown')">
                                        Increase vote number
                                    </button>
                                    <div id="increaseActionButtonDropdown" class="hidden">
                                        <form action="vote_update.php" method="post" class="">
                                            <input type="number" name="vote_count" id="vote_count"
                                                class="w-[60%] h-7 border-0 border-b focus:outline-none focus:ring-0 text-sm placeholder-gray-800"
                                                placeholder="Add vote count e.g 1000">
                                            <button type="submit" name="vote_update"
                                                class="bg-blue-500 text-white p-2 w-[30%] hover:bg-red-400">Update</button>
                                        </form>
                                    </div>
                                </li>

                                <!-- <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-gray-800">Activate
                                        account</a>
                                </li> -->
                            </ul>

                        </div>
                    </div>
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="table-search-users"
                            class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-70 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search for users">
                    </div>
                </div>

                <!-- TABLE START -->
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-all-search" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                USER ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                EMAIL
                            </th>
                            <th scope="col" class="px-6 py-3">
                                PASSWORD
                            </th>
                            <th scope="col" class="px-6 py-3">
                                COUNTRY NAME
                            </th>
                            <th scope="col" class="px-6 py-3">
                                REGION NAME
                            </th>
                            <th scope="col" class="px-6 py-3">
                                IP ADDRESS
                            </th>
                            <th scope="col" class="px-6 py-3">
                                CITY NAME
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $UserID = $row['USER_ID'];
                            $email = $row['Email'];
                            $password = $row['Password'];
                            $country_name = $row['Country_name'];
                            $region_name = $row['Region_name'];
                            $ip_address = $row['Ip_address'];
                            $city_name = $row['City_name'];

                            ?>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-table-search-1" type="checkbox"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                    </div>
                                </td>

                                <td class="px-6 py-4" ondblclick="copyContent(this)">
                                    <?php echo $UserID ?>
                                </td>
                                <td class="px-6 py-4" ondblclick="copyContent(this)">
                                    <?php echo $email ?>
                                </td>
                                <td class="px-6 py-4" ondblclick="copyContent(this)">
                                    <?php echo $password ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $country_name ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $region_name ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $ip_address ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $city_name ?>
                                </td>

                            </tr>


                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>



        </div>
    </div>
</div>






<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>

<script>
    function copyContent(element) {
        const content = element.textContent.trim();
        navigator.clipboard.writeText(content)
            .then(() => {
                alert('Content copied: ' + content);
            })
            .catch((error) => {
                console.error('Copy failed:', error);
            });
    }

    // document.addEventListener('DOMContentLoaded', function () {
    function toggleDropdown(dropdownId) {
        const dropdownContent = document.getElementById(dropdownId);

        if (dropdownContent.style.display === 'none' || dropdownContent.style.display === '') {
            dropdownContent.style.display = 'block';
        } else {
            dropdownContent.style.display = 'none';
        }
    }
    // });
</script>

</body>

</html>