<?php  
include 'header.php';
if(!isset($_SESSION['role_id']) ||  $_SESSION['role_id']!=1 && $_SESSION['role_id']!=2 && $_SESSION['role_id']!=4){
  header('location:../login.php');
}



?>

<div class="container-fluid">
    <div class="row">
        <?php include 'aside.php' ?>

        <main class="col-md-10 p-3 main-content">

            <section class="section dashboard">
                <?php if($_SESSION['role_id']==2){ ?>
                <a type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">add
                    hotel</a>

                <?php } ?>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">add hotel</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-body">
                                    <form action="../logique/addhotel.php" method="post" >
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name:</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="contactNumber" class="form-label">Contact Number:</label>
                                            <input type="tel" class="form-control" id="contactNumber"
                                                name="contactNumber" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="amenities" class="form-label">Amenities:</label>
                                            <input type="text" class="form-control" id="amenities" name="amenities"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pays" class="form-label">Pays:</label>
                                            <input type="text" class="form-control" id="pays" name="pays" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ville" class="form-label">Ville:</label>
                                            <input type="text" class="form-control" id="ville" name="ville" required>
                                        </div>
                                        <button type="submit" name="inserthotel" class="btn btn-primary">add hotel</button>
                                    </form>
                                </div>

                            </div>
                           
                        </div>
                    </div>
                </div>
                <table class="table align-middle mb-0 bg-white shadow ">

                    <thead class="bg-light">
                        <tr>
                            <th>name</th>
                            <th>location</th>
                            <th>phone</th>
                            <th>amenties</th>
                            <?php if($_SESSION['role_id']==1 && $_SESSION['role_id']==2){ ?>
                            <th>action</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $id=$_SESSION['user_id'];
                        $sql = "SELECT * FROM hotel NATURAL JOIN localisation where hotel.user_id = $id";
                        $result = mysqli_query($conn, $sql);   
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>

                            <td>
                                <p class=""><?=$row['name']?></p>
                            </td>
                            <td>
                                <span class=""><?=$row['pays']?> <?=$row['ville']?></span>
                            </td>
                            <td>
                                <span class=""> <?=$row['contact_number']?></span>
                            </td>
                            <td>
                                <span class=""> <?=$row['amenities']?></span>
                            </td>
                            <td class="d-flex gap-3">

                            <form action="../logique/deletehotel.php" method="GET" >
                                <input type="hidden" name="deletehotel" value="<?=$row['hotel_id']?>">
                                <input type="hidden" name="deletelocation" value="<?=$row['location_id']?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                               
                                <a type="button"  class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$row['hotel_id']?>">update</a>

                            </td>
                            
                            <div class="modal fade" id="exampleModal<?=$row['hotel_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">update hotel</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="modal-body">
                                    <form action="../logique/updatehotel.php" method="post" >
                                    <input type="hidden" class="form-control" value="<?=$row['hotel_id']?>" id="name" name="id_hotel" required>
                                    <input type="hidden" class="form-control" value="<?=$row['location_id']?>" id="name" name="id_location" required>

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name:</label>
                                            <input type="text" class="form-control" value="<?=$row['name']?>" id="name" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="contactNumber" class="form-label">Contact Number:</label>
                                            <input type="tel" class="form-control" id="contactNumber" value="<?=$row['contact_number']?>"
                                                name="contactNumber" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="amenities" class="form-label">Amenities:</label>
                                            <input type="text" class="form-control" id="amenities" name="amenities"
                                               value="<?=$row['amenities']?>"  required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pays" class="form-label">Pays:</label>
                                            <input type="text" class="form-control" id="pays" value="<?=$row['pays']?>"
                                             name="pays" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ville" class="form-label">Ville:</label>
                                            <input type="text" class="form-control" id="ville" value="<?=$row['ville']?>"
                                             name="ville" required>
                                        </div>
                                        <button type="submit" name="updatehotel" class="btn btn-primary">update hotel</button>
                                    </form>
                                </div>

                            </div>
                           
                        </div>
                    </div>
                </div>
                        </tr> 
                      
                        
                        <?php }}?>
                        </tbody>
                      <?php  if($_SESSION['role_id']==1){ ?>
                        <tbody>
                        <?php 
                        $id=$_SESSION['user_id'];
                        $sql = "SELECT * FROM hotel NATURAL JOIN localisation ";
                        $result = mysqli_query($conn, $sql);   
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>

                            <td>
                                <p class=""><?=$row['name']?></p>
                            </td>
                            <td>
                                <span class=""><?=$row['pays']?> <?=$row['ville']?></span>
                            </td>
                            <td>
                                <span class=""> <?=$row['contact_number']?></span>
                            </td>
                            <td>
                                <span class=""> <?=$row['amenities']?></span>
                            </td>
                           
                            </td>
                        </tr> <?php }}?>

                      <?php  }?>

                    </tbody>
                    <?php  if($_SESSION['role_id']==4){ ?>
                        <tbody>
                        <?php 
                        $id=$_SESSION['user_id'];
                        $sql = "SELECT * FROM hotel NATURAL JOIN localisation  where hotel.responsable_id = $id";
                        $result = mysqli_query($conn, $sql);   
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>

                            <td>
                                <p class=""><?=$row['name']?></p>
                            </td>
                            <td>
                                <span class=""><?=$row['pays']?> <?=$row['ville']?></span>
                            </td>
                            <td>
                                <span class=""> <?=$row['contact_number']?></span>
                            </td>
                            <td>
                                <span class=""> <?=$row['amenities']?></span>
                            </td>
                           
                        </tr> <?php }}?>

                      <?php  }?>
                </table>

            </section>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>