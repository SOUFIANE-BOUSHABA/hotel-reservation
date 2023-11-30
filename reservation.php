<?php  include 'header.php'; ?>

    <section class="container mt-5"  style="height:80vh">
        <h2 class="text-center mb-4">Reservations</h2>

        <?php
        $id=$_SESSION['user_id'];
        $sql = "SELECT
            r.reservation_id,
            r.start_date,
            r.end_date,
            r.total_cost,
            i.status,
            rd.room_number
        FROM
            reservation r
         JOIN invoice i ON r.reservation_id = i.reservation_id
         JOIN users u ON r.user_id = u.user_id
         JOIN room_details rd ON r.room_detail_id = rd.room_detail_id
        WHERE r.user_id = $id";

       $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            ?>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col"># room</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                   
                    <th scope="col">Total Cost</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $row['reservation_id']; ?></th>
                        <td><?php echo $row['room_number']; ?></td>
                        <td><?php echo $row['start_date']; ?></td>
                        <td><?php echo $row['end_date']; ?></td>
                        
                        <td><?php echo $row['total_cost']; ?> dh</td>
                        <td>
                            <?php
                            if ($row['status'] == 'Paid') {
                                echo '<span class="badge bg-success">Paid</span>';
                            } else {
                                echo '<span class="badge bg-warning">' . $row['status'] . '</span>';
                            }
                            ?>
                        </td>
                        <td><a href="logique/delete_reservation.php?id=<?php echo $row['reservation_id']; ?>">Delete</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    } else {
        echo "No reservations found.";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}


?>

    </section>

    <footer class="bg-light text-center p-3">
        <p>&copy; 2023 Hotel Youbooking. All Rights Reserved.</p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>