<?php
// Start session to store student data
session_start();

// Initialize an empty array to hold error messages
$errors = [];

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if the user wants to logout
    if (isset($_POST['LogoutBtn'])) {
        header("Location: index.php");
        exit();
    }
    // Check if the user wants to go to the dashboard
    elseif (isset($_POST['action']) && $_POST['action'] === 'go_to_dashboard') {
        header("Location: /dashboard.php");
        exit();
    }
    // Handle registration process
    elseif (isset($_POST['action']) && $_POST['action'] === 'register') {
        // Gather form data
        $student_data = [
            'student_id' => $_POST['student_id'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name']
        ];

        // Validate student data
        $errors = validateStudentData($student_data);

        // Check for duplicate student ID
        if (empty($errors)) {
            $errors = checkDuplicateStudentData($student_data);
        }

        // If no errors, store the student data in session
        if (empty($errors)) {
            $_SESSION['student_data'][] = $student_data; // Add student data to session
            header("Location: register.php"); // Redirect to the same page to avoid resubmission
            exit();
        }
    }
}

// Function to validate student data
function validateStudentData($student_data) {
    $errors = [];
    
    if (empty($student_data['student_id'])) {
        $errors[] = 'Student ID is required.';
    }
    if (empty($student_data['first_name'])) {
        $errors[] = 'First Name is required.';
    }
    if (empty($student_data['last_name'])) {
        $errors[] = 'Last Name is required.';
    }
    
    return $errors;
}

// Function to check if the student ID already exists
function checkDuplicateStudentData($student_data) {
    $errors = [];
    if (isset($_SESSION['student_data'])) {
        foreach ($_SESSION['student_data'] as $existing_student) {
            if ($existing_student['student_id'] === $student_data['student_id']) {
                $errors[] = 'A student with this ID already exists.';
                break;
            }
        }
    }
    return $errors;
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
            </li>
            <li class="breadcrumb-item active" aria-current="page">Register Student</li>
        </ol>
    </nav>

    <!-- Display Errors -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Form for Registering New Student -->
    <h2>Register a New Student</h2>
    <div class="card mb-4">
        <div class="card-body">
            <form method="post" action="">
                <input type="hidden" name="action" value="register">
                
                <div class="mb-3">
                    <label for="studentId" class="form-label">Student ID</label>
                    <input type="text" class="form-control" id="studentId" name="student_id" placeholder="Enter Student ID" required>
                </div>
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Enter First Name" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Enter Last Name" required>
                </div>
                <button type="submit" class="btn btn-primary">Register Student</button>
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
            <?php if (isset($_SESSION['student_data']) && count($_SESSION['student_data']) > 0): ?>
                <?php foreach ($_SESSION['student_data'] as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                        <td>
                            <!-- Option to edit or remove student -->
                            <button class="btn btn-sm btn-warning">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No students registered yet.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
