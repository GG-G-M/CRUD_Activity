<?php
session_start();
include "Handler/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT id, full_name, password FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result && password_verify($password, $result['password'])) {
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_name"] = $result["full_name"];

        if (isset($_POST["remember"])) {
            setcookie("user_id", $result["id"], time() + (86400 * 30), "/"); // 30 days
        }

        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p class='alert alert-danger'>$error</p>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required class="form-control"><br>
            <input type="password" name="password" placeholder="Password" required class="form-control"><br>
            <button type="submit" class="btn btn-success">Login</button>
        </form>
        <a href="register.php">Don't have an account? Register here.</a>
    </div>
</body>
</html>
