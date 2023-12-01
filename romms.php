<?php  include 'header.php';
   




?>

<div class="container">
    <div class="row">

        <div class="col-md-3" id="filter"
            style="position: sticky; top:70px; box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.1);">
            <div style="height:70px"></div>
            <h4>Filter </h4>

            <form class="mb-3" method="post">
                <div class="mb-3">
                    <label for="hotelName" class="form-label">Hotel Name</label>
                    <input type="text" class="form-control" name="hotelName" placeholder="Enter hotel name">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" name="city" placeholder="Enter city">
                </div>
                <button type="submit" name="filter" class="btn btn-primary">Filter by Name and City</button>
            </form>


            <!-- <form>
                <div class="mb-3">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="startDate">
                </div>
                <div class="mb-3">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="endDate">
                </div>
                <button type="submit" class="btn btn-primary">Filter by Start and End Date</button>
            </form> -->

        </div>


        <div class="col-md-9" id="roomList">
            <h2 class="text-center mb-4"> Rooms</h2>
            <div class="row">

                <?php        
                if (isset($_POST['filter'])) {
                        $hotelName = $_POST["hotelName"];
                        $city = $_POST["city"];

                    

                        $sql = "SELECT room_details.room_number, typeroom.room_type, room.price, room.amenities, hotel.name
                                FROM room_details
                                INNER JOIN room ON room_details.room_id = room.room_id
                                INNER JOIN hotel ON room.hotel_id = hotel.hotel_id
                                INNER JOIN typeroom ON room.roomtype_id = typeroom.roomtype_id
                                INNER JOIN localisation ON hotel.location_id = localisation.location_id
                                WHERE hotel.name = '$hotelName' AND localisation.ville = '$city'";

                        $result =mysqli_query($conn,$sql);

                        if (mysqli_num_rows($result) > 0) {
                        

                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <img src="img/rom1.jpg" class="card-img-top img-fluid" alt="Room 1">
                                            <div class="card-body">
                                                <h5 class="card-title"><?=$row["room_type"] ?> : <?=$row["room_number"]?></h5>
                                                <p class="card-text"><?=$row["amenities"] ?></p>
                                                <p class="card-text"><?=$row["name"] ?></p>
                                                <p class="card-text"><?=$row["price"] ?></p>
                                                <a href="#" class="btn btn-primary">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php  }

                         
                        } else {
                            echo "<p>No rooms found.</p>";
                        }

                    } else{ 


                           $sql = "SELECT room_details.room_number, typeroom.room_type, room.price, room.amenities, hotel.name
                                FROM room_details
                                INNER JOIN room ON room_details.room_id = room.room_id
                                INNER JOIN hotel ON room.hotel_id = hotel.hotel_id
                                INNER JOIN typeroom ON room.roomtype_id = typeroom.roomtype_id
                                INNER JOIN localisation ON hotel.location_id = localisation.location_id";
                

                        $result =mysqli_query($conn,$sql);

                        if (mysqli_num_rows($result) > 0) {
                        

                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <img src="img/rom1.jpg" class="card-img-top img-fluid" alt="Room 1">
                                            <div class="card-body">
                                                <h5 class="card-title"><?=$row["room_type"] ?> : <?=$row["room_number"]?></h5>
                                                <p class="card-text"><?=$row["amenities"] ?></p>
                                                <p class="card-text"><?=$row["name"] ?></p>
                                                <p class="card-text"><?=$row["price"] ?></p>
                                                <a href="#" class="btn btn-primary">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php  }

                         
                        } else {
                            echo "<p>No rooms found.</p>";
                        }




                    } ?>

             


            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>