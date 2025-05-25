<?php
session_start();
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0 ;
if(!$user_id){
    header('Location:login_page.php');
}
?>
<?php
require_once "config.php";
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if (!$connection){
    throw new \mysql_xdevapi\Exception("Can't connect to database");
}
$query = "SELECT * FROM `doctors` WHERE `specialist` = 'kidney_specialist'";
$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor List</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">NUB Hospital Management</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center mb-4">Doctor List</h2>
    <div class="row" id="doctor-list">
        <?php while ($doctor = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <!-- Icon and Name -->
                        <i class="fas fa-user-circle fa-5x text-primary shadow-sm mb-3"></i>
                        <h5 class="card-title mb-3"><?php echo $doctor['name']; ?></h5>

                        <!-- Doctor Details -->
                        <p class="card-text">
                            <strong>Specialist:</strong> <?php echo $doctor['specialist']; ?><br>
                            <strong>Availability:</strong> <?php echo $doctor['available']; ?><br>
                            <strong>Charge:</strong> <?php echo $doctor['charge']; ?> BDT
                        </p>

                        <!-- Centered Appoint Button -->
                        <div class="d-flex justify-content-center mt-3">
                            <a href="appointment.php?doctor_id=<?php echo $doctor['id']; ?>">
                                <button class="btn btn-primary btn-lg rounded-pill shadow d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-calendar-check"></i> Appoint
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        <?php } ?>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
