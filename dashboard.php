<?php
$pageTitle = 'Home';
include('header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['LogoutBtn'])) {
        // Redirect to index.php on logout
        header("Location: index.php");
        exit();
    }
    header("Location: index.php");
    exit();
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<div class="container mt-5">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center">
        <h3>Welcome to the System: </h3>
        <form method="POST">
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
                    <button class="btn btn-primary">Register</button>
                </div>
            </div>
        </div>
    </div>
</div>