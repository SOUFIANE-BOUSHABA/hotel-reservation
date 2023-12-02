<?php include 'header.php'; 
 $roomId = $_GET['room_id'];


if (isset($_POST['checkAv'])) {
    $room_id = $_POST["room_id"];
    $start_date = $_POST["startDate"];
    $enddate = $_POST["endDate"];

    $sql = "SELECT * FROM reservation 
                           WHERE room_detail_id IN (SELECT room_detail_id FROM room_details WHERE room_id = $room_id) 
                           AND (('$start_date' BETWEEN start_date AND end_date) OR ('$enddate' BETWEEN start_date AND end_date))";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        if (mysqli_num_rows($res) == 0) {
            echo "<script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-start',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'room is avilable in this date'
                    });
             </script>";
        } else {
            echo "<script>
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-start',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: 'warning',
                            title: 'sorry, rom not avilable'
                        });
             </script>";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


?>

<div class="container">
    <div class="row">

        <div class="col-md-3">
            <div style="position: sticky; top:70px; box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.1);">
                <div style="height:70px"></div>
                <h4>Check Availability</h4>

                <form class="mb-3" method="post" action="">
                    <input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="date" class="form-control" name="startDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" name="endDate" required>
                    </div>
                    <button type="submit" name="checkAv" class="btn btn-primary">Check Availability</button>
                </form>
            </div>
        </div>

        <div class="col-md-9">
            <h2 class="text-center mb-4">Room Details</h2>

            <?php
            $sql = "SELECT room_details.room_number, typeroom.room_type, room.price, room.amenities, hotel.name
                    FROM room_details
                    INNER JOIN room ON room_details.room_id = room.room_id
                    INNER JOIN hotel ON room.hotel_id = hotel.hotel_id
                    INNER JOIN typeroom ON room.roomtype_id = typeroom.roomtype_id
                    WHERE room_details.room_id = $roomId";

            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
            ?>
            <div class="row">

                <div class="col-md-12 ">
                    <div class="card ">

                        <div class="card-body d-flex gap-4">
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="img/rom1.jpg" class="card-img " alt="Room 1">
                                </div>
                            </div>
                            <div>
                                <h5 class="card-title"><?= $row["room_type"] ?> : <?= $row["room_number"] ?></h5>
                                <p class="card-text"><?= $row["amenities"] ?></p>
                                <p class="card-text"><?= $row["name"] ?></p>
                                <p class="card-text"><?= $row["price"] ?></p>
                                <a href="#" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            } else {
                echo "<p>No room details found.</p>";
            }
            ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>