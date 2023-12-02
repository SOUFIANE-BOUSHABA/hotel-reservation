<?php
include '../cnxDB.php';

if (isset($_GET['deletehotel'])) {
    $hotelId = $_GET['deletehotel'];
    $locationId = $_GET['deletelocation'];

    $sqllocation = "DELETE FROM localisation WHERE location_id = $locationId";
    $resloca = mysqli_query($conn, $deleteLocation);

    if ($resloca) {
        $sqlhotel = "DELETE FROM hotel WHERE hotel_id = $hotelId";
        $reshotel = mysqli_query($conn, $sqlhotel);
      

        if ($reshotel) {
            header('location:../dashboard/hotel.php');
        } else {
            echo "Error deleting location: " . mysqli_error($conn);
        }
    } else {
        echo "Error deleting hotel: " . mysqli_error($conn);
    }
}
?>
