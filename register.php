<?php
include "Handler/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash password
    $credit_card = $_POST["credit_card"]; // Get the credit card input
    $credit = $_POST["credit"]; // Get the credit amount

    // Insert into the users table with credit card included
    $sql = "INSERT INTO users (full_name, email, password, credit_card, credit) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    // Fixing the bind_param to include the correct types
    $stmt->bind_param("ssssd", $full_name, $email, $password, $credit_card, $credit); // 'd' for decimal (credit)

    if ($stmt->execute()) {
        header("Location: login.php?success=registered");
        exit();
    } else {
        $error = "Registration failed: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Register</h2>
        <?php if (isset($error)) echo "<p class='alert alert-danger'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="full_name" placeholder="Full Name" required class="form-control"><br>
            <input type="email" name="email" placeholder="Email" required class="form-control"><br>
            <input type="password" name="password" placeholder="Password" required class="form-control"><br>
            <input type="text" name="credit_card" placeholder="Credit Card Number" required class="form-control"><br>
            <input type="text" name="credit" placeholder="Credit" required class="form-control"><br>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <a href="login.php">Already have an account? Login here.</a>
    </div>
</body>
</html>
