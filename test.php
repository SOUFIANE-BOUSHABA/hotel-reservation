<?php
include 'cnxDB.php';

$response = array();

$room_id = $_POST['room_id'];
$startdate = $_POST["startDate"];
$enddate = $_POST["endDate"];

if (strtotime($startdate) > strtotime($enddate)) {
    $response['status'] = 'error';
    $response['message'] = 'End date should be after start date.';
} else {
    $sql = "SELECT * FROM reservation 
            WHERE room_detail_id IN (SELECT room_detail_id FROM room_details WHERE room_detail_id = $room_id) 
            AND (('$startdate' BETWEEN start_date AND end_date) OR ('$enddate' BETWEEN start_date AND end_date))";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        if (mysqli_num_rows($res) < 1) {
            $response['status'] = 'success';
            $response['message'] = 'Room is available on these dates.';
        } else {
            $response['status'] = 'warning';
            $response['message'] = 'Sorry, the room is not available.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . mysqli_error($conn);
    }
}


echo json_encode($response);
?>
