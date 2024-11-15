<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
            <p>Are you sure you want to delete the following student record?</p>
            <ul>
                <li><strong>Student ID:</strong> </li>
                <li><strong>First Name:</strong> </li>
                <li><strong>Last Name:</strong> </li>
            </ul>
            <!-- Action Buttons -->
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-secondary">Cancel</button>
                <button type="button" class="btn btn-primary">Delete Student Record</button>
            </div>
        </div>
    </div>
</div>