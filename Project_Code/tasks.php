<?php
session_start();
require_once "config.php";
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Check connection
if (!$connection) {
    throw new \mysql_xdevapi\Exception("Cant connect to database");
}

$action = isset($_POST['action']) ? $_POST['action'] : '';

if('register' == $action) {

$email = $_POST['email'];
$password = $_POST['password'];
try {
    if ($email && $password) {
        $hash_pass = password_hash($password, PASSWORD_BCRYPT);
        // Fix the query syntax and use backticks around table and column names
        $query = "INSERT INTO `users` (`Email`, `Password`) VALUES ('{$email}', '{$hash_pass}')";
        mysqli_query($connection, $query);
        if (mysqli_error($connection)) {
            $status = 1; // Database error
        } else {
            $status = 3;
        }
    } else {
        $status = 2;
    }
} catch (Exception $e) {
    $status = 1;
    header('Location: login_page.php?status=' . $status);
}
header('Location: login_page.php?status=' . $status);

}

elseif ('login' == $action) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    try {
        if ($email && $password) {
            $query = "SELECT Id, Password FROM users WHERE Email = '{$email}'";
            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result);
                $_email = $data['Email'];
                $_password = $data['Password'];
                $_id = $data['Id'];
                if (password_verify($password, $_password)) {
                    $_SESSION['id'] = $_id;
                    $_SESSION['name'] = $email;
                    header('Location:home.php?');
                    exit();
                } else {
                    $status = 4;
                }
            } else {
                $status = 5;
            }
        } else {
            // Invalid email or password
            $status = 2;
        }

    } catch (Exception $e) {
        $status = 1; // Database error
        header('Location: login_page.php?status=' . $status);
    }
    header('Location: login_page.php?status=' . $status);
}
elseif ('appoint' == $action) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $blood_grp = $_POST['blood'];  // Ensure this matches your form field name
    $address = $_POST['address'];
    $user = $_POST['user_id'];
    $date = $_POST['date'];
    $doctor = $_POST['doctor_id'];

    try {
        if ($name && $age && $blood_grp && $address) {
            // Prepare the SQL query to insert patient details
            $query = "INSERT INTO `patient_details` (`name`, `age`, `blood_grp`, `address`,`user_id`,`appointment_date`,`doctor_id`) 
                      VALUES ('{$name}', '{$age}', '{$blood_grp}', '{$address}','{$user}','{$date}','{$doctor}')";
            $result = mysqli_query($connection, $query);

            if ($result) {
                $status = 3;  // Success
                header('Location: payment.php?status=' . $status);
                exit();
            } else {
                $status = 1;  // Query error
                throw new Exception(mysqli_error($connection));
            }
        } else {
            $status = 2;  // Missing required fields
            header('Location: appointment.php?status=' . $status);
        }
    } catch (Exception $e) {
        $status = 1;  // Database or query error
        header('Location: appointment.php?status=' . $status);
    }

    // Redirect to the appointment page with status
    header('Location: appointment.php?status=' . $status);
}
elseif ('payment' == $action) {
    $mobile_num = $_POST['mobile_num'];
    $amount = $_POST['amount'];  // Ensure this matches your form field name

    try {
        if ($mobile_num && $amount) {
            // Prepare the SQL query to insert patient details
            $query = "INSERT INTO `payment_details` (`mobile_num`, `amount`) 
                      VALUES ('{$mobile_num}', '{$amount}')";
            $result = mysqli_query($connection, $query);

            if ($result) {
                $status = 3;  // Success
                header('Location: payment_details.php?status=' . $status);
                exit();
            } else {
                $status = 1;  // Query error
                throw new Exception(mysqli_error($connection));
            }
        } else {
            $status = 2;  // Missing required fields
            header('Location: payment.php?status=' . $status);
        }
    } catch (Exception $e) {
        $status = 1;  // Database or query error
        header('Location: payment.php?status=' . $status);
    }

    // Redirect to the payment page with status
    header('Location: payment.php?status=' . $status);
}


