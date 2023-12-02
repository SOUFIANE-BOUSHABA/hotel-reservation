<?php include 'header.php'; 
$client_id=$_SESSION['user_id'];
?>

<section>
    <div class="container mt-5">
        <h2 class="text-center mb-4"> Hotels</h2>
        <div class="row">
                      <?php 
                        $id=$_SESSION['user_id'];
                        $sql = "SELECT * FROM hotel NATURAL JOIN localisation ";
                        $result = mysqli_query($conn, $sql);   
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/rom1.jpg" class="card-img-top img-fluid" alt="Room 1">
                    <div class="card-body">
                        <h5 class="card-title"><?=$row['name']?></h5>
                        <p class="card-text"><?=$row['pays']?> <?=$row['ville']?></p>
                        <p class="card-text"> <?=$row['contact_number']?></p>
                        <a href="#" class="btn btn-primary">devené responsable</a>
                    </div>
                </div>
            </div>
            <?php }}?>
           
           
          
        </div>
    </div>

</section>
    <footer class="bg-light text-center p-3">
        <p>&copy; 2023 Hotel Youbooking. All Rights Reserved.</p>
    </footer>

   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
