<?php

class Post
{

    public function __construct(
        public int $id,
        public String $title,
        public String $content,
        public String $image
    ) {
    }
}

session_start();

if (!isset($_SESSION['posts'])) {
    $_SESSION['posts'] = [];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = count($_SESSION['posts'], COUNT_NORMAL) + 1;
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];


    $folder = null;
    $alwExtension = array('png', 'jpg');
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $name = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        if (!in_array($ext, $alwExtension)) {
            echo 'error';
        }
        $folder = "../image/$name"; // img folder directory
        move_uploaded_file($tmpName, $folder);
    }


    $newPost = new Post($id, $title, $content, $folder);



    $_SESSION['posts'][] = $newPost;


    header("Location: {$_SERVER['REQUEST_URI']}");
    exit();
}

?>