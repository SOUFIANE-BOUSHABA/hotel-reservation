<?php
include '../cnxDB.php';

if (isset($_POST["responsable"])) {
    $user_id = $_POST["user_id"];
    $hotelId = $_POST["hotelId"];

    $updateuser = "UPDATE `users` SET `role_id`='4', `request_id`='5' WHERE user_id = $user_id";
    $result = mysqli_query($conn, $updateuser);

    $updatehotel = "UPDATE `hotel` SET `responsable_id`= $user_id WHERE  hotel_id = $hotelId";
    $result2 = mysqli_query($conn, $updatehotel);

    header('location:../dashboard/requestresponsable.php');
    exit;
}
?>
