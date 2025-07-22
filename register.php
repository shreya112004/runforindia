<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "marathon_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed");
}

$fullName = $_POST['fullName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$weight = $_POST['weight'];
$height = $_POST['height'];
$bloodGroup = $_POST['bloodGroup'];
$conditions = $_POST['conditions'];

$photoPath = '';
if (isset($_FILES['photo'])) {
    $photo = $_FILES['photo'];
    $photoPath = 'uploads/' . basename($photo['name']);
    move_uploaded_file($photo['tmp_name'], $photoPath);
}

$stmt = $conn->prepare("INSERT INTO users (full_name, email, phone, password, weight, height, blood_group, medical_conditions, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssddsss", $fullName, $email, $phone, $password, $weight, $height, $bloodGroup, $conditions, $photoPath);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}
?>
