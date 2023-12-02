
<?php
include 'header.php';

$hotelCountQuery = "SELECT COUNT(*) AS hotelCount FROM hotel";
$roomCountQuery = "SELECT COUNT(*) AS roomCount FROM room_details";

$hotelResult = mysqli_query($conn, $hotelCountQuery);
$roomResult = mysqli_query($conn, $roomCountQuery);

$hotelData = 0;
$roomData = 0;

if ($hotelResult && $row = mysqli_fetch_assoc($hotelResult)) {
    $hotelData = $row['hotelCount'];
}

if ($roomResult && $row = mysqli_fetch_assoc($roomResult)) {
    $roomData = $row['roomCount'];
}
?>
    <div class="container-fluid">
        <div class="row">
           <?php include 'aside.php' ?>

            <main class="col-md-10 p-3 main-content">
                <div class="row d-flex">
                   <div class="col-md-5"><canvas id="hotelChart" width="1000" height="400"></canvas></div>  
                   <div class="col-md-5"><canvas id="roomChart" width="1000" height="400"></canvas></div>  
                </div>
            </main>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const hotelData = <?php echo $hotelData; ?>;
        const roomData = <?php echo $roomData; ?>;

        const hotelCanvas = document.getElementById('hotelChart').getContext('2d');
        const hotelChart = new Chart(hotelCanvas, {
            type: 'bar',
            data: {
                labels: ['Hotels'],
                datasets: [{
                    label: 'Number of Hotels',
                    data: [hotelData],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const roomCanvas = document.getElementById('roomChart').getContext('2d');
        const roomChart = new Chart(roomCanvas, {
            type: 'bar',
            data: {
                labels: ['Rooms'],
                datasets: [{
                    label: 'Number of Rooms',
                    data: [roomData],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
