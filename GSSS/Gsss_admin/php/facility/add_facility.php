<?php
// Assuming database connection is established

require("../../php/conn.php");



$facility_name = $_POST['facility_name'];
$facility_title = $_POST['facility_title'];
$facility_roll = $_POST['facility_roll'];
$editor = $_POST['editor'];
$facility_img = $_FILES['facility_images']['name'];

// Upload image to server
    $target_dir = './../../uploads/facility_img/';
$target_file = $target_dir . basename($_FILES["facility_images"]["name"]);
move_uploaded_file($_FILES["facility_images"]["tmp_name"], $target_file);

// Insert data into database
$sql = "INSERT INTO facility (name,title,img, roll,status,info) VALUES ('$facility_name', '$facility_title', '$facility_img','$facility_roll','1','$editor')";
if (mysqli_query($conn, $sql)) {
    echo "facility added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
