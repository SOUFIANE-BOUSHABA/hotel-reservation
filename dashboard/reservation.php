<?php  
include 'header.php';
if(!isset($_SESSION['role_id']) ||  $_SESSION['role_id'] != 2 && $_SESSION['role_id'] != 4){
  header('location:../login.php');
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'aside.php' ?>

        <main class="col-md-10 p-3 main-content">


            <section class="section dashboard">



                <table class="table align-middle mb-0 bg-white shadow ">

                    <thead class="bg-light">
                        <tr>
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
                      $userId = $_SESSION['user_id'];
                      $sql = "SELECT * FROM reservation r
                      JOIN invoice i ON r.reservation_id = i.reservation_id
                      JOIN users u ON r.user_id = u.user_id
                      JOIN room_details rd ON r.room_detail_id = rd.room_detail_id
                      JOIN room rm ON rm.room_id = rd.room_detail_id
                      JOIN hotel h ON h.hotel_id = rm.hotel_id
                  WHERE h.responsable_id = $userId";

                      $result = mysqli_query($conn, $sql);

                      if (mysqli_num_rows($result) > 0) {
                          while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                        <th scope="row"><?php echo $row['reservation_id']; ?></th>
                        <td><?php echo $row['room_number']; ?></td>
                        <td><?php echo $row['start_date']; ?></td>
                        <td><?php echo $row['end_date']; ?></td>
                        
                        <td><?php echo $row['total_cost']; ?> dh</td>




    </div>
    </tr>
    <?php }}?>
    </tbody>
    </table>

    </section>

    </main>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>