<?php
session_start();

// Ensure the user is logged in (either via session or cookie)
if (!isset($_SESSION["user_id"]) && !isset($_COOKIE["user_id"])) {
    header("Location: login.php");
    exit();
}

// Get user ID from the session or cookie
$user_id = $_SESSION["user_id"] ?? $_COOKIE["user_id"];
$user_name = $_SESSION["user_name"] ?? "User";

// Include the database connection
include "Handler/connect.php";

// Fetch user details from the database
$sql = "SELECT full_name, email, credit, credit_card FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("User not found.");
}

// Update user settings if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_credit_card = $_POST["credit_card"];
    $new_credit = $_POST["credit"];

    // Update the user's credit card number and amount of money
    $update_sql = "UPDATE users SET credit_card = ?, credit = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sdi", $new_credit_card, $new_credit, $user_id);

    if ($update_stmt->execute()) {
        $message = "Settings updated successfully!";
        $message_type = "success";

        // Fetch the updated data to show the new values
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();  // Use the updated user data
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
    <title>Settings</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-4">
        <h2>Settings</h2>

        <!-- Display success/error message -->
        <?php if (isset($message)): ?>
            <div class="alert alert-<?= $message_type ?>"><?= $message ?></div>
        <?php endif; ?>

        <!-- Settings Form -->
        <form method="POST">
            <div class="mb-3">
                <label for="credit_card" class="form-label">Credit Card Number</label>
                <input type="text" id="credit_card" class="form-control" name="credit_card" value="<?= htmlspecialchars($user['credit_card']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="credit" class="form-label">Amount of Money</label>
                <input type="number" id="credit" class="form-control" name="credit" value="<?= htmlspecialchars($user['credit']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Settings</button>
        </form>

        <a href="logout.php" class="btn btn-secondary mt-3">Logout</a>
    </div>

</body>
</html>
