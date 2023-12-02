<?php
include '../cnxDB.php';

if (isset($_POST["insertroom"])) {

    $roomNumber = $_POST["roomNumber"];
    $roomTypeId =  $_POST["roomType"];
    $hotelId = $_POST["hotelId"];
    $price = $_POST["prix"];
    $amentic = $_POST["amentic"];
    
    $roomId = null; // Initialize $roomId to null

    $check = "SELECT room_id FROM room WHERE hotel_id = $hotelId AND roomtype_id = $roomTypeId LIMIT 1";
    $result = mysqli_query($conn, $check);

 
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $roomId = $row["room_id"];
    } else {

        $sql_rom = "INSERT INTO room (hotel_id, roomtype_id, `price`, `amenities`) VALUES ($hotelId, $roomTypeId, $price, '$amentic')";
        $res_rom = mysqli_query($conn, $sql_rom);
        $roomId = mysqli_insert_id($conn);
    }

    $rom_deta = "INSERT INTO room_details (room_id, room_number) VALUES ($roomId, '$roomNumber')";
    $resul = mysqli_query($conn, $rom_deta);

   

    header('location:../dashboard/romms.php');
}    ?>
