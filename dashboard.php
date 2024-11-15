<?php
session_start(); // Start the session at the beginning
if (!isset($_SESSION['email'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: index.php");
    exit();
}
$pageTitle = 'Home';
include('header.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If Logout button is clicked
    if (isset($_POST['LogoutBtn'])) {
        // Destroy session and clear session variables
        session_unset(); // Clears session variables
        session_destroy(); // Destroys the session

        // Redirect to index.php (login page)
        header("Location: index.php");
        exit();
    }
    // If Register button is clicked, redirect to register.php
    elseif (isset($_POST['action']) && $_POST['action'] === 'register') {
        header("Location: /student/register.php");
        exit();
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<div class="container mt-5">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center">
        <?php
        // Display the user's email if it is set in the session
        if (isset($_SESSION['email'])) {
            $emailaddress = $_SESSION['email'];
            echo "<h3>Welcome to the System: $emailaddress</h3>";
        } else {
            // If no email is set, show a default message
            echo "<h3>Welcome to the System</h3>";
        }
        ?>
        <form method="POST">
            <!-- Logout button -->
            <button type="submit" class="btn btn-danger" name="LogoutBtn">Logout</button>
        </form>
    </div>

    <!-- Content Section -->
    <div class="row mt-4">
        <!-- Add a Subject Card -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Add a Subject</h5>
                </div>
                <div class="card-body">
                    <p>This section allows you to add a new subject in the system. Click the button below to proceed
                        with the adding process.</p>
                    <button class="btn btn-primary">Add Subject</button>
                </div>
            </div>
        </div>

        <!-- Register a Student Card -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Register a Student</h5>
                </div>
                <div class="card-body">
                    <p>This section allows you to register a new student in the system. Click the button below to
                        proceed with the registration process.</p>
                    <form method="POST">
                        <!-- Hidden field to indicate registration action -->
                        <input type="hidden" name="action" value="register">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
