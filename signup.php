<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $name_parts = explode(' ', $full_name);
    
    $first_name = $name_parts[0];
    $middle_name = $name_parts[1];
    $last_name = $name_parts[2];
    $family_name = $name_parts[3];
    
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role_id = 2; // default to 'user'
    $image = 'uploads/' . basename($_FILES['image']['name']);
    
    move_uploaded_file($_FILES['image']['tmp_name'], $image);

    $stmt = $conn->prepare("INSERT INTO users (first_name, middle_name, last_name, family_name, email, mobile, password, role_id, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssis", $first_name, $middle_name, $last_name, $family_name, $email, $mobile, $password, $role_id, $image);

    if ($stmt->execute()) {
        header("Location: login.html");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
