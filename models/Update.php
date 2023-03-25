<?php
include '../server/config.php';

$id = $_GET['edit'];

if(isset($_POST['btnUpdate'])){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $image = $_FILES['image']['name'];
    $folderImage = "../models/Upload/".basename($image);

    $sql = "UPDATE posted SET title='$title', content= '$content', image='$image'
    WHERE id =$id";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        if (move_uploaded_file($_FILES['image']['tmp_name'], $folderImage)){
        } else {
            echo "Failed to upload image";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

};

?>