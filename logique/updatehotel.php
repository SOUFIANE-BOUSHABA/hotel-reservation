<?php
include '../cnxDB.php';

if (isset($_POST['updatehotel'])) {
    $hotelId = $_POST["id_hotel"];
    $locationId = $_POST["id_location"];
    $hotelName = $_POST["name"];
    $contactNumber = $_POST["contactNumber"];
    $amenities = $_POST["amenities"];
    $pays = $_POST["pays"];
    $ville = $_POST["ville"];

    $id=$_SESSION['user_id'];

    
    $updateLocalisation = "UPDATE localisation SET pays='$pays', ville='$ville' WHERE location_id = $locationId";
    $resultUpdateLocal = mysqli_query($conn, $updateLocalisation);

    if ($resultUpdateLocal) {
        $updateHotel = "UPDATE hotel SET name='$hotelName', contact_number='$contactNumber', amenities='$amenities' , `user_id` =$id WHERE hotel_id = $hotelId";
        $resultUpdateHotel = mysqli_query($conn, $updateHotel);

        if ($resultUpdateHotel) {
            header('location:../dashboard/hotel.php');
        } 
    } 
}
?>
