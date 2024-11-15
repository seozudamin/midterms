<?php
session_start();

// Initialize variables
$studentId = $firstName = $lastName = '';
$errors = [];

// Check if a student ID is provided for editing
if (isset($_POST['student_id'])) {
    $studentId = trim($_POST['student_id']);

    // Find the existing student data in the session
    $existingStudentIndex = array_search($studentId, array_column($_SESSION['students'], 'studentId'));
    if ($existingStudentIndex !== false) {
        $firstName = $_SESSION['students'][$existingStudentIndex]['firstName'];
        $lastName = $_SESSION['students'][$existingStudentIndex]['lastName'];
    } else {
        $errors[] = "Student not found.";
    }
}

// Handle form submission for updating the student data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);

    // Validate inputs
    if (empty($firstName)) {
        $errors[] = "First Name is required.";
    }
    if (empty($lastName)) {
        $errors[] = "Last Name is required.";
    }

    // If there are no errors, update the student data
    if (empty($errors)) {
        $_SESSION['students'][$existingStudentIndex]['firstName'] = $firstName;
        $_SESSION['students'][$existingStudentIndex]['lastName'] = $lastName;

        // Redirect back to the registration page or student list
        header('Location: register.php');
        exit;
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <h2>Edit Student</h2>

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

    <!-- Form for Editing Student -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="post" action="">
                <div class="mb-3">
                    <label for="studentId" class="form-label">Student ID</label>
                    <input type="text" class="form-control" id="studentId" name="student_id" 
                        value="<?php echo htmlspecialchars($studentId); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="first_name" 
                        value="<?php echo htmlspecialchars($firstName); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="last_name" 
                        value="<?php echo htmlspecialchars($lastName); ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update Student</button>
            </form>
        </div>
    </div>
</div>