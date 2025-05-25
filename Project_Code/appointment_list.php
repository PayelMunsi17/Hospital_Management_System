<?php
session_start();
require_once "config.php";

// Check if user is logged in
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
if (!$user_id) {
    header('Location: login_page.php');
    exit();
}

// Connect to the database
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch appointment details with doctor and payment info
$query = "
    SELECT 
        pd.name AS patient_name, 
        pd.blood_grp AS blood_group, 
        pd.address, 
        pd.age, 
        pd.appointment_date, 
        d.name AS doctor_name, 
        d.specialist, 
        d.charge,
        d.available,
        pay.mobile_num,
        pay.amount
    FROM 
        patient_details pd
    JOIN 
        doctors d ON pd.doctor_id = d.id
    LEFT JOIN 
        payment_details pay ON pd.user_id = $user_id
    WHERE 
        pd.user_id = $user_id
";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Appointments</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
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
    <h2 class="text-center mb-4">Your Appointments</h2>
    <div class="row" id="appointment-list">
        <?php while ($appointment = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title text-center text-primary">Patient Details</h5>
                        <p class="card-text">
                            <strong>Patient Name:</strong> <?php echo htmlspecialchars($appointment['patient_name']); ?><br>
                            <strong>Blood Group:</strong> <?php echo htmlspecialchars($appointment['blood_group']); ?><br>
                            <strong>Age:</strong> <?php echo htmlspecialchars($appointment['age']); ?><br>
                            <strong>Address:</strong> <?php echo htmlspecialchars($appointment['address']); ?><br>
                            <strong>Appointment Date:</strong> <?php echo htmlspecialchars($appointment['appointment_date']); ?><br>
                        </p>
                        <hr>
                        <h5 class="card-title text-center text-primary">Doctor Information</h5>
                        <p class="card-text">
                            <strong>Name:</strong> <?php echo htmlspecialchars($appointment['doctor_name']); ?><br>
                            <strong>Specialist:</strong> <?php echo htmlspecialchars($appointment['specialist']); ?><br>
                            <strong>Charge:</strong> <?php echo htmlspecialchars($appointment['charge']); ?> BDT<br>
                            <strong>Time:</strong> <?php echo htmlspecialchars($appointment['available']); ?><br>
                        </p>
                        <?php if (!empty($appointment['mobile_num'])) { ?>
                            <hr>
                            <h5 class="card-title text-center text-success">Payment Information</h5>
                            <p class="card-text">
                                <strong>Mobile Number:</strong> <?php echo htmlspecialchars($appointment['mobile_num']); ?><br>
                                <strong>Amount Paid:</strong> <?php echo htmlspecialchars($appointment['amount']); ?> BDT<br>
                            </p>
                        <?php } else { ?>
                            <p class="text-danger"><em>No payment details found.</em></p>
                            <div class="d-flex justify-content-center mt-3">
                            <a href="payment.php">
                                <button class="btn btn-primary btn-lg rounded-pill shadow d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-calendar-check"></i> Pay First
                                </button>
                            </a>
                        </div>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</body>
</html>




