<?php
session_start();
if (!isset($_SESSION['email'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: index.php");
    exit();
}

// Initialize an array to store student data
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

// Initialize variables
$studentId = $firstName = $lastName = '';
$errors = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentId = trim($_POST['student_id']);
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);

    // Validate inputs
    if (empty($studentId)) {
        $errors[] = "Student ID is required."; // Error for empty Student ID
    }
    if (empty($firstName)) {
        $errors[] = "First Name is required."; // Error for empty First Name
    }
    if (empty($lastName)) {
        $errors[] = "Last Name is required."; // Error for empty Last Name
    }

    // Check for duplicate Student ID
    if (array_search($studentId, array_column($_SESSION['students'], 'studentId')) !== false) {
        $errors[] = "Student ID already exists. Please use a different ID."; // Error for duplicate Student ID
    }

    // If there are no errors, process the registration
    if (empty($errors)) {
        // Check if the student ID already exists for editing
        $existingStudentIndex = array_search($studentId, array_column($_SESSION['students'], 'studentId'));
        if ($existingStudentIndex !== false) {
            // Update existing student
            $_SESSION['students'][$existingStudentIndex]['firstName'] = $firstName;
            $_SESSION['students'][$existingStudentIndex]['lastName'] = $lastName;
        } else {
            // Create new student
            $_SESSION['students'][] = [
                'studentId' => $studentId,
                'firstName' => $firstName,
                'lastName' => $lastName
            ];
        }

        // Reset form fields
        $studentId = $firstName = $lastName = '';
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <form method="post" action="http://midterms.test/dashboard.php">
                    <button type="submit" class="btn btn-link"
                        style="border: none; background: none; padding: 0; text-decoration: underline; cursor: pointer;">Dashboard</button>
                </form>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Register Student</li>
        </ol>
    </nav>
    <h2>Register a New Student</h2>

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
    <div class="card mb-4">
        <div class="card-body">
            <form method="post" action="">
                <div class="mb-3">
                    <label for="studentId" class="form-label">Student ID</label>
                    <input type="text" class="form-control" id="studentId" name="student_id"
                        placeholder="Enter Student ID" value="<?php echo htmlspecialchars($studentId); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="first_name"
                        placeholder="Enter First Name" value="<?php echo htmlspecialchars($firstName); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Enter Last Name"
                        value="<?php echo htmlspecialchars($lastName); ?>" required>
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
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($_SESSION['students'])): ?>
                <?php foreach ($_SESSION['students'] as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['studentId']); ?></td>
                        <td><?php echo htmlspecialchars($student['firstName']); ?></td>
                        <td><?php echo htmlspecialchars($student['lastName']); ?></td>
                        <td>
                            <!-- Edit Button -->
                            <form method="post" action="edit.php" style="display:inline;">
                                <input type="hidden" name="student_id"
                                    value="<?php echo htmlspecialchars($student['studentId']); ?>">
                                <button type="submit" style="background-color: #05ADADFF; color: white; border: none;"
                                    class="btn btn-sm">Edit</button>
                            </form>
                            <!-- Delete Button -->
                            <form method="post" action="delete.php" style="display:inline;">
                                <input type="hidden" name="student_id"
                                    value="<?php echo htmlspecialchars($student['studentId']); ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <!-- Attach Button -->
                            <form method="" action="" style="display:inline;">
                                <button type="submit" style="background-color: #E6E326FF; color: black; border: none;"
                                    class="btn btn-sm">Attach Subject</button>
                            </form>
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