<?php

include '../server/config.php';

if(isset($_POST['btnSubmit'])){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $image = $_FILES['image']['name'];
    $folderImage = "../models/Upload/".basename($image);

    $sql = "INSERT INTO posted (title, content, image) VALUES ('$title', '$content', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        if (move_uploaded_file($_FILES['image']['tmp_name'], $folderImage)){
            echo "Image uploaded successfully";
        } else {
            echo "Failed to upload image";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

};

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $remove = "DELETE FROM posted WHERE id = $id";
    $conn->query($remove);
    header('localhost:admin/posts.php');
};

?>