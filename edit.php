<?php

include("include/header.php");

require_once("include/connection.php");

$USER_ID = $_GET['ID'];

$query = " SELECT * FROM signup WHERE USER_ID = '" . $USER_ID . "' ";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $UserID = $row['USER_ID'];
    $full_name = $row['Full_name'];
    $email = $row['Email'];
    $password = $row['Password'];
}

?>



<div class="flex-1 flex flex-col justify-left items-center mt-[10rem]">

    <h1 class="mb-10 text-3xl font-bold">Update User Details</h1>
    <form method="post" action="update.php?ID=<?php echo $UserID ?>" class="flex flex-col gap-10">

        <div class="flex flex-col text-lg gap-3 ">
            <label htmlFor="full_name" class="font-bold">
                Full Name
            </label>
            <input type="text" name="full_name" id="full_name" value="<?php echo $full_name ?>"
                class="bg-slate-100 w-[23rem] lg:w-[30rem] mx-auto h-[3rem] rounded-lg p-4 border-0 focus:border-0">
        </div>

        <div class="flex flex-col text-lg gap-3 ">
            <label htmlFor="email" class="font-bold">
                Email Address
            </label>
            <input type="text" name="email" id="email" value="<?php echo $email ?>"
                class="bg-slate-100 w-[23rem] lg:w-[30rem] mx-auto h-[3rem] rounded-lg p-4 border-0 focus:border-0">
        </div>

        <div class=" flex flex-col text-lg gap-3">
            <label htmlFor="password" class="font-bold">
                Password
            </label>
            <div class="flex flex-row items-center">
                <input name="password" id="password"
                    class="bg-slate-100 w-[23rem] lg:w-[30rem] h-[3rem] rounded-lg p-4 border-0 focus:border-0" />


            </div>
        </div>



        <button name="update" class="bg-blue-950 text-white font-bold py-3 px-10 rounded-full">
            Update User
        </button>


    </form>
</div>

</body>

</html>