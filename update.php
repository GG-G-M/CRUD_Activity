<?php
include "Handler/connect.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("Invalid User ID");
}

$id = $_GET["id"];

// Fetch the user details from the database
$sql = "SELECT * FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found");
}

// Update user details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $credit = $_POST["credit"];
    $credit_card = $_POST["credit_card"];

    // Only update the password if the field is not empty
    if (!empty($_POST["password"])) {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash new password
        $update_sql = "UPDATE users SET full_name=?, email=?, credit=?, credit_card=?, password=? WHERE id=?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sssssi", $full_name, $email, $credit, $credit_card, $password, $id);
    } else {
        $update_sql = "UPDATE users SET full_name=?, email=?, credit=?, credit_card=? WHERE id=?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssssi", $full_name, $email, $credit, $credit_card, $id);
    }

    if ($update_stmt->execute()) {
        $message = "User updated successfully!";
        $message_type = "success";
    } else {
        $message = "Error: " . $update_stmt->error;
        $message_type = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update User</title>

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

        <h2 class="mb-4">Update User</h2>

        <!-- Display success/error message -->
        <?php if (isset($message)): ?>
            <div class="alert alert-<?= $message_type ?>"><?= $message ?></div>
        <?php endif; ?>

        <!-- Update User Form -->
        <form method="POST">
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" id="full_name" class="form-control" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="credit_card" class="form-label">Credit Card Number</label>
                <input type="text" id="credit_card" class="form-control" name="credit_card" value="<?= htmlspecialchars($user['credit_card']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="credit" class="form-label">Credit</label>
                <input type="number" id="credit" class="form-control" name="credit" value="<?= htmlspecialchars($user['credit']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password (Leave blank to keep current password)</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="Enter new password">
            </div>

            <button type="submit" class="btn btn-primary"><i class="bi bi-person-add"></i>&nbsp; Update User</button>
        </form>

        <!-- Back Link -->
        <a href="read.php" class="btn btn-secondary mt-3"><i class="bi bi-house-heart"></i>&nbsp;Back to Users</a>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
