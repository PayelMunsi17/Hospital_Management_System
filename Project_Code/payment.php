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
    <h2 class="text-center mb-4">Bkash Payment</h2>
    <form action="tasks.php" method="POST" class="p-4 border rounded shadow-lg">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="patient_num" class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="mobile_num" name="mobile_num" placeholder="Enter Your Mobile No" required>
            </div>
            <div class="col-md-6">
                <label for="patient_amount" class="form-label">Amount</label>
                <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Your Amount" required>
            </div>
            <div class="col-md-6">
                <label for="patient_pin" class="form-label">Enter the Pin</label>
                <input type="text" class="form-control" id="pin" name="pin" placeholder="Enter Pin" required>
            </div>
        <div class="text-center">
            <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $user_id; ?>" >
            <input type="hidden" name="action" id="action" value="payment">
            <button  type="submit" class="btn btn-success btn-lg rounded-pill shadow"><a href="appointment_list.php"></a>
                Payment
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