<?php
session_start();
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0 ;
if(!$user_id){
    header('Location:login_page.php');
}?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

    <style>
        body {
            overflow-x: hidden;
        }

        .navbar {
            height: 60px;
            margin-left: 250px; /* Space for the sidebar */
        }

        .side-nav {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            padding-top: 20px;
        }

        .side-bar-item {
            color: white;
            text-decoration: none;
            padding: 15px;
            display: block;
            transition: background-color 0.2s;
        }

        .side-bar-item:hover {
            background-color: #804285;
        }

        .side-bar-item i {
            margin-right: 10px;
        }

        .container-fluid {
            padding-left: 260px; /* Adjust padding to account for sidebar */
        }

        .user-dropdown {
            position: relative;
        }

        .user-dropdown-content {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 200px;
        }

        .user-dropdown:hover .user-dropdown-content {
            display: block;
        }

        .user-dropdown-divider {
            margin: 10px 0;
        }
    </style>
</head>

<body>

<div class="side-nav">
    <a href="home.php" class="side-bar-item">
        <i class="fas fa-chart-line"></i> Dashboard
    </a>

    <!-- Appointment Dropdown -->
    <button class="side-bar-item d-flex align-items-center justify-content-between w-100"
            type="button" data-bs-toggle="collapse"
            data-bs-target="#appointmentOptions" aria-expanded="false"
            style="background-color: #343a40; color: white; border: none;">
        <span><i class="fas fa-calendar-check me-2"></i> Appointment</span>
        <i class="fas fa-chevron-down"></i>
    </button>

    <div id="appointmentOptions" class="collapse ps-4 mt-2">
        <a href="Orthopedic.php" class="side-bar-item">
            <i class="fas fa-bone"></i> Orthopedic
        </a>
        <a href="neurologist.php" class="side-bar-item">
            <i class="fas fa-brain"></i> Neuro Specialist
        </a>
        <a href="kidney_specialist.php" class="side-bar-item">
            <i class="fas fa-kidneys"></i> Kidney Specialist
        </a>
    </div>

    <a href="appointment_list.php" class="side-bar-item">
        <i class="fas fa-list-alt"></i> Appointment List
    </a>

    <a href="payment_details.php" class="side-bar-item">
        <i class="fas fa-list-alt"></i> Payment Details
    </a>

    <a href="logout.php" class="side-bar-item">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</div>




<!-- Main Content -->
<div class="container-fluid mt-4">
    <h1>Project Name : Hospital Management System</h1><br>
    <h5>Md Maruf Hossain Anon
        ID : 41220300429</h5><br>

       <h5>Md Himel khan
        ID : 41220300418</h5><br>

    <h5>  Al Hasib Riad
        ID : 41220300512</h5><br>

    <h5>  Payel Munsi
        ID : 41220300526</h5><br>
</div>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>



