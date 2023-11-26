<?php
$data = array();
if (isset($_FILES['upload']['name'])) {
    $file_name = $_FILES['upload']['name'];
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $upload_dir = 'public/assets/upload/';

    // Memastikan direktori upload_dir ada atau dibuat jika belum ada
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_path = $upload_dir . $file_name;

    if ($file_extension == 'jpg' || $file_extension == 'jpeg' || $file_extension == 'png') {
        if (move_uploaded_file($_FILES['upload']['tmp_name'], $file_path)) {
            $data['file'] = $file_name;
            $data['url'] = $file_path;
            $data['uploaded'] = 1;
        } else {
            $data['uploaded'] = 0;
            $data['error']['message'] = 'Error! File not found';
        }
    } else {
        $data['uploaded'] = 0;
        $data['error']['message'] = 'Invalid extension';
    }
}
echo json_encode($data);
?>
