<?php
include "Handler/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $credit = $_POST["credit"];

    $sql = "INSERT INTO users (full_name, email, credit) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $full_name, $email, $credit);

    if ($stmt->execute()) {
        $message = "User added successfully!";
        $message_type = "success";
    } else {
        $message = "Error: " . $stmt->error;
        $message_type = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New User</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="bi bi-cash-coin"></i>&nbsp;MONEY</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">

        <h2 class="mb-4">Give me money</h2>

        <!-- Display success/error message -->
        <?php if (isset($message)): ?>
            <div class="alert alert-<?= $message_type ?>"><?= $message ?></div>
        <?php endif; ?>

        <!-- Add User Form -->
        <form method="POST">
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" id="full_name" class="form-control" name="full_name" placeholder="Enter full name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" name="email" placeholder="Enter email" required>
            </div>

            <div class="mb-3">
                <label for="credit" class="form-label">Credit</label>
                <input type="number" id="credit" class="form-control" name="credit" placeholder="Enter credit amount" required>
            </div>

            <button type="submit" class="btn btn-primary"><i class="bi bi-person-add"></i>&nbsp; Add User</button>
        </form>

        <!-- Back Link -->  
        <a href="index.php" class="btn btn-secondary mt-3"><i class="bi bi-house-heart"></i>&nbsp;Back Home</a>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
