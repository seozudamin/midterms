<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['LogoutBtn'])) {
        header("Location: index.php");
        exit();
    } elseif (isset($_POST['action']) && $_POST['action'] === 'go_to_dashboard') {
        header("Location: /dashboard.php");
        exit();
    } elseif (isset($_POST['action']) && $_POST['action'] === 'register') {
        header("Location: /student/register.php");
        exit();
    }
    header("Location: index.php");
    exit();
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item">
    <form method="post" action="">
        <input type="hidden" name="action" value="go_to_dashboard">
        <button type="submit" class="btn btn-link" style="border: none; background: none; padding: 0; text-decoration: underline; cursor: pointer;">Dashboard</button>
    </form>
</li><li class="breadcrumb-item active" aria-current="page">Register Student</li>
        </ol>
    </nav>

    <!-- Form for Registering New Student -->
    <h2>Register a New Student</h2>
    <div class="card mb-4">
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="studentId" class="form-label">Student ID</label>
                    <input type="text" class="form-control" id="studentId" placeholder="Enter Student ID">
                </div>
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" placeholder="Enter First Name">
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" placeholder="Enter Last Name">
                </div>
                <button type="submit" class="btn btn-primary">Add Student</button>
            </form>
        </div>
    </div>

    <!-- Student List Table -->
    <h3>Student List</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Student ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Option</th>
            </tr>
        </thead>
        <tbody id="studentList">
            <!-- Rows will be dynamically added here -->
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>