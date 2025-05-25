<?php
include_once "config.php";
//Sanitizing User Inout Is Needed Because if we accept all input some bad user may harm us using javascript
header('X-XSS-Protection:0'); // SECURITY ALERT: ANYONE cANT ACCESS MY COOKIE USING JAVASCRIPT
// IF WE WANT TO DO GET & PUT AT A TIMR THEN WE HAVE TO USE GLOBAL VARIABLE $_REQUEST...
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>

    body {
        background-color: #f5f5f5;
        font-family: 'Arial', sans-serif;
    }
    .container {
        margin-top: 100px;
    }
    .maintitle {
        font-size: 2.5rem;
        color: #343a40;
        margin-bottom: 20px;
    }
    .formaction a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }
    .formaction a:hover {
        color: #0056b3;
    }
    .formc {
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    .form-control {
        margin-bottom: 15px;
    }
    .button-primary {
        background-color: #007bff;
        color: white;
        border: none;
        width: 100%;
        padding: 10px;
        cursor: pointer;
    }
    .button-primary:hover {
        background-color: #0056b3;
    }
</style>
    <!-- Custom CSS -->

</head>
<body>
<div class="container" id="main">
    <h1 class="maintitle text-center">
        <i class="fas fa-store"></i><br>Hospital Management System
    </h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="formaction text-center mb-3">
                <a href="#" id="login">Login</a> ||
                <a href="#" id="register">Register</a>
            </div>
            <div class="formc">
                <form method="POST" id="form01" action="tasks.php">
                    <h3 class="text-center">Login</h3>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                    </div>

                    <p class="text-center">
                        <?php
                        $status = isset($_GET['status']) ? $_GET['status'] : '';
                        switch ($status) {
                            case '1':
                                echo '<span class="text-danger">Database connection failed. Please try again.</span>';
                                break;
                            case '2':
                                echo '<span class="text-danger">Invalid email or password. Please try again.</span>';
                                break;
                            case '3':
                                echo '<span class="text-success">Registration successful! Please log in.</span>';
                                break;
                            case '4':
                                echo '<span class="text-danger">Incorrect password. Please try again.</span>';
                                break;
                            case '5':
                                echo '<span class="text-danger">User not found. Please register first.</span>';
                                break;
                            default:
                                echo '';
                        }
                        ?>
                    </p>
                    <input type="hidden" name="action" id="action" value="login">
                    <button type="submit" class="button-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    (function ($) {
        $(document).ready(function () {
            $("#login").on('click', function () {
                $("#form01 h3").html("Login");
                $("#action").val("login");
            });

            $("#register").on('click', function () {
                $("#form01 h3").html("Register");
                $("#action").val("register");
            });
        });
    })(jQuery);
</script>
</body>
</html>


