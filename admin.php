<?php
include "Handler/connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scamming</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="bi bi-cash-coin"></i>&nbsp; MONEY</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card text-center p-4 shadow-lg" style="max-width: 400px; width: 100%;">
            <h1 class="mb-4">Give me your Credit Card</h1>
            <a href="create.php" class="btn btn-primary mb-2"><i class="bi bi-person-add"></i>&nbsp; Add New User</a>
            <a href="read.php" class="btn btn-success"><i class="bi bi-person-badge"></i>&nbsp; View Users</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
