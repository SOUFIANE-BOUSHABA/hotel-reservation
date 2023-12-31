<?php  include 'cnxDB.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Home Page</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
#filter {

    padding: 20px;
    height: 100vh;
}

#roomList {
    padding: 20px;
}

.carousel-control-prev:hover,
.carousel-control-next:hover {
    background-color: gray;
    opacity: .4;
}
</style>

<body>


    <header class=""
        style="height: 70px; z-index:100; position: sticky; top: 0; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="height: 70px;">
            <div class="container">
                <a class="navbar-brand" href="#">YourBooking</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="romms.php">Rooms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>

                    <div class="d-flex gap-3">
                        <div class="navbar-nav ml-auto">
                            <?php if (isset($_SESSION['role_id'] ) && $_SESSION['role_id']==3 ) {?>
                            <div class="dropdown">
                                <button class="btn btn-dark dropdown-toggle" type="button" id="userDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $_SESSION['name'] ?>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li><a class="dropdown-item" href="reservation.php">Reservation</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="logique/logout.php">Logout</a></li>
                                </ul>
                            </div>
                            <?php } else {?>
                            <button class="btn btn-dark" type="button"><a href="login.php">Login</a></button>
                            <?php }?>
                        </div>

                    </div>
                </div>
        </nav>
    </header>