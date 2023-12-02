<?php  
include 'header.php';
if(!isset($_SESSION['role_id']) ||  $_SESSION['role_id'] != 2){
  header('location:../login.php');
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'aside.php' ?>

        <main class="col-md-10 p-3 main-content">

            <section class="section dashboard">
              
                <a type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Room</a>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Room</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../logique/addroom.php" method="post">
                                    <div class="mb-3">
                                        <label for="roomNumber" class="form-label">Room Number:</label>
                                        <input type="text" class="form-control" id="roomNumber" name="roomNumber" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="roomNumber" class="form-label">price :</label>
                                        <input type="text" class="form-control" id="roomNumber" name="prix" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="roomNumber" class="form-label">amenties :</label>
                                        <input type="text" class="form-control" id="roomNumber" name="amentic" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="roomType" class="form-label">Room Type:</label>
                                        <select class="form-select" id="roomType" name="roomType" required>
                                        <?php
                                            $id=$_SESSION['user_id'];
                                            $typeSql = "SELECT * FROM typeroom " ;
                                            $res = mysqli_query($conn, $typeSql);
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                echo "<option value='{$row['roomtype_id']}'>{$row['room_type']}</option>";
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="hotelId" class="form-label">Select Hotel:</label>
                                        <select class="form-select" id="hotelId" name="hotelId" required>
                                            <?php
                                            $id=$_SESSION['user_id'];
                                            $hotelSql = "SELECT hotel_id, name FROM hotel where user_id = $id" ;
                                            $res = mysqli_query($conn, $hotelSql);
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                echo "<option value='{$row['hotel_id']}'>{$row['name']}</option>";
                                            } ?>
                                        </select>
                                    </div>

                                    <button type="submit" name="insertroom" class="btn btn-primary">Add Room</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <table class="table align-middle mb-0 bg-white shadow ">

                    <thead class="bg-light">
                        <tr>
                            <th>Room Number</th>
                            <th>Room Type</th>
                            <th>Hotel</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $userId = $_SESSION['user_id'];
                        $sql = "SELECT room_details.room_number, typeroom.room_type, hotel.name 
                                FROM room_details
                                JOIN room ON room_details.room_id = room.room_id
                                JOIN typeroom ON room.roomtype_id = typeroom.roomtype_id
                                JOIN hotel ON room.hotel_id = hotel.hotel_id
                                WHERE hotel.user_id = $userId";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= $row['room_number'] ?></td>
                                    <td><?= $row['room_type'] ?></td>
                                    <td><?= $row['name'] ?></td>
                                    <td>
                                        <a type="button" class="btn btn-danger">Delete</a>
                                        <a type="button" class="btn btn-warning">Update</a>
                                    </td>
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
