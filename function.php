<?php
session_start();

// User Authentication

// Returns a hardcoded array of 5 users, each with an email and password
function getUsers() {
    return [
        ['email' => 'user1@example.com', 'password' => 'password1'],
        ['email' => 'user2@example.com', 'password' => 'password2'],
        ['email' => 'user3@example.com', 'password' => 'password3'],
        ['email' => 'user4@example.com', 'password' => 'password4'],
        ['email' => 'user5@example.com', 'password' => 'password5']
    ];
}

// Validates login credentials by checking if the provided email and password are valid
function validateLoginCredentials($email, $password) {
    $errors = [];
    
    if (empty($email)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }
    
    if (empty($password)) {
        $errors[] = 'Password is required.';
    }
    
    return $errors;
}

// Checks if a given email and password match any user in the provided list of users
function checkLoginCredentials($email, $password, $users) {
    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            return true;
        }
    }
    return false;
}

// Checks if a user's session is active by verifying the existence of an email address in the session
function checkUserSessionIsActive() {
    if (isset($_SESSION['email']) && isset($_SESSION['current_page'])) {
        header("Location: " . $_SESSION['current_page']);
        exit();
    }
}

// Session Management

// Checks if a user is logged in by verifying the existence and non-emptiness of the email key in the $_SESSION superglobal array
function guard() {
    if (empty($_SESSION['email'])) {
        header('Location: index.php');
        exit();
    }
}

// Error Handling

// Takes an array of error messages ($errors) and returns a formatted HTML string displaying the errors
function displayErrors($errors) {
    if (empty($errors)) {
        return '';
    }

    $errorHtml = '<div class="alert alert-danger"><strong>System Errors:</strong><ul>';
    foreach ($errors as $error) {
        $errorHtml .= '<li>' . htmlspecialchars($error) . '</li>';
    }
    $errorHtml .= '</ul></div>';
    
    return $errorHtml;
}

// Takes an error message as input and returns a formatted HTML alert box containing the error message
function renderErrorsToView($error) {
    if (empty($error)) {
        return null;
    }
    
    return '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . 
            htmlspecialchars($error) . 
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}

// Student Management (for future implementation)

// Validates student data before adding to the system
function validateStudentData($student_data) {
    // Validate student data (e.g., name, age, etc.)
    // Return an array of errors if validation fails
    return [];
}

// Checks if student data already exists
function checkDuplicateStudentData($student_data) {
    // Compare with existing student data to check for duplicates
    return false; // Return true if duplicate found, false otherwise
}

// Get the index of the selected student
function getSelectedStudentIndex($student_id) {
    // Return the index of the student in the list
    return 0;
}

// Get the data of the selected student by index
function getSelectedStudentData($index) {
    // Retrieve student data by index
    return [];
}

?>
