<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$servername = "127.0.0.1";
$username = "root";
$password = "root";
$database = "girl_school";


$conn = new mysqli($servername, $username, $password, $database);


    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the form data
    $id = $_POST['facilityId'];
    $name = $_POST['name'];
    $title = $_POST['title'];
    $roll = $_POST['roll'];
    $editor = $_POST['editor'];



    // Check if a new image was uploaded
    if (!empty($_FILES['facility_images']['name'])) {
        $img = $_FILES['facility_images']['name'];
            $targetDir = './../../uploads/facility_img/';

        $targetFilePath = $targetDir . basename($img);
        move_uploaded_file($_FILES['facility_images']['tmp_name'], $targetFilePath);
    } else {
        // If no new image was uploaded, keep the existing one
        $sql = "SELECT img FROM facility WHERE id = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $img = $row['img'];
    }

    // Update the record in the database
    $sql = "UPDATE facility SET name='$name', img='$img', roll=$roll,title='$title',info='$editor' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
