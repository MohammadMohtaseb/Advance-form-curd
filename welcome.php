<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Hello, <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['family_name']; ?></h2>
        <p>Your email: <?php echo $_SESSION['email']; ?></p>
        <img src="<?php echo $_SESSION['image']; ?>" alt="User Image" width="100" height="100">
        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>
</html>
