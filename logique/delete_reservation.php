<?php
include "../cnxDB.php";

if (isset($_GET['id'])) {
    $reservation_id = $_GET['id'];

    $check_invoice_sql = "SELECT * FROM invoice WHERE reservation_id = $reservation_id";
    $invoic = mysqli_query($conn, $check_invoice_sql);

    if (mysqli_num_rows($invoic) > 0) {
        $delinvoic = "DELETE FROM invoice WHERE reservation_id = $reservation_id";
        $delInvoicResult = mysqli_query($conn, $delinvoic);

        if (!$delInvoicResult) {
            echo "Error deleting associated invoice: " . mysqli_error($conn);
        }
    }

    $delet_reserv = "DELETE FROM reservation WHERE reservation_id = $reservation_id";
    $dele_reserv_result = mysqli_query($conn, $delet_reserv);

    if ($dele_reserv_result) {
       header("location:../reservation.php");
    } else {
        echo "Error deleting reservation: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

?>
