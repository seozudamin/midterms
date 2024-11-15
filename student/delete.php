<?php
session_start();

// Initialize variables
$studentId = '';
$firstName = '';
$lastName = '';
$errors = [];

// Check if a student ID is provided for deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['student_id'])) {
    $studentId = trim($_POST['student_id']);

    // Find the existing student data in the session
    $existingStudentIndex = array_search($studentId, array_column($_SESSION['students'], 'studentId'));
    if ($existingStudentIndex !== false) {
        // Retrieve student details
        $firstName = htmlspecialchars($_SESSION['students'][$existingStudentIndex]['firstName']);
        $lastName = htmlspecialchars($_SESSION['students'][$existingStudentIndex]['lastName']);
    } else {
        $errors[] = "Student not found.";
    }
}

// Handle the actual deletion if confirmed
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete']) && isset($_POST['student_id'])) {
    $studentId = trim($_POST['student_id']);

    // Find the existing student data in the session
    $existingStudentIndex = array_search($studentId, array_column($_SESSION['students'], 'studentId'));
    if ($existingStudentIndex !== false) {
        // Remove the student from the session array
        unset($_SESSION['students'][$existingStudentIndex]);

        // Re-index the array to maintain numerical keys
        $_SESSION['students'] = array_values($_SESSION['students']);

        // Redirect back to the registration page or student list
        header('Location: register.php');
        exit;
    } else {
        $errors[] = "Student not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Delete Student</title>
</head>

<body>
    <div class="container mt-5">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Register Student</a></li>
                <li class="breadcrumb-item active" aria-current="page">Delete Student</li>
            </ol>
        </nav>

        <!-- Delete Confirmation Card -->
        <div class="card">
            <div class="card-header">
                <h4>Delete a Student</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>Are you sure you want to delete the following student record?</p>
                    <ul>
                        <li><strong>Student ID:</strong> <?php echo $studentId; ?></li>
                        <li><strong>First Name:</strong> <?php echo $firstName; ?></li>
                        <li><strong>Last Name:</strong> <?php echo $lastName; ?></li>
                    </ul>
                    <!-- Action Buttons -->
                    <form method="POST">
                        <input type="hidden" name="student_id" value="<?php echo $studentId; ?>">
                        <div class="d-flex gap-2">
                            <a href="register.php" class="btn btn-secondary">Cancel</a>
                            <button type="submit" name="confirm_delete" class="btn btn-primary">Delete Student
                                Record</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>