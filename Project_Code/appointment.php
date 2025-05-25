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
?>
<?php
if (isset($_GET['doctor_id'])) {
    $doctor_id = $_GET['doctor_id'];
    // Use $doctor_id for further logic (e.g., pre-fill doctor details or store it in the database)
} else {
    // Handle the case where doctor_id is not provided
    echo "Invalid request. No doctor selected.";
}
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
    <h2 class="text-center mb-4">Patient Information Form</h2>
    <form action="tasks.php" method="POST" class="p-4 border rounded shadow-lg">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="patientName" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter patient name" required>
            </div>
            <div class="col-md-6">
                <label for="patientAge" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" placeholder="Enter patient age" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="bloodGroup" class="form-label">Blood Group</label>
                <select class="form-select" id="blood" name="blood" required>
                    <option selected disabled>Select Blood Group</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="Address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter patient address" required>
            </div>
            <div class="col-md-6">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date"  required>
            </div>
            <div class="col-md-6">
                <input type="hidden" class="form-control" readonly id="doctor_id" name="doctor_id" value="<?php echo $doctor_id;?>" required>
            </div>
        <div class="text-center">
            <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $user_id; ?>" >
            <input type="hidden" name="action" id="action" value="appoint">
            <button type="submit" class="btn btn-success btn-lg rounded-pill shadow"><a href="payment.php"></a>
                Submit
            </button>

            <p class="text-center">
                <?php
                $status = isset($_GET['status']) ? $_GET['status'] : '';
                switch ($status) {
                    case '1':
                        echo '<span class="text-danger">An error occurred. Please try again.</span>';
                        break;
                    case '2':
                        echo '<span class="text-warning">All fields are required!</span>';
                        break;
                    case '3':
                        echo '<span class="text-success">Appointment successful!</span>';
                        break;
                    default:
                        echo '';
                }
                ?>
            </p>

        </div>
    </form>
</div>

</body>
</html>