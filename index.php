<?php
$pageTitle = 'Home';
include('header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['LoginBtn'])) {
    // Get the email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    header("Location: dashboard.php");
    exit();
}
?>

<!--Login Form-->

<div class="bg-light py-3 py-md-5">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
                <div class="bg-white p-4 p-md-5 rounded shadow-sm">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-5">
                                <h3>Log in</h3>
                            </div>
                        </div>
                    </div>
                    <form action="" method="post">
                        <div class="row gy-3 gy-md-4 mb-5 overflow-hidden">
                            <div class="col-12">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Enter email" required>
                            </div>
                            <div class="col-12 mb-5">
                                <label for="password" class="form-label">Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password" value=""
                                    placeholder="Password" required>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn btn-lg btn-primary" type="submit" name="LoginBtn">Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>